<?php

/**
 * polls extension for Contao Open Source CMS
 * 
 * Copyright (C) 2013 Codefog
 * 
 * @package polls
 * @link    http://codefog.pl
 * @author  Kamil Kuzminski <kamil.kuzminski@codefog.pl>
 * @license LGPL
 */


/**
 * Register a custom namespace
 */
ClassLoader::addNamespace('Polls');


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
    'Polls\Poll'           => 'system/modules/polls/classes/Poll.php',
    'Polls\OptionImporter' => 'system/modules/polls/classes/OptionImporter.php',

	// Content elements
	'Polls\ContentPoll'    => 'system/modules/polls/elements/ContentPoll.php',

	// Modules
	'Polls\ModulePoll'     => 'system/modules/polls/modules/ModulePoll.php',
	'Polls\ModulePollList' => 'system/modules/polls/modules/ModulePollList.php'
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
    'ce_poll'                  => 'system/modules/polls/templates',
	'mod_poll'                 => 'system/modules/polls/templates',
	'mod_polllist'             => 'system/modules/polls/templates',
	'poll_default'             => 'system/modules/polls/templates',
    'be_poll_option_importer'  => 'system/modules/polls/templates',
));
