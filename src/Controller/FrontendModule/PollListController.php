<?php

namespace Codefog\PollsBundle\Controller\FrontendModule;

use Codefog\HasteBundle\Util\Pagination;
use Codefog\PollsBundle\Model\PollModel;
use Codefog\PollsBundle\PollGenerator;
use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\CoreBundle\Exception\PageNotFoundException;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\ModuleModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsFrontendModule('polllist', category: 'polls', template: 'frontend_module/poll_list')]
class PollListController extends AbstractFrontendModuleController
{
    public function __construct(private readonly PollGenerator $pollGenerator)
    {
    }

    protected function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
    {
        $criteria = array_filter([
            'active' => $model->poll_active,
            'featured' => $model->poll_featured,
            'visible' => $model->poll_visible,
        ]);

        $total = PollModel::countByCriteria($criteria);

        if ($total === 0) {
            return new Response();
        }

        if ($model->numberOfItems > 0) {
            $total = min($total, $model->numberOfItems);
        }

        $pagination = new Pagination($total, (int) $model->perPage, sprintf('pl-%d', $model->id));

        if ($pagination->isOutOfRange()) {
            throw new PageNotFoundException();
        }

        $pollModels = PollModel::findByCriteria($criteria, $pagination->getLimit(), $pagination->getOffset());

        if ($pollModels === null) {
            return new Response();
        }

        $polls = [];

        /** @var PollModel $pollModel */
        foreach ($pollModels as $pollModel) {
            $polls[] = $this->pollGenerator->generatePoll($pollModel, $request);
        }

        $template->set('polls', $polls);

        return $template->getResponse();
    }
}
