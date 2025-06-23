<?php

namespace Codefog\PollsBundle\Controller\ContentElement;

use Codefog\PollsBundle\Model\PollModel;
use Codefog\PollsBundle\PollGenerator;
use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement('poll', category: 'includes', template: 'content_element/poll')]
class PollController extends AbstractContentElementController
{
    public function __construct(private readonly PollGenerator $pollGenerator)
    {
    }

    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        if (!$model->poll && !$model->poll_current) {
            return new Response();
        }

        $pollModel = $model->poll_current ? PollModel::findCurrentPublished() : PollModel::findPublishedById((int) $model->poll);

        if ($pollModel === null) {
            return new Response();
        }

        $template->set('poll', $this->pollGenerator->generatePoll($pollModel, $request));

        return $template->getResponse();
    }
}
