<?php

namespace Codefog\PollsBundle\Migration;

use Contao\CoreBundle\Migration\AbstractMigration;
use Contao\CoreBundle\Migration\MigrationResult;
use Doctrine\DBAL\Connection;

class FrontendModuleMigration extends AbstractMigration
{
    public function __construct(private readonly Connection $connection)
    {
    }

    public function shouldRun(): bool
    {
        $schemaManager = $this->connection->createSchemaManager();

        if (!$schemaManager->tablesExist(['tl_module'])) {
            return false;
        }

        return $this->connection->fetchOne('SELECT COUNT(*) FROM tl_module WHERE type = ?', ['polllist']) > 0;
    }

    public function run(): MigrationResult
    {
        $this->connection->update('tl_module', ['type' => 'poll_list'], ['type' => 'polllist']);

        return $this->createResult(true);
    }
}
