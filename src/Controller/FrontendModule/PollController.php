<?php

namespace Codefog\PollsBundle\Controller\FrontendModule;

use Codefog\PollsBundle\Model\PollModel;
use Codefog\PollsBundle\PollGenerator;
use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\ModuleModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsFrontendModule('poll', category: 'polls', template: 'frontend_module/poll')]
class PollController extends AbstractFrontendModuleController
{
    public function __construct(private readonly PollGenerator $pollGenerator)
    {
    }

    protected function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
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
