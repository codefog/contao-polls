<?php

namespace Codefog\PollsBundle;

use Codefog\HasteBundle\Form\Form;
use Codefog\PollsBundle\Model\PollModel;
use Codefog\PollsBundle\Model\PollVotesModel;
use Contao\Controller;
use Contao\FrontendTemplate;
use Contao\FrontendUser;
use Doctrine\DBAL\Connection;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Translation\TranslatorInterface;

class PollGenerator
{
    public function __construct(
        private readonly Connection $connection,
        private readonly Security $security,
        private readonly TranslatorInterface $translator,
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
            return $this->generateResults($template, $poll);
        }

        return $this->generateForm($template, $request, $poll);
    }

    private function generateForm(FrontendTemplate $template, Request $request, Poll $poll): string
    {
        $form = $this->createPollForm($poll);

        // Add the vote
        if ($form->validate() && !$request->request->get('results')) {
            if (!$poll->canBeVoted()) {
                Controller::reload();
            }

            $this->processPollForm($form, $request, $poll);
        }

        $template->form = $form->getHelperObject();
        $template->showForm = true;
        $template->canSubmit = $poll->canBeVoted();
        $template->resultsLinkUrl = '';

        // Display the results link
        if ($this->shouldDisplayResultsLink($poll)) {
            // TODO
            //$template->resultsLinkUrl = $this->generatePollUrl('results');
        }

        return $template->parse();
    }

    private function generateResults(FrontendTemplate $template, Poll $poll): string
    {
        $results = [];
        $votesCount = array_sum($poll->getOptions()->fetchEach('votes'));

        // Generate results
        foreach ($poll->getOptions() as $optionModel) {
            $results[] = [
                'title' => $optionModel->title,
                'votes' => $optionModel->votes,
                'prcnt' => ($votesCount > 0) ? (round(($optionModel->votes / $votesCount), 2) * 100) : 0,
            ];
        }

        $template->showResults = true;
        $template->total = $votesCount;
        $template->results = $results;
        $template->formLinkUrl = '';

        // Display the form link
        if ($poll->isActive() && !$poll->hasUserVoted()) {
            // TODO
            //$template->formLinkUrl = $this->generatePollUrl('vote');
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

        // Set the cookie
        // TODO
        //$this->setCookie($this->strCookie.$pollModel->id, $time, ($time + (365 * 86400)));

        // Store the votes
        foreach ((array) $form->fetch('options') as $value) {
            $this->connection->insert('tl_poll_votes', [
                'pid' => $value,
                'tstamp' => time(),
                'ip' => $request->getClientIp(),
                'member' => $memberId ?: 0,
            ]);
        }

        // Redirect or reload the page
        //$_SESSION['POLL'][$pollModel->id] = $GLOBALS['TL_LANG']['MSC']['poll_vote_submitted'];
        $request->getSession()->getFlashBag()->add($this->getFlashBagKey($poll), $this->translator->trans('MSC.poll_vote_submitted', [], 'contao_default'));
        // TODO
        //$this->jumpToOrReload($this->jumpTo);
    }

    protected function generatePollUrl(PollModel $pollModel, string $strKey): string
    {
        [$strPage, $strQuery] = explode('?', \Environment::get('request'), 2);
        $arrQuery = array();

        // Parse the current query
        if ($strQuery != '') {
            $arrQuery = explode('&', $strQuery);

            // Remove the "vote" and "results" parameters
            foreach ($arrQuery as $k => $v) {
                [$key, $value] = explode('=', $v, 2);

                if ($key == 'vote' || $key == 'results') {
                    unset($arrQuery[$k]);
                }
            }
        }

        // Add the key
        $arrQuery[] = $strKey . '=' . $this->objPoll->id;

        return ampersand($strPage . '?' . implode('&', $arrQuery));
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

    /**
     * Check if there is DC_Multilingual installed
     * @return boolean
     */
    public static function checkMultilingual()
    {
        return (file_exists(TL_ROOT.'/system/drivers/DC_Multilingual.php') && count(self::getAvailableLanguages()) > 1) ? true : false;
    }


    /**
     * Return a list of available languages
     * @return array
     */
    public static function getAvailableLanguages()
    {
        $objDatabase = Database::getInstance();

        return $objDatabase->execute("SELECT DISTINCT language FROM tl_page WHERE type='root'")->fetchEach('language');
    }


    /**
     * Get a fallback language
     * @return string
     */
    public static function getFallbackLanguage()
    {
        $objDatabase = Database::getInstance();

        return $objDatabase->execute("SELECT language FROM tl_page WHERE type='root' AND fallback=1")->language;
    }
}
