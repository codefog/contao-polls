<?php

/**
 * polls extension for Contao Open Source CMS
 *
 * Copyright (C) 2013 Codefog
 *
 * @package polls
 * @author  Codefog <http://codefog.pl>
 * @author  Kamil Kuzminski <kamil.kuzminski@codefog.pl>
 * @author  ContaoCms.it <http://contaocms.it>
 * @author  Paolo Brunelli <paolob@contaocms.it>
 * @license LGPL
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_poll']['title']                     = array('Titolo', 'Inserire il titolo del sondaggio.');
$GLOBALS['TL_LANG']['tl_poll']['type']                      = array('Tipo', 'Selezionare il tipo di sondaggio.');
$GLOBALS['TL_LANG']['tl_poll']['voteInterval']              = array('Intervallo voto', 'Qui è possibile impostare il valore di tempo in secondi prima che un utente possa votare di nuovo. Impostare a 0 se si vuole che il voto sia fatto solo una volta.');
$GLOBALS['TL_LANG']['tl_poll']['protected']                 = array('Sondaggio protetto', 'Solo gli utenti che hanno effettuato il login possono votare.');
$GLOBALS['TL_LANG']['tl_poll']['featured']                  = array('Sondaggio in evidenza', 'Indica il sondaggio come in evidenza.');
$GLOBALS['TL_LANG']['tl_poll']['active_behaviorNotVoted']   = array('L\'utente non ha votato (sondaggio attivo)', 'Si prega di specificare il comportamento se l\'utente non ha votato e il sondaggio è attivo.');
$GLOBALS['TL_LANG']['tl_poll']['active_behaviorVoted']      = array('L\'utente ha votato (sondaggio attivo)', '
Si prega di specificare il comportamento se l\'utente ha votato e il sondaggio è attivo.');
$GLOBALS['TL_LANG']['tl_poll']['inactive_behaviorNotVoted'] = array('L\'utente non ha votato (sondaggio inattivo)', 'Si prega di specificare il comportamento se l\'utente non ha votato e il sondaggio è inattivo.');
$GLOBALS['TL_LANG']['tl_poll']['inactive_behaviorVoted']    = array('L\'utente ha votato (sondaggio inattivo)', '
Si prega di specificare il comportamento se l\'utente ha votato e il sondaggio è inattivo.');
$GLOBALS['TL_LANG']['tl_poll']['published']                 = array('Pubblica Sondaggio', 'Pubblica il sondaggio e rendilo visibile sul sito.');
$GLOBALS['TL_LANG']['tl_poll']['closed']                    = array('Chiudi sondaggio', 'Chiudi il sondaggio .');
$GLOBALS['TL_LANG']['tl_poll']['activeStart']               = array('Attivo dal', 'Non attivare il sondaggio prima di questo giorno.');
$GLOBALS['TL_LANG']['tl_poll']['activeStop']                = array('Attivo fino al ', 'Disabilita il sondaggio dopo questo giorno.');
$GLOBALS['TL_LANG']['tl_poll']['showStart']                 = array('Mostra dal giorno', 'Non visualizzare il sondaggio sul sito web prima di questo giorno.');
$GLOBALS['TL_LANG']['tl_poll']['showStop']                  = array('Mostra fino al giorno', 'Non visualizzare il sondaggio sul sito web su e dopo questa giornata.');
$GLOBALS['TL_LANG']['tl_poll']['tstamp']                    = array('Data revisione', 'Data ed ora dell\'ultima revisione');



/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_poll']['title_legend']    = 'Titolo e caratteristiche';
$GLOBALS['TL_LANG']['tl_poll']['redirect_legend'] = 'Impostazioni redirect';
$GLOBALS['TL_LANG']['tl_poll']['publish_legend']  = 'Impostazioni pubblicazione';


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_poll']['type']['single']           = 'Singolo voto (radio)';
$GLOBALS['TL_LANG']['tl_poll']['type']['multiple']         = 'Voto multiplo (checkbox)';
$GLOBALS['TL_LANG']['tl_poll']['behaviorNotVoted']['opt1'] = 'Mostra il link "Visualizza risultati"';
$GLOBALS['TL_LANG']['tl_poll']['behaviorNotVoted']['opt2'] = 'Non mostrare i risultati a tutti';
$GLOBALS['TL_LANG']['tl_poll']['behaviorNotVoted']['opt3'] = 'Mostra subito i risultati';
$GLOBALS['TL_LANG']['tl_poll']['behaviorVoted']['opt1']    = 'Mostra subito i risultati';
$GLOBALS['TL_LANG']['tl_poll']['behaviorVoted']['opt2']    = 'Mostra il link "Visualizza risultati"';
$GLOBALS['TL_LANG']['tl_poll']['behaviorVoted']['opt3']    = 'Non mostrare i risultati a tutti';


/**
 * Miscellaneous
 */
$GLOBALS['TL_LANG']['tl_poll']['closedPoll'] = 'Closed';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_poll']['new']        = array('Nuovo sondaggio', 'Crea un nuovo sondaggio');
$GLOBALS['TL_LANG']['tl_poll']['show']       = array('Dettagli sondaggio', 'Mostra i dettagli del sondaggio ID %s');
$GLOBALS['TL_LANG']['tl_poll']['edit']       = array('Modifica sondaggio', 'Modifica il sondaggio ID %s');
$GLOBALS['TL_LANG']['tl_poll']['editheader'] = array('Modifica impostazioni sondaggio', 'Modifica le impostazioni del sondaggio ID %s');
$GLOBALS['TL_LANG']['tl_poll']['copy']       = array('Duplica sondaggio', 'Duplia sondaggio ID %s');
$GLOBALS['TL_LANG']['tl_poll']['delete']     = array('Elimina sondaggio', 'Elimina sondaggio ID %s');
$GLOBALS['TL_LANG']['tl_poll']['toggle']     = array('Mostra/nascondi sondaggio', 'Mostra/nascondi sondaggio ID %s');
$GLOBALS['TL_LANG']['tl_poll']['feature']    = array('Metti in evidenza/togli evidenza', 'Metti in evidenza/togli evidenza ID %s');
