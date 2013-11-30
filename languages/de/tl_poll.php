<?php

/**
 * polls extension for Contao Open Source CMS
 *
 * Copyright (C) 2013 Codefog
 *
 * @package polls
 * @author  Codefog <http://codefog.pl>
 * @author  Kamil Kuzminski <kamil.kuzminski@codefog.pl>
 * @author  Sebastian Seidel <sebastian@derastronaut.de>
 * @license LGPL
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_poll']['title']                     = array('Titel', 'Bitte geben Sie den Titel der Umfrage ein.');
$GLOBALS['TL_LANG']['tl_poll']['voteInterval']              = array('Interval zur Abstimmung', 'Hier können Sie in Sekunden angeben, wann der Benutzer erneut abstimmen kann. Setzen Sie eine 0, wenn nur einmalig abgestimmt werden darf.');
$GLOBALS['TL_LANG']['tl_poll']['protected']                 = array('Umfrage schützen', 'Nur eingeloggte Benutzer dürfen abstimmen.');
$GLOBALS['TL_LANG']['tl_poll']['featured']                  = array('Umfrage hervorheben', 'Die Umfrage im Frontend hervorheben.');
$GLOBALS['TL_LANG']['tl_poll']['active_behaviorNotVoted']   = array('Benutzer hat nicht abgestimmt (aktive Umfrage)', 'Bitte geben Sie an, was angezeigt werden soll, wenn der Benutzer nicht abgestimmt hat und die Umfrage aktiv ist.');
$GLOBALS['TL_LANG']['tl_poll']['active_behaviorVoted']      = array('Benutzer hat abgestimmt (aktive Umfrage)', 'Bitte geben Sie an, was angezeigt werden soll, wenn der Benutzer abgestimmt hat und die Umfrage aktiv ist.');
$GLOBALS['TL_LANG']['tl_poll']['inactive_behaviorNotVoted'] = array('Benutzer hat nicht abgestimmt (inaktive Umfrage)', 'Bitte geben Sie an, was angezeigt werden soll, wenn der Benutzer nicht abgestimmt hat und die Umfrage inaktiv ist.');
$GLOBALS['TL_LANG']['tl_poll']['inactive_behaviorVoted']    = array('Benutzer hat abgestimmt (inaktive Umfrage)', 'Bitte geben Sie an, was angezeigt werden soll, wenn der Benutzer abgestimmt hat und die Umfrage inaktiv ist.');
$GLOBALS['TL_LANG']['tl_poll']['published']                 = array('Umfrage veröffentlichen', 'Veröffentlichen Sie die Umfrage im Frontend.');
$GLOBALS['TL_LANG']['tl_poll']['closed']                    = array('Umfrage schließen', 'Schließen Sie die Umfrage (Abstimmen nicht mehr möglich).');
$GLOBALS['TL_LANG']['tl_poll']['activeStart']               = array('Aktiv von', 'Aktiviert die Umfrage an diesem Datum.');
$GLOBALS['TL_LANG']['tl_poll']['activeStop']                = array('Aktiv bis', 'Deaktiviert die Umfrage an diesem Datum.');
$GLOBALS['TL_LANG']['tl_poll']['showStart']                 = array('Anzeigen von', 'Zeigt die Umfrage ab gesetztem Datum im Frontend an.');
$GLOBALS['TL_LANG']['tl_poll']['showStop']                  = array('Anzeigen bis', 'Zeigt die Umfrage bis zum gesetzten Datum im Frontend an.');
$GLOBALS['TL_LANG']['tl_poll']['tstamp']                    = array('Datum der Bearbeitung', 'Zeit und Datum der letzten Bearbeitung.');



/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_poll']['title_legend']    = 'Titel und Verhalten';
$GLOBALS['TL_LANG']['tl_poll']['redirect_legend'] = 'Weiterleitung';
$GLOBALS['TL_LANG']['tl_poll']['publish_legend']  = 'Veröffentlichung';


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_poll']['behaviorNotVoted']['opt1'] = 'Zeigt einen Link zum Ergebnis an.';
$GLOBALS['TL_LANG']['tl_poll']['behaviorNotVoted']['opt2'] = 'Ergebnisse nicht anzeigen.';
$GLOBALS['TL_LANG']['tl_poll']['behaviorNotVoted']['opt3'] = 'Ergebnisse sofort anzeigen.';
$GLOBALS['TL_LANG']['tl_poll']['behaviorVoted']['opt1']    = 'Ergebnisse sofort anzeigen.';
$GLOBALS['TL_LANG']['tl_poll']['behaviorVoted']['opt2']    = 'Zeigt einen Link zum Ergebnis an.';
$GLOBALS['TL_LANG']['tl_poll']['behaviorVoted']['opt3']    = 'Ergebnisse nicht anzeigen.';


/**
 * Miscellaneous
 */
$GLOBALS['TL_LANG']['tl_poll']['closedPoll'] = 'Geschlossen';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_poll']['new']        = array('Neue Umfrage', 'Eine neue Umfrage erstellen.');
$GLOBALS['TL_LANG']['tl_poll']['show']       = array('Umfrage details', 'Details der Umfrage mit ID %s anzeigen.');
$GLOBALS['TL_LANG']['tl_poll']['edit']       = array('Umfrage bearbeiten', 'Umfrage mit ID %s bearbeiten.');
$GLOBALS['TL_LANG']['tl_poll']['editheader'] = array('Umfrage-Einstellungen bearbeiten', 'Einstellungen der Umfrage mit ID %s bearbeiten.');
$GLOBALS['TL_LANG']['tl_poll']['copy']       = array('Umfrage duplizieren', 'Umfrage mit ID %s duplizieren.');
$GLOBALS['TL_LANG']['tl_poll']['delete']     = array('Umfrage löschen', 'Umfrage mit ID %s löschen.');
$GLOBALS['TL_LANG']['tl_poll']['toggle']     = array('Umfrage veröffentlichen/verstecken', 'Umfrage mit ID %s veröffentlichen bzw. verstecken.');
$GLOBALS['TL_LANG']['tl_poll']['feature']    = array('Umfrage hervorheben', 'Umfrage ID %s hervorheben bzw. Hervorhebung aufheben.');
