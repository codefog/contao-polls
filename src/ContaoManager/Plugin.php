<?php

namespace Codefog\PollsBundle\ContaoManager;

use Codefog\HasteBundle\CodefogHasteBundle;
use Codefog\PollsBundle\CodefogPollsBundle;
use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(CodefogPollsBundle::class)->setLoadAfter([
                ContaoCoreBundle::class,
                CodefogHasteBundle::class,
            ]),
        ];
    }
}
