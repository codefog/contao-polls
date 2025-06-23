<?php

namespace Codefog\PollsBundle\EventListener;

use Codefog\PollsBundle\PollGenerator;
use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Doctrine\DBAL\Connection;

class ContentDataContainerListener
{
    public function __construct(
        private readonly Connection $connection,
        private readonly PollGenerator $pollManager,
    )
    {
    }

    #[AsCallback('tl_content', 'fields.poll.options')]
    #[AsCallback('tl_module', 'fields.poll.options')]
    public function onPollOptionsCallback(): array
    {
        return $this->connection->fetchAllKeyValue('SELECT id, title FROM tl_poll' . ($this->pollManager->checkMultilingual() ? ' WHERE lid=0' : '') . ' ORDER BY title');
    }
}
