<?php

/**
 * polls extension for Contao Open Source CMS
 *
 * Copyright (C) 2013 Codefog Ltd
 *
 * @package polls
 * @author  Codefog Ltd <http://codefog.pl>
 * @author  Kamil Kuzminski <kamil.kuzminski@codefog.pl>
 * @license LGPL
 */


/**
 * Load tl_content language files and data container
 */
System::loadLanguageFile('tl_content');
$this->loadDataContainer('tl_content');


/**
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['poll']     = '{title_legend},name,headline,type;{config_legend},poll,poll_current;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['polllist'] = '{title_legend},name,headline,type;{config_legend},poll_active,poll_visible,poll_featured,numberOfItems,perPage;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';


/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['poll'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['poll'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('tl_content_poll', 'getPolls'),
	'eval'                    => array('includeBlankOption'=>true, 'chosen'=>true, 'tl_class'=>'w50'),
	'sql'                     => "int(10) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['poll_current'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['poll_current'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'w50 m12'),
	'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['poll_active'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['poll_active'],
	'default'                 => 'all',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array('all', 'yes', 'no'),
	'reference'               => &$GLOBALS['TL_LANG']['tl_module']['poll_active'],
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "varchar(4) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['poll_visible'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['poll_visible'],
	'default'                 => 'all',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array('all', 'yes', 'no'),
	'reference'               => &$GLOBALS['TL_LANG']['tl_module']['poll_visible'],
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "varchar(4) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['poll_featured'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['poll_featured'],
	'default'                 => 'all',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array('all', 'yes', 'no'),
	'reference'               => &$GLOBALS['TL_LANG']['tl_module']['poll_featured'],
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "varchar(4) NOT NULL default ''"
);
