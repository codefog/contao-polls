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
$GLOBALS['TL_LANG']['tl_poll']['title']                     = array('Tytuł', 'Wprowadź tytuł sondy.');
$GLOBALS['TL_LANG']['tl_poll']['type']                      = array('Typ', 'Tutaj możesz wybrać typ sondy.');
$GLOBALS['TL_LANG']['tl_poll']['voteInterval']              = array('Odstęp czasowy', 'Tutaj możesz wprowadzić liczbę sekund po której użytkownik będzie mógł znowu zagłosować. Wprowadź 0, jeśli głos może zostać oddany tylko raz.');
$GLOBALS['TL_LANG']['tl_poll']['protected']                 = array('Sonda chroniona', 'Tylko zalogowani użytkownicy będą mogli zagłosować.');
$GLOBALS['TL_LANG']['tl_poll']['featured']                  = array('Wyróżnij sondę', 'Oznacz sondę jako wyróżnioną.');
$GLOBALS['TL_LANG']['tl_poll']['active_behaviorNotVoted']   = array('Użytkownik nie zagłosował (sonda aktywna)', 'Określ zachowanie sondy, jeśli użytkownik nie zagłosował i sonda jest aktywna.');
$GLOBALS['TL_LANG']['tl_poll']['active_behaviorVoted']      = array('Użytkownik zagłosował (sonda aktywna)', 'Określ zachowanie sondy, jeśli użytkownik zagłosował i sonda jest aktywna.');
$GLOBALS['TL_LANG']['tl_poll']['inactive_behaviorNotVoted'] = array('Użytkownik nie zagłosował (sonda nieaktywna)', 'Określ zachowanie sondy, jeśli użytkownik nie zagłosował i sonda jest nieaktywna.');
$GLOBALS['TL_LANG']['tl_poll']['inactive_behaviorVoted']    = array('Użytkownik zagłosował (sonda nieaktywna)', 'Określ zachowanie sondy, jeśli użytkownik zagłosował i sonda jest nieaktywna.');
$GLOBALS['TL_LANG']['tl_poll']['published']                 = array('Publikuj sondę', 'Publikuj sondę na stronach serwisu.');
$GLOBALS['TL_LANG']['tl_poll']['closed']                    = array('Zamknij sondę', 'Zamknij sondę i zablokuj głosowanie.');
$GLOBALS['TL_LANG']['tl_poll']['activeStart']               = array('Aktywna od', 'Zablokuj głosowanie przed tym dniem.');
$GLOBALS['TL_LANG']['tl_poll']['activeStop']                = array('Aktywna do', 'Zablokuj głosowanie w tym i po tym dniu.');
$GLOBALS['TL_LANG']['tl_poll']['showStart']                 = array('Pokaż od', 'Nie wyświetlaj sondy na stronie przed tym dniem.');
$GLOBALS['TL_LANG']['tl_poll']['showStop']                  = array('Pokaż do', 'Nie wyświetlaj sondy na stronie w tym i po tym dniu.');
$GLOBALS['TL_LANG']['tl_poll']['tstamp']                    = array('Ostatnia aktualizacja', 'Data i czas ostatniej aktualizacji');



/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_poll']['title_legend']    = 'Tytuł i zachowanie';
$GLOBALS['TL_LANG']['tl_poll']['redirect_legend'] = 'Ustawienia przekierowania';
$GLOBALS['TL_LANG']['tl_poll']['publish_legend']  = 'Ustawienia publikacji';


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_poll']['type']['single']           = 'Pojedynczy głos (radio)';
$GLOBALS['TL_LANG']['tl_poll']['type']['multiple']         = 'Wielokrotny głos (checkbox)';
$GLOBALS['TL_LANG']['tl_poll']['behaviorNotVoted']['opt1'] = 'Wyświetl link "pokaż wyniki"';
$GLOBALS['TL_LANG']['tl_poll']['behaviorNotVoted']['opt2'] = 'Nie pokazuj wyników wcale';
$GLOBALS['TL_LANG']['tl_poll']['behaviorNotVoted']['opt3'] = 'Pokaż wyniki od razu';
$GLOBALS['TL_LANG']['tl_poll']['behaviorVoted']['opt1']    = 'Pokaż wyniki od razu';
$GLOBALS['TL_LANG']['tl_poll']['behaviorVoted']['opt2']    = 'Wyświetl link "pokaż wyniki"';
$GLOBALS['TL_LANG']['tl_poll']['behaviorVoted']['opt3']    = 'Nie pokazuj wyników wcale';


/**
 * Miscellaneous
 */
$GLOBALS['TL_LANG']['tl_poll']['closedPoll'] = 'Zamknięta';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_poll']['new']        = array('Nowa sonda', 'Utwórz nową sondę');
$GLOBALS['TL_LANG']['tl_poll']['show']       = array('Szczegóły sondy', 'Pokaż szczegóły sondy ID %s');
$GLOBALS['TL_LANG']['tl_poll']['edit']       = array('Edytuj sondę', 'Edytuj sondę ID %s');
$GLOBALS['TL_LANG']['tl_poll']['editheader'] = array('Edytuj ustawienia sondy', 'Edytuj ustawienia sondy');
$GLOBALS['TL_LANG']['tl_poll']['copy']       = array('Duplikuj sondę', 'Duplikuj sondę ID %s');
$GLOBALS['TL_LANG']['tl_poll']['delete']     = array('Usuń sondę', 'Usuń sondę ID %s');
$GLOBALS['TL_LANG']['tl_poll']['toggle']     = array('Publikuj/ukryj sondę', 'Publikuj/ukryj sondę ID %s');
$GLOBALS['TL_LANG']['tl_poll']['feature']    = array('Wyróżnij/nie wyróżniaj sondę', 'Wyróżnij/nie wyróżniaj sondę ID %s');
