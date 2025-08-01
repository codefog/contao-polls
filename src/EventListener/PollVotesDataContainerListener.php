<?php

namespace Codefog\PollsBundle\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;
use Doctrine\DBAL\Connection;

class PollVotesDataContainerListener
{
    public function __construct(private readonly Connection $connection)
    {
    }

    #[AsCallback('tl_poll_vote', 'config.onload')]
    public function onLoadCallback(DataContainer $dc): void
    {
        $GLOBALS['TL_DCA']['tl_poll_vote']['list']['sorting']['root'] = $this->connection->fetchFirstColumn('SELECT id FROM tl_poll_vote WHERE pid=?', [$dc->id]);
    }
}
