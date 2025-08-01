<?php

namespace Codefog\PollsBundle\Migration;

use Contao\CoreBundle\Migration\AbstractMigration;
use Contao\CoreBundle\Migration\MigrationResult;
use Doctrine\DBAL\Connection;

class LanguageColumnsMigration extends AbstractMigration
{
    private const TABLES = ['tl_poll', 'tl_poll_option'];

    public function __construct(private readonly Connection $connection)
    {
    }

    public function shouldRun(): bool
    {
        $schemaManager = $this->connection->createSchemaManager();

        if (!$schemaManager->tablesExist(self::TABLES)) {
            return false;
        }

        foreach (self::TABLES as $table) {
            $columns = $schemaManager->listTableColumns($table);

            if (array_key_exists('lid', $columns)) {
                return true;
            }
        }

        return false;
    }

    public function run(): MigrationResult
    {
        $schemaManager = $this->connection->createSchemaManager();

        foreach (self::TABLES as $table) {
            $columns = $schemaManager->listTableColumns($table);

            if (!array_key_exists('lid', $columns)) {
                continue;
            }

            $this->connection->executeStatement("ALTER TABLE $table CHANGE COLUMN lid langPid int(10) unsigned NOT NULL default '0';");
        }

        return $this->createResult(true);
    }
}
