<?php

namespace Codefog\PollsBundle\ContaoManager;

use Codefog\EventsSubscriptionsBundle\CodefogEventsSubscriptionsBundle;
use Codefog\HasteBundle\CodefogHasteBundle;
use Contao\CalendarBundle\ContaoCalendarBundle;
use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(CodefogEventsSubscriptionsBundle::class)->setLoadAfter([
                ContaoCoreBundle::class,
                ContaoCalendarBundle::class,
                CodefogHasteBundle::class,
            ]),
        ];
    }
}
