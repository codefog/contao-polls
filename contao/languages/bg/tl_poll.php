<?php

/**
 * polls extension for Contao Open Source CMS
 *
 * Copyright (C) 2013 Codefog
 *
 * @package polls
 * @author  Codefog <http://codefog.pl>
 * @author  Kamil Kuzminski <kamil.kuzminski@codefog.pl>
 * @author  Пламен Синигерски <moonlord@gbg.bg>
 * @license LGPL
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_poll']['title']                     = array('Заглавие', 'Моля, въведете заглавие на анкетата.');
$GLOBALS['TL_LANG']['tl_poll']['type']                      = array('Вид', 'Моля, изберете вида на анкетата.');
$GLOBALS['TL_LANG']['tl_poll']['voteInterval']              = array('Интервал на гласуване', 'Тук можете да зададете времеви интервал, след който потребител би могъл да гласува отново. Задайте стойност 0 ако искате гласуването да бъде еднократно.');
$GLOBALS['TL_LANG']['tl_poll']['protected']                 = array('Защитена анкета', 'Единствено вписани (logged in) потребители могат да гласуват в анкетата.');
$GLOBALS['TL_LANG']['tl_poll']['featured']                  = array('Анкета с акцент', 'Маркирай анкетата като анкета с акцент');
$GLOBALS['TL_LANG']['tl_poll']['active_behaviorNotVoted']   = array('Потребителят не е гласувал (активна анкета)', 'Моля, изберете поведение, когато потребителят не е гласувал, а анкетата е активна.');
$GLOBALS['TL_LANG']['tl_poll']['active_behaviorVoted']      = array('Потребителят е гласувал (активна анкета)', 'Моля, изберете поведение, когато потребителят е гласувал и анкетата е активна.');
$GLOBALS['TL_LANG']['tl_poll']['inactive_behaviorNotVoted'] = array('Потребителят не е гласувал (не-активна анкета)', 'Моля, изберете поведение, когато потребителят не е гласувал и анкетата е не-активна.');
$GLOBALS['TL_LANG']['tl_poll']['inactive_behaviorVoted']    = array('Потребителят е гласувал (не-активна анкета)', 'Моля, изберете поведение, когато потребителят е гласувал, а анкетата е не-активна.');
$GLOBALS['TL_LANG']['tl_poll']['published']                 = array('Публикувай анкетата', 'Прави анкетата публична.');
$GLOBALS['TL_LANG']['tl_poll']['closed']                    = array('Затвори анкетата', 'Затвори анкетата и спри гласуването.');
$GLOBALS['TL_LANG']['tl_poll']['activeStart']               = array('Активна от', 'Забрани гласуването преди тази дата');
$GLOBALS['TL_LANG']['tl_poll']['activeStop']                = array('Активна до', 'Забрани гласуването след тази дата (включително)');
$GLOBALS['TL_LANG']['tl_poll']['showStart']                 = array('Показвай от', 'Не показвай анкетата преди тази дата.');
$GLOBALS['TL_LANG']['tl_poll']['showStop']                  = array('Показвай до', 'Не показвай анкетата след тази дата (включително).');
$GLOBALS['TL_LANG']['tl_poll']['tstamp']                    = array('Дата на редакция', 'Дата и час на последната редакция');



/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_poll']['title_legend']    = 'Заглавие и поведение';
$GLOBALS['TL_LANG']['tl_poll']['redirect_legend'] = 'Настройки за пренасочване';
$GLOBALS['TL_LANG']['tl_poll']['publish_legend']  = 'Настройки за публикуване';


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_poll']['type']['single']           = 'Единичен отговор (radio бутон)';
$GLOBALS['TL_LANG']['tl_poll']['type']['multiple']         = 'Няколко отговора (кутийки с отметки)';
$GLOBALS['TL_LANG']['tl_poll']['behaviorNotVoted']['opt1'] = 'Полазвай връзката за "Виж резултатите"';
$GLOBALS['TL_LANG']['tl_poll']['behaviorNotVoted']['opt2'] = 'Не показвай резултатите изобщо';
$GLOBALS['TL_LANG']['tl_poll']['behaviorNotVoted']['opt3'] = 'Директно показвай резултатите';
$GLOBALS['TL_LANG']['tl_poll']['behaviorVoted']['opt1']    = 'Директно показвай резултатите';
$GLOBALS['TL_LANG']['tl_poll']['behaviorVoted']['opt2']    = 'Полазвай връзката за "Виж резултатите"';
$GLOBALS['TL_LANG']['tl_poll']['behaviorVoted']['opt3']    = 'Не показвай резултатите изобщо';


/**
 * Miscellaneous
 */
$GLOBALS['TL_LANG']['tl_poll']['closedPoll'] = 'Затворена анкета';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_poll']['new']        = array('Нова анкета', 'Създай нова анкета');
$GLOBALS['TL_LANG']['tl_poll']['show']       = array('Детайли', 'Покажи повече информация за анкета с ID %s');
$GLOBALS['TL_LANG']['tl_poll']['edit']       = array('Редакция', 'Редактирай анкета с ID %s');
$GLOBALS['TL_LANG']['tl_poll']['editheader'] = array('Настройки', 'Промяна на настройките на анкета с ID %s');
$GLOBALS['TL_LANG']['tl_poll']['copy']       = array('Дупликат', 'Дупликирай анкета с ID %s');
$GLOBALS['TL_LANG']['tl_poll']['delete']     = array('Изтрий', 'Изтрий анкета с ID %s');
$GLOBALS['TL_LANG']['tl_poll']['toggle']     = array('Публикувай/скрий', 'Публикувай/скрий анкета с ID %s');
$GLOBALS['TL_LANG']['tl_poll']['feature']    = array('Със/без акцнет', 'Задай/махни акцента на анкета с ID %s');
