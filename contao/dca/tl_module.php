<?php

use Doctrine\DBAL\Types\Types;

// Palettes
$GLOBALS['TL_DCA']['tl_module']['palettes']['poll'] = '{title_legend},name,headline,type;{config_legend},poll,poll_current;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID';
$GLOBALS['TL_DCA']['tl_module']['palettes']['poll_list'] = '{title_legend},name,headline,type;{config_legend},poll_active,poll_visible,poll_featured,numberOfItems,perPage;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID';

// Fields
$GLOBALS['TL_DCA']['tl_module']['fields']['poll'] = [
    'inputType' => 'select',
    'eval' => ['includeBlankOption' => true, 'chosen' => true, 'tl_class' => 'w50'],
    'sql' => ['type' => Types::INTEGER, 'unsigned' => true, 'default' => 0],
];

$GLOBALS['TL_DCA']['tl_module']['fields']['poll_current'] = [
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'w50 m12'],
    'sql' => ['type' => Types::BOOLEAN, 'default' => false],
];

$GLOBALS['TL_DCA']['tl_module']['fields']['poll_active'] = [
    'default' => 'all',
    'inputType' => 'select',
    'options' => ['all', 'yes', 'no'],
    'reference' => &$GLOBALS['TL_LANG']['tl_module']['poll_active'],
    'eval' => ['tl_class' => 'w50'],
    'sql' => ['type' => Types::STRING, 'length' => 4, 'default' => ''],
];

$GLOBALS['TL_DCA']['tl_module']['fields']['poll_visible'] = [
    'default' => 'all',
    'inputType' => 'select',
    'options' => ['all', 'yes', 'no'],
    'reference' => &$GLOBALS['TL_LANG']['tl_module']['poll_visible'],
    'eval' => ['tl_class' => 'w50'],
    'sql' => ['type' => Types::STRING, 'length' => 4, 'default' => ''],
];

$GLOBALS['TL_DCA']['tl_module']['fields']['poll_featured'] = [
    'default' => 'all',
    'inputType' => 'select',
    'options' => ['all', 'yes', 'no'],
    'reference' => &$GLOBALS['TL_LANG']['tl_module']['poll_featured'],
    'eval' => ['tl_class' => 'w50'],
    'sql' => ['type' => Types::STRING, 'length' => 4, 'default' => ''],
];
