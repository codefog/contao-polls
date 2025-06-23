<?php

use Doctrine\DBAL\Types\Types;

// Palettes
$GLOBALS['TL_DCA']['tl_content']['palettes']['poll'] = '{type_legend},type,headline;{include_legend},poll,poll_current;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},cssID;{invisible_legend:hide},invisible,start,stop';

// Fields
$GLOBALS['TL_DCA']['tl_content']['fields']['poll'] = [
    'inputType' => 'select',
    'eval' => ['includeBlankOption' => true, 'chosen' => true, 'tl_class' => 'w50'],
    'sql' => ['type' => Types::INTEGER, 'unsigned' => true, 'default' => 0],
];

$GLOBALS['TL_DCA']['tl_content']['fields']['poll_current'] = [
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'w50 m12'],
    'sql' => ['type' => Types::BOOLEAN, 'default' => false],
];
