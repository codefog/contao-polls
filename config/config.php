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
 * Extension version
 */
@define('POLLS_VERSION', '1.0');
@define('POLLS_BUILD', '2');


/**
 * Back end modules
 */
array_insert($GLOBALS['BE_MOD']['content'], 4, array
(
	'polls' => array
	(
		'tables' => array('tl_poll', 'tl_poll_option', 'tl_poll_votes'),
		'icon'   => 'system/modules/polls/assets/icon.png'
	)
));


/**
 * Front end modules
 */
array_insert($GLOBALS['FE_MOD'], 4, array
(
	'polls' => array
	(
		'poll'     => 'ModulePoll',
		'polllist' => 'ModulePollList'
	)
));


/**
 * Content elements
 */
$GLOBALS['TL_CTE']['includes']['poll'] = 'ContentPoll';
