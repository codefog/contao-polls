<?php

use Doctrine\DBAL\Types\Types;

$GLOBALS['TL_DCA']['tl_poll_option'] = [

    // Config
    'config' => [
        'dataContainer' => \Contao\DC_Table::class,
        'ptable' => 'tl_poll',
        'ctable' => ['tl_poll_votes'],
        'enableVersioning' => true,
        'sql' => [
            'keys' => [
                'id' => 'primary',
                'pid' => 'index',
            ],
        ],
    ],

    // List
    'list' => [
        'sorting' => [
            'mode' => \Contao\DataContainer::MODE_PARENT,
            'fields' => ['sorting'],
            'headerFields' => ['title', 'tstamp', 'published'],
        ],
        'global_operations' => [
            'reset' => [
                'label' => &$GLOBALS['TL_LANG']['tl_poll_option']['reset'],
                'href' => 'key=reset',
                'icon' => 'delete.svg',
                'attributes' => 'onclick="if (!confirm(\''.($GLOBALS['TL_LANG']['tl_poll_option']['reset'][2] ?? '').'\')) return false; Backend.getScrollOffset();"',
            ],
            'all',
        ],
    ],

    // Palettes
    'palettes' => [
        'default' => '{title_legend},title,published',
    ],

    // Fields
    'fields' => [
        'id' => [
            'sql' => ['type' => Types::INTEGER, 'unsigned' => true, 'autoincrement' => true],
        ],
        'pid' => [
            'foreignKey' => 'tl_poll.title',
            'sql' => ['type' => Types::INTEGER, 'unsigned' => true, 'default' => 0],
        ],
        'tstamp' => [
            'sql' => ['type' => Types::INTEGER, 'unsigned' => true, 'default' => 0],
        ],
        'sorting' => [
            'sql' => ['type' => Types::INTEGER, 'unsigned' => true, 'default' => 0],
        ],
        'lid' => [
            'sql' => ['type' => Types::INTEGER, 'unsigned' => true, 'default' => 0],
        ],
        'language' => [
            'sql' => ['type' => Types::STRING, 'length' => 2, 'default' => ''],
        ],
        'title' => [
            'inputType' => 'text',
            'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
            'sql' => ['type' => Types::STRING, 'length' => 255, 'default' => ''],
        ],
        'published' => [
            'inputType' => 'checkbox',
            'eval' => ['doNotCopy' => true, 'tl_class' => 'w50 m12'],
            'sql' => ['type' => Types::BOOLEAN, 'default' => false],
        ],
    ],
];

// Provide support for DC_Multilingual
// TODO
//if (\Poll::checkMultilingual()) {
//    $GLOBALS['TL_DCA']['tl_poll_option']['config']['dataContainer'] = 'Multilingual';
//    $GLOBALS['TL_DCA']['tl_poll_option']['config']['languages'] = Poll::getAvailableLanguages();
//    $GLOBALS['TL_DCA']['tl_poll_option']['config']['pidColumn'] = 'lid';
//    $GLOBALS['TL_DCA']['tl_poll_option']['config']['fallbackLang'] = Poll::getFallbackLanguage();
//
//    // Make "title" field translatable
//    $GLOBALS['TL_DCA']['tl_poll_option']['fields']['title']['eval']['translatableFor'] = '*';
//}
