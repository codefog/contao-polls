<?php

/**
 * polls extension for Contao Open Source CMS
 *
 * Copyright (C) 2013 Codefog
 *
 * @package polls
 * @author  Codefog <http://codefog.pl>
 * @author  Kamil Kuzminski <kamil.kuzminski@codefog.pl>
 * @author  Lionel Maccaud <https://github.com/lionel-m>
 * @license LGPL
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_poll_votes']['tstamp'] = array('Date du vote');
$GLOBALS['TL_LANG']['tl_poll_votes']['ip']     = array('Adresse IP');
$GLOBALS['TL_LANG']['tl_poll_votes']['member'] = array('Membre');


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_poll_votes']['anonymous'] = '<span style="color:#b3b3b3;">(anonyme)</span>';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_poll_votes']['delete'] = array('Supprimer le vote', 'Supprimer le vote avec l\'ID %s');
$GLOBALS['TL_LANG']['tl_poll_votes']['show']   = array('Afficher les détails du vote', 'Afficher les détails du vote avec l\'ID %s');
