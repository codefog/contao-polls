<?php

namespace Codefog\PollsBundle\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Types\Types;
use Terminal42\DcMultilingualBundle\Driver;

#[AsHook('loadDataContainer')]
class LoadDataContainerListener
{
    public function __construct(private readonly Connection $connection)
    {
    }

    public function __invoke(string $table): void
    {
        if (!static::checkMultilingual()) {
            return;
        }

        if ($table === 'tl_poll') {
            $GLOBALS['TL_DCA'][$table]['config']['dataContainer'] = Driver::class;
            $GLOBALS['TL_DCA'][$table]['config']['languages'] = $this->getAvailableLanguages();
            $GLOBALS['TL_DCA'][$table]['config']['fallbackLang'] = $this->getFallbackLanguage();

            // Add necessary fields
            $GLOBALS['TL_DCA'][$table]['fields']['langPid']['sql'] = ['type' => Types::INTEGER, 'unsigned' => true, 'default' => 0];
            $GLOBALS['TL_DCA'][$table]['fields']['language']['sql'] = ['type' => Types::STRING, 'length' => 2, 'default' => ''];

            // Make "title" field translatable
            $GLOBALS['TL_DCA'][$table]['fields']['title']['eval']['translatableFor'] = '*';
        }

        if ($table === 'tl_poll_option') {
            $GLOBALS['TL_DCA'][$table]['config']['dataContainer'] = Driver::class;
            $GLOBALS['TL_DCA'][$table]['config']['languages'] = $this->getAvailableLanguages();
            $GLOBALS['TL_DCA'][$table]['config']['fallbackLang'] = $this->getFallbackLanguage();

            // Add necessary fields
            $GLOBALS['TL_DCA'][$table]['fields']['langPid']['sql'] = ['type' => Types::INTEGER, 'unsigned' => true, 'default' => 0];
            $GLOBALS['TL_DCA'][$table]['fields']['language']['sql'] = ['type' => Types::STRING, 'length' => 2, 'default' => ''];

            // Make "title" field translatable
            $GLOBALS['TL_DCA'][$table]['fields']['title']['eval']['translatableFor'] = '*';
        }
    }

    public static function checkMultilingual(): bool
    {
        return class_exists(Driver::class);
    }

    private function getAvailableLanguages(): array
    {
        return $this->connection->fetchFirstColumn('SELECT DISTINCT language FROM tl_page WHERE type=?', ['root']);
    }

    private function getFallbackLanguage(): string
    {
        return $this->connection->fetchOne('SELECT language FROM tl_page WHERE type=? AND fallback=?', ['root', 1]);
    }
}
