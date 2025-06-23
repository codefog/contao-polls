<?php

use Doctrine\DBAL\Types\Types;

$GLOBALS['TL_DCA']['tl_poll_votes'] = [

    // Config
    'config' => [
        'dataContainer' => \Contao\DC_Table::class,
        'ptable' => 'tl_poll_option',
        'closed' => true,
        'notEditable' => true,
        'notCopyable' => true,
        'notSortable' => true,
        'doNotCopyRecords' => true,
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
            'mode' => \Contao\DataContainer::MODE_SORTED,
            'fields' => ['tstamp'],
            'flag' => \Contao\DataContainer::SORT_DESC,
            'panelLayout' => 'filter;search,limit',
        ],
        'label' => [
            'fields' => ['tstamp', 'ip', 'member'],
            'showColumns' => true,
        ],
    ],

    // Fields
    'fields' => [
        'id' => [
            'sql' => ['type' => Types::INTEGER, 'unsigned' => true, 'autoincrement' => true],
        ],
        'pid' => [
            'foreignKey' => 'tl_poll_option.title',
            'sql' => ['type' => Types::INTEGER, 'unsigned' => true, 'default' => 0],
        ],
        'tstamp' => [
            'filter' => true,
            'flag' => \Contao\DataContainer::SORT_MONTH_DESC,
            'sql' => ['type' => Types::INTEGER, 'unsigned' => true, 'default' => 0],
        ],
        'ip' => [
            'filter' => true,
            'search' => true,
            'sql' => ['type' => Types::STRING, 'length' => 16, 'default' => ''],
        ],
        'member' => [
            'filter' => true,
            'search' => true,
            'foreignKey' => 'tl_member.username',
            'reference' => [0 => &$GLOBALS['TL_LANG']['tl_poll_votes']['anonymous']],
            'sql' => ['type' => Types::INTEGER, 'unsigned' => true, 'default' => 0],
        ],
    ],
];
