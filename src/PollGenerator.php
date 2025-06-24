<?php

namespace Codefog\PollsBundle;

use Codefog\HasteBundle\Form\Form;
use Codefog\HasteBundle\UrlParser;
use Codefog\PollsBundle\Model\PollModel;
use Codefog\PollsBundle\Model\PollOptionModel;
use Codefog\PollsBundle\Model\PollVotesModel;
use Contao\CoreBundle\Exception\ResponseException;
use Contao\CoreBundle\Routing\ContentUrlGenerator;
use Contao\FrontendTemplate;
use Contao\FrontendUser;
use Contao\PageModel;
use Doctrine\DBAL\Connection;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class PollGenerator
{
    public function __construct(
        private readonly Connection $connection,
        private readonly ContentUrlGenerator $contentUrlGenerator,
        private readonly Security $security,
        private readonly TranslatorInterface $translator,
        private readonly UrlParser $urlParser,
    )
    {
    }

    public function createPoll(PollModel $pollModel, Request $request): Poll
    {
        if (($options = $pollModel->getOptions()) === null) {
            throw new \InvalidArgumentException(sprintf('Poll ID %d could not be created because it has no options', $pollModel->id));
        }

        $poll = new Poll($pollModel, $options);
        $poll
            ->setActive($pollModel->isActive())
            ->setProtected($pollModel->protected && $this->getFrontendUser() === null)
            ->setUserVoted($this->hasUserVoted($pollModel, $request))
        ;

        return $poll;
    }

    public function generatePoll(PollModel $pollModel, Request $request): string
    {
        try {
            $poll = $this->createPoll($pollModel, $request);
        } catch (\InvalidArgumentException) {
            return '';
        }

        $template = new FrontendTemplate('poll/default');
        $template->setData($pollModel->row());
        $template->isActive = $poll->isActive();
        $template->isFeatured = (bool) $pollModel->featured;
        $template->isProtected = $poll->isProtected();
        $template->showForm = false;
        $template->showResults = false;
        $template->message = '';

        $hasUserVotedNow = false;

        // Display a confirmation message
        if (($messages = $request->getSession()->getFlashBag()->get($this->getFlashBagKey($poll))) !== []) {
            $hasUserVotedNow = true;
            $template->message = $messages[0];
        }

        if ($this->shouldDisplayResults($request, $poll, $hasUserVotedNow)) {
            return $this->generateResults($template, $request, $poll);
        }

        return $this->generateForm($template, $request, $poll);
    }

    private function generateForm(FrontendTemplate $template, Request $request, Poll $poll): string
    {
        $form = $this->createPollForm($poll);

        // Add the vote
        if ($form->validate() && $poll->canBeVoted() && !$request->query->get('results')) {
            $this->processPollForm($form, $request, $poll);
        }

        $template->form = $form->getHelperObject();
        $template->showForm = true;
        $template->canSubmit = $poll->canBeVoted();
        $template->resultsLinkUrl = '';

        // Display the results link
        if ($this->shouldDisplayResultsLink($poll)) {
            $template->resultsLinkUrl = $this->generatePollUrl($request, $poll, 'results');
        }

        return $template->parse();
    }

    private function generateResults(FrontendTemplate $template, Request $request, Poll $poll): string
    {
        $results = [];
        $totalVotes = PollVotesModel::countVotes((int) $poll->getModel()->id);

        /** @var PollOptionModel $optionModel */
        foreach ($poll->getOptions() as $optionModel) {
            $results[] = [
                'title' => $optionModel->title,
                'votes' => $optionModel->votes,
                'prcnt' => ($totalVotes > 0) ? (round(($optionModel->countVotes() / $totalVotes), 2) * 100) : 0,
            ];
        }

        $template->showResults = true;
        $template->total = $totalVotes;
        $template->results = $results;
        $template->formLinkUrl = '';

        // Display the form link
        if ($poll->isActive() && !$poll->hasUserVoted()) {
            $template->formLinkUrl = $this->generatePollUrl($request, $poll, 'vote');
        }

        return $template->parse();
    }

    private function shouldDisplayResults(Request $request, Poll $poll, bool $hasUserVotedNow): bool
    {
        $pollModel = $poll->getModel();

        $pollCheck = $request->query->getInt('results') === (int) $pollModel->id;
        $voteCheck = !$request->query->has('vote') || $request->query->getInt('vote') !== (int) $pollModel->id;

        if ($poll->isActive() && !$poll->hasUserVoted() && (($pollModel->active_behaviorNotVoted === 'opt1' && $pollCheck) || ($pollModel->active_behaviorNotVoted === 'opt3' && $voteCheck))) {
            return true;
        }

        if ($poll->isActive() && $poll->hasUserVoted() && (($pollModel->active_behaviorVoted === 'opt2' && $pollCheck) || ($pollModel->active_behaviorVoted === 'opt1' && ($hasUserVotedNow || $voteCheck)))) {
            return true;
        }

        if (!$poll->isActive() && !$poll->hasUserVoted() && (($pollModel->inactive_behaviorNotVoted === 'opt1' && $pollCheck) || ($pollModel->inactive_behaviorNotVoted === 'opt3' && $voteCheck))) {
            return true;
        }

        if (!$poll->isActive() && $poll->hasUserVoted() && (($pollModel->inactive_behaviorVoted === 'opt2' && $pollCheck) || ($pollModel->inactive_behaviorVoted === 'opt1' && $voteCheck))) {
            return true;
        }

        return false;
    }

    private function shouldDisplayResultsLink(Poll $poll): bool
    {
        $pollModel = $poll->getModel();

        if ($poll->isActive() && !$poll->hasUserVoted() && $pollModel->active_behaviorNotVoted === 'opt1') {
            return true;
        }

        if ($poll->isActive() && $poll->hasUserVoted() && $pollModel->active_behaviorVoted === 'opt2') {
            return true;
        }

        if (!$poll->isActive() && !$poll->hasUserVoted() && $pollModel->inactive_behaviorNotVoted === 'opt1') {
            return true;
        }

        if (!$poll->isActive() && $poll->hasUserVoted() && $pollModel->inactive_behaviorVoted === 'opt2') {
            return true;
        }

        return false;
    }

    private function hasUserVoted(PollModel $pollModel, Request $request): bool
    {
        $expires = $pollModel->voteInterval ? (time() - $pollModel->voteInterval) : 0;

        if ($request->cookies->get($this->getCookieName($pollModel)) > $expires) {
            return true;
        }

        if ($pollModel->protected && ($frontendUser = $this->getFrontendUser()) !== null)
        {
            return PollVotesModel::hasMemberVoted((int) $pollModel->id, $expires, (int) $frontendUser->id);
        }

        return PollVotesModel::hasIpVoted((int) $pollModel->id, $expires, $request->getClientIp());
    }

    private function getCookieName(PollModel $pollModel): string
    {
        return sprintf('poll-%d', $pollModel->id);
    }

    private function getFlashBagKey(Poll $poll): string
    {
        return sprintf('poll-%d', $poll->getModel()->id);
    }

    private function processPollForm(Form $form, Request $request, Poll $poll): void
    {
        $memberId = $this->getFrontendUser()?->id;
        $time = time();

        // Store the votes
        foreach ((array) $form->fetch('options') as $value) {
            $this->connection->insert('tl_poll_votes', [
                'pid' => $value,
                'tstamp' => $time,
                'ip' => $request->getClientIp(),
                'member' => $memberId ?: 0,
            ]);
        }

        $targetPageId = $poll->getModel()->jumpTo;

        // Generate the redirect URL
        if (($targetPage = PageModel::findPublishedById($targetPageId)) !== null) {
            $redirectUrl = $this->contentUrlGenerator->generate($targetPage, [], UrlGeneratorInterface::ABSOLUTE_URL);
        } else {
            $redirectUrl = $request->getUri();
        }

        // Create the redirect response and set the cookie
        $response = new RedirectResponse($redirectUrl, 303);
        $response->headers->setCookie(Cookie::create($this->getCookieName($poll->getModel()), $time, ($time + (365 * 86400))));

        // Set the confirmation message
        $request->getSession()->getFlashBag()->add($this->getFlashBagKey($poll), $this->translator->trans('MSC.poll_vote_submitted', [], 'contao_default'));

        throw new ResponseException($response);
    }

    protected function generatePollUrl(Request $request, Poll $poll, string $queryKey): string
    {
        $url = $request->getUri();
        $url = $this->urlParser->removeQueryString(['results', 'vote'], $url);
        $url = $this->urlParser->addQueryString(sprintf('%s=%s', $queryKey, $poll->getModel()->id), $url);

        return $url;
    }

    private function createPollForm(Poll $poll): Form
    {
        $options = [];

        // Generate options
        foreach ($poll->getOptions() as $optionModel) {
            $options[$optionModel->id] = $optionModel->title;
        }

        $form = new Form(sprintf('poll-%d', $poll->getModel()->id), 'POST');
        $form->addContaoHiddenFields();
        $form->addFormField('options', [
            'options' => $options,
            'inputType' => ($poll->getModel()->type === 'single') ? 'radio' : 'checkbox',
            'eval' => ['mandatory' => true, 'disabled' => !$poll->isActive()],
        ]);

        if ($poll->canBeVoted()) {
            $form->addSubmitFormField($this->translator->trans('MSC.poll_vote', [], 'contao_default'));
        }

        return $form;
    }

    private function getFrontendUser(): FrontendUser|null
    {
        $user = $this->security->getUser();

        if ($user instanceof FrontendUser) {
            return $user;
        }

        return null;
    }
}
