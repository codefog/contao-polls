<?php

namespace Codefog\PollsBundle\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;

class PollDataContainerListener
{
    #[AsCallback('tl_poll', 'list.label.label')]
    public function onLabelCallback(array $row, string $label): string
    {
        if ($row['closed']) {
            $label .= ' <span style="padding-left:3px;color:#b3b3b3;">['.$GLOBALS['TL_LANG']['tl_poll']['closedPoll'].']</span>';
        }

        return $label;
    }
}
