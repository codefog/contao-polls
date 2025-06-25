<?php

namespace Codefog\PollsBundle\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Doctrine\DBAL\Connection;

class PollOptionDataContainerListener
{
    public function __construct(private readonly Connection $connection)
    {
    }

    #[AsCallback('tl_poll_option', 'list.label.label')]
    public function onChildRecordCallback(array $row): string
    {
        static $total;

        // Get the total number of votes
        if ($total === null) {
            $total = $this->connection->fetchOne('SELECT COUNT(*) AS total FROM tl_poll_vote WHERE pid IN (SELECT id FROM tl_poll_option WHERE pid=?)', [$row['pid']]);
        }

        $votes = $this->connection->fetchOne('SELECT COUNT(*) AS total FROM tl_poll_vote WHERE pid=?', [$row['id']]);

        $width = $total ? (round(($votes / $total), 2) * 200) : 0;
        $prcnt = $total ? (round(($votes / $total), 2) * 100) : 0;
        $height = 16;

        return '<div><div style="display:inline-block;margin-right:8px;background-color:var(--contao);height:'.$height.'px;line-height:14px;text-align:right;width:'.($width + 30).'px;"><span style="color:#ffffff;font-size:10px;margin-right:4px;">'.$prcnt.' %</span></div>'.$row['title'].' <span style="padding-left:3px;color:#b3b3b3;">['.sprintf((($votes == 1) ? $GLOBALS['TL_LANG']['tl_poll_option']['voteSingle'] : $GLOBALS['TL_LANG']['tl_poll_option']['votePlural']), $votes).']</span></div>';
    }
}
