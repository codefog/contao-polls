<?php

namespace Codefog\PollsBundle\Migration;

use Contao\CoreBundle\Migration\AbstractMigration;
use Contao\CoreBundle\Migration\MigrationResult;
use Doctrine\DBAL\Connection;

class VotesTableMigration extends AbstractMigration
{
    public function __construct(private readonly Connection $connection)
    {
    }

    public function shouldRun(): bool
    {
        $schemaManager = $this->connection->createSchemaManager();

        return $schemaManager->tablesExist(['tl_poll_votes']);
    }

    public function run(): MigrationResult
    {
        $this->connection->executeStatement('RENAME TABLE tl_poll_votes TO tl_poll_vote');

        return $this->createResult(true);
    }
}
