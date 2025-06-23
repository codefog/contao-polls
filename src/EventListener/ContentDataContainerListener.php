<?php

namespace Codefog\PollsBundle\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Doctrine\DBAL\Connection;

class ContentDataContainerListener
{
    public function __construct(private readonly Connection $connection)
    {
    }

    #[AsCallback('tl_content', 'fields.poll.options')]
    #[AsCallback('tl_module', 'fields.poll.options')]
    public function onPollOptionsCallback(): array
    {
        return $this->connection->fetchAllKeyValue('SELECT id, title FROM tl_poll' . (LoadDataContainerListener::checkMultilingual() ? ' WHERE lid=0' : '') . ' ORDER BY title');
    }
}
