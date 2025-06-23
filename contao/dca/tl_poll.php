<?php

use Doctrine\DBAL\Types\Types;

$GLOBALS['TL_DCA']['tl_poll'] = [

    // Config
    'config' => [
        'dataContainer' => \Contao\DC_Table::class,
        'ctable' => ['tl_poll_option'],
        'switchToEdit' => true,
        'enableVersioning' => true,
        'sql' => [
            'keys' => [
                'id' => 'primary',
            ],
        ],
    ],

    // List
    'list' => [
        'sorting' => [
            'mode' => \Contao\DataContainer::MODE_SORTED,
            'fields' => ['title'],
            'flag' => \Contao\DataContainer::SORT_INITIAL_LETTER_ASC,
            'panelLayout' => 'filter;search,limit',
        ],
        'label' => [
            'fields' => ['title'],
            'format' => '%s',
            'label_callback' => ['tl_poll', 'addStatus'],
        ],
        //'operations' => [
        //    'edit' => [
        //        'label' => &$GLOBALS['TL_LANG']['tl_poll']['edit'],
        //        'href' => 'table=tl_poll_option',
        //        'icon' => 'edit.gif',
        //        'attributes' => 'class="contextmenu"',
        //    ],
        //    'editheader' => [
        //        'label' => &$GLOBALS['TL_LANG']['tl_poll']['editheader'],
        //        'href' => 'act=edit',
        //        'icon' => 'header.gif',
        //        'attributes' => 'class="edit-header"',
        //    ],
        //    'copy' => [
        //        'label' => &$GLOBALS['TL_LANG']['tl_poll']['copy'],
        //        'href' => 'act=copy',
        //        'icon' => 'copy.gif',
        //    ],
        //    'delete' => [
        //        'label' => &$GLOBALS['TL_LANG']['tl_poll']['delete'],
        //        'href' => 'act=delete',
        //        'icon' => 'delete.gif',
        //        'attributes' => 'onclick="if (!confirm(\''.$GLOBALS['TL_LANG']['MSC']['deleteConfirm'].'\')) return false; Backend.getScrollOffset();"',
        //    ],
        //    'toggle' => [
        //        'label' => &$GLOBALS['TL_LANG']['tl_poll']['toggle'],
        //        'icon' => 'visible.gif',
        //        'attributes' => 'onclick="Backend.getScrollOffset(); return AjaxRequest.toggleVisibility(this, %s);"',
        //        'button_callback' => ['tl_poll', 'toggleIcon'],
        //    ],
        //    'feature' => [
        //        'label' => &$GLOBALS['TL_LANG']['tl_poll']['feature'],
        //        'icon' => 'featured.gif',
        //        'attributes' => 'onclick="Backend.getScrollOffset(); return AjaxRequest.toggleFeatured(this, %s);"',
        //        'button_callback' => ['tl_poll', 'iconFeatured'],
        //    ],
        //    'show' => [
        //        'label' => &$GLOBALS['TL_LANG']['tl_poll']['show'],
        //        'href' => 'act=show',
        //        'icon' => 'show.gif',
        //    ],
        //],
    ],

    // Palettes
    'palettes' => [
        'default' => '{title_legend},title,type,voteInterval,protected,featured,active_behaviorNotVoted,active_behaviorVoted,inactive_behaviorNotVoted,inactive_behaviorVoted;{redirect_legend:hide},jumpTo;{publish_legend},published,closed,activeStart,activeStop,showStart,showStop',
    ],

    // Fields
    'fields' => [
        'id' => [
            'sql' => ['type' => Types::INTEGER, 'unsigned' => true, 'autoincrement' => true],
        ],
        'tstamp' => [
            'sql' => ['type' => Types::INTEGER, 'unsigned' => true, 'default' => 0],
        ],
        'lid' => [
            'sql' => ['type' => Types::INTEGER, 'unsigned' => true, 'default' => 0],
        ],
        'language' => [
            'sql' => ['type' => Types::STRING, 'length' => 2, 'default' => ''],
        ],
        'title' => [
            'search' => true,
            'inputType' => 'text',
            'eval' => ['mandatory' => true, 'maxlength' => 255],
            'sql' => ['type' => Types::STRING, 'length' => 255, 'default' => ''],
        ],
        'type' => [
            'default' => 'single',
            'inputType' => 'select',
            'options' => ['single', 'multiple'],
            'reference' => &$GLOBALS['TL_LANG']['tl_poll']['type'],
            'eval' => ['tl_class' => 'w50'],
            'sql' => ['type' => Types::STRING, 'length' => 8, 'default' => ''],
        ],
        'voteInterval' => [
            'inputType' => 'text',
            'eval' => ['rgxp' => 'digit', 'tl_class' => 'w50'],
            'sql' => ['type' => Types::INTEGER, 'unsigned' => true, 'default' => 86400],
        ],
        'protected' => [
            'filter' => true,
            'inputType' => 'checkbox',
            'eval' => ['tl_class' => 'w50'],
            'sql' => ['type' => Types::BOOLEAN, 'default' => false],
        ],
        'featured' => [
            'filter' => true,
            'inputType' => 'checkbox',
            'eval' => ['tl_class' => 'w50'],
            'sql' => ['type' => Types::BOOLEAN, 'default' => false],
        ],
        'active_behaviorNotVoted' => [
            'inputType' => 'select',
            'options' => ['opt1', 'opt2', 'opt3'],
            'reference' => &$GLOBALS['TL_LANG']['tl_poll']['behaviorNotVoted'],
            'eval' => ['tl_class' => 'w50'],
            'sql' => ['type' => Types::STRING, 'length' => 4, 'default' => 'opt1'],
        ],
        'active_behaviorVoted' => [
            'inputType' => 'select',
            'options' => ['opt1', 'opt2', 'opt3'],
            'reference' => &$GLOBALS['TL_LANG']['tl_poll']['behaviorVoted'],
            'eval' => ['tl_class' => 'w50'],
            'sql' => ['type' => Types::STRING, 'length' => 4, 'default' => 'opt1'],
        ],
        'inactive_behaviorNotVoted' => [
            'inputType' => 'select',
            'options' => ['opt1', 'opt2', 'opt3'],
            'reference' => &$GLOBALS['TL_LANG']['tl_poll']['behaviorNotVoted'],
            'eval' => ['tl_class' => 'w50'],
            'sql' => ['type' => Types::STRING, 'length' => 4, 'default' => 'opt1'],
        ],
        'inactive_behaviorVoted' => [
            'inputType' => 'select',
            'options' => ['opt1', 'opt2', 'opt3'],
            'reference' => &$GLOBALS['TL_LANG']['tl_poll']['behaviorVoted'],
            'eval' => ['tl_class' => 'w50'],
            'sql' => ['type' => Types::STRING, 'length' => 4, 'default' => 'opt1'],
        ],
        'jumpTo' => [
            'filter' => true,
            'inputType' => 'pageTree',
            'eval' => ['fieldType' => 'radio', 'tl_class' => 'clr'],
            'sql' => ['type' => Types::INTEGER, 'unsigned' => true, 'default' => 0],
        ],
        'published' => [
            'filter' => true,
            'toggle' => true,
            'inputType' => 'checkbox',
            'eval' => ['doNotCopy' => true, 'tl_class' => 'w50'],
            'sql' => ['type' => Types::BOOLEAN, 'default' => false],
        ],
        'closed' => [
            'filter' => true,
            'toggle' => true,
            'inputType' => 'checkbox',
            'eval' => ['doNotCopy' => true, 'tl_class' => 'w50'],
            'sql' => ['type' => Types::BOOLEAN, 'default' => false],
        ],
        'activeStart' => [
            'search' => true,
            'flag' => \Contao\DataContainer::SORT_MONTH_DESC,
            'inputType' => 'text',
            'eval' => ['rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'],
            'sql' => ['type' => Types::STRING, 'length' => 10, 'default' => ''],
        ],
        'activeStop' => [
            'search' => true,
            'flag' => \Contao\DataContainer::SORT_MONTH_DESC,
            'inputType' => 'text',
            'eval' => ['rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'],
            'sql' => ['type' => Types::STRING, 'length' => 10, 'default' => ''],
        ],
        'showStart' => [
            'search' => true,
            'flag' => \Contao\DataContainer::SORT_MONTH_DESC,
            'inputType' => 'text',
            'eval' => ['rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'],
            'sql' => ['type' => Types::STRING, 'length' => 10, 'default' => ''],
        ],
        'showStop' => [
            'search' => true,
            'flag' => \Contao\DataContainer::SORT_MONTH_DESC,
            'inputType' => 'text',
            'eval' => ['rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'],
            'sql' => ['type' => Types::STRING, 'length' => 10, 'default' => ''],
        ],
    ],
];

// Provide support for DC_Multilingual
//// TODO
//if (\Poll::checkMultilingual()) {
//    $GLOBALS['TL_DCA']['tl_poll']['config']['dataContainer'] = 'Multilingual';
//    $GLOBALS['TL_DCA']['tl_poll']['config']['languages'] = Poll::getAvailableLanguages();
//    $GLOBALS['TL_DCA']['tl_poll']['config']['pidColumn'] = 'lid';
//    $GLOBALS['TL_DCA']['tl_poll']['config']['fallbackLang'] = Poll::getFallbackLanguage();
//
//    // Make "title" field translatable
//    $GLOBALS['TL_DCA']['tl_poll']['fields']['title']['eval']['translatableFor'] = '*';
//}
