<?php

namespace Codefog\PollsBundle\BackendController;

use Contao\Controller;
use Contao\DataContainer;
use Contao\System;
use Doctrine\DBAL\Connection;

class ResetPollController
{
    public function __construct(private readonly Connection $connection)
    {
    }

    public function __invoke(DataContainer $dc): void
    {
        $this->connection->executeStatement('DELETE FROM tl_poll_vote WHERE pid IN (SELECT id FROM tl_poll_option WHERE pid=?)', [$dc->id]);

        Controller::redirect(System::getReferer());
    }
}
