<?php

/**
 * polls extension for Contao Open Source CMS
 *
 * Copyright (C) 2013 Codefog
 *
 * @package polls
 * @author  Codefog <http://codefog.pl>
 * @author  Kamil Kuzminski <kamil.kuzminski@codefog.pl>
 * @license LGPL
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_poll']['title']                     = array('Title', 'Please enter the poll title.');
$GLOBALS['TL_LANG']['tl_poll']['type']                      = array('Type', 'Here you can choose the poll type.');
$GLOBALS['TL_LANG']['tl_poll']['voteInterval']              = array('Vote interval', 'Here you can set the time value in seconds before a user can vote again. Set to 0 if vote can be made only once.');
$GLOBALS['TL_LANG']['tl_poll']['protected']                 = array('Protected poll', 'Only the logged in users will be able to vote.');
$GLOBALS['TL_LANG']['tl_poll']['featured']                  = array('Feature poll', 'Mark the poll as featured.');
$GLOBALS['TL_LANG']['tl_poll']['active_behaviorNotVoted']   = array('User has not voted (poll active)', 'Please specify the behavior if the user has not voted and the poll is active.');
$GLOBALS['TL_LANG']['tl_poll']['active_behaviorVoted']      = array('User has voted (poll active)', 'Please specify the behavior if the user has voted and the poll is active.');
$GLOBALS['TL_LANG']['tl_poll']['inactive_behaviorNotVoted'] = array('User has not voted (poll inactive)', 'Please specify the behavior if the user has not voted and the poll is inactive.');
$GLOBALS['TL_LANG']['tl_poll']['inactive_behaviorVoted']    = array('User has voted (poll inactive)', 'Please specify the behavior if the user has voted and the poll is inactive.');
$GLOBALS['TL_LANG']['tl_poll']['published']                 = array('Publish poll', 'Make the poll publicly visible on the website.');
$GLOBALS['TL_LANG']['tl_poll']['closed']                    = array('Close poll', 'Close the poll and disable voting.');
$GLOBALS['TL_LANG']['tl_poll']['jumpTo']                    = array('Redirect page', 'Here you can choose the page to which visitors will be redirected after submitting the form.');
$GLOBALS['TL_LANG']['tl_poll']['activeStart']               = array('Active from', 'Disable voting the poll before this day.');
$GLOBALS['TL_LANG']['tl_poll']['activeStop']                = array('Active until', 'Disable voting the poll on and after this day.');
$GLOBALS['TL_LANG']['tl_poll']['showStart']                 = array('Show from', 'Do not display the poll on the website before this day.');
$GLOBALS['TL_LANG']['tl_poll']['showStop']                  = array('Show until', 'Do not display the poll on the website on and after this day.');
$GLOBALS['TL_LANG']['tl_poll']['tstamp']                    = array('Revision date', 'Date and time of the latest revision');



/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_poll']['title_legend']    = 'Title and behavior';
$GLOBALS['TL_LANG']['tl_poll']['redirect_legend'] = 'Redirect settings';
$GLOBALS['TL_LANG']['tl_poll']['publish_legend']  = 'Publish settings';


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_poll']['type']['single']           = 'Single vote (radio)';
$GLOBALS['TL_LANG']['tl_poll']['type']['multiple']         = 'Multiple vote (checkbox)';
$GLOBALS['TL_LANG']['tl_poll']['behaviorNotVoted']['opt1'] = 'Display a "show results" link';
$GLOBALS['TL_LANG']['tl_poll']['behaviorNotVoted']['opt2'] = 'Do not show results at all';
$GLOBALS['TL_LANG']['tl_poll']['behaviorNotVoted']['opt3'] = 'Show results immediately';
$GLOBALS['TL_LANG']['tl_poll']['behaviorVoted']['opt1']    = 'Show results immediately';
$GLOBALS['TL_LANG']['tl_poll']['behaviorVoted']['opt2']    = 'Display a "show results" link';
$GLOBALS['TL_LANG']['tl_poll']['behaviorVoted']['opt3']    = 'Do not show results at all';


/**
 * Miscellaneous
 */
$GLOBALS['TL_LANG']['tl_poll']['closedPoll'] = 'Closed';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_poll']['new']        = array('New poll', 'Create a new poll');
$GLOBALS['TL_LANG']['tl_poll']['show']       = array('Poll details', 'Show the details of poll ID %s');
$GLOBALS['TL_LANG']['tl_poll']['edit']       = array('Edit poll', 'Edit poll ID %s');
$GLOBALS['TL_LANG']['tl_poll']['editheader'] = array('Edit poll settings', 'Edit the settings of poll');
$GLOBALS['TL_LANG']['tl_poll']['copy']       = array('Duplicate poll', 'Duplicate poll ID %s');
$GLOBALS['TL_LANG']['tl_poll']['delete']     = array('Delete poll', 'Delete poll ID %s');
$GLOBALS['TL_LANG']['tl_poll']['toggle']     = array('Publish/unpublish poll', 'Publish/unpublish poll ID %s');
$GLOBALS['TL_LANG']['tl_poll']['feature']    = array('Feature/unfeature poll', 'Feature/unfeature poll ID %s');
