<?php

/**
 * polls extension for Contao Open Source CMS
 *
 * Copyright (C) 2013 Codefog
 *
 * @package polls
 * @author  Codefog <http://codefog.pl>
 * @author  Kamil Kuzminski <kamil.kuzminski@codefog.pl>
 * @author  Ivo Simsons <ssimss@gmail.com>
 * @license LGPL
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_poll']['title']                     = array('Nosaukums', 'Lūdzu, ievadiet aptaujas nosaukumu.');
$GLOBALS['TL_LANG']['tl_poll']['type']                      = array('Veids', 'Šeit jūs varat izvēlēties aptaujas veidu.');
$GLOBALS['TL_LANG']['tl_poll']['voteInterval']              = array('Balsojuma intervāls', 'Šeit jūs varat iestatīt laika vērtību sekundēs, pirms lietotājs var vēlreiz balsot. Iestatiet uz 0, ja balsojumu var izdarīt tikai vienu reizi.');
$GLOBALS['TL_LANG']['tl_poll']['protected']                 = array('Aizsargāta aptauja', 'Balsot varēs tikai pieteikušies lietotāji.');
$GLOBALS['TL_LANG']['tl_poll']['featured']                  = array('Izceltā aptauja', 'Atzīmējiet aptauju kā izceltu.');
$GLOBALS['TL_LANG']['tl_poll']['active_behaviorNotVoted']   = array('Lietotājs nav balsojis (aptauja ir aktīva)', 'Lūdzu, norādiet rīcību, ja lietotājs nav balsojis un aptauja ir aktīva.');
$GLOBALS['TL_LANG']['tl_poll']['active_behaviorVoted']      = array('Lietotājs ir balsojis (aptauja ir aktīva)', 'Lūdzu, norādiet rīcību, ja lietotājs ir balsojis un aptauja ir aktīva.');
$GLOBALS['TL_LANG']['tl_poll']['inactive_behaviorNotVoted'] = array('Lietotājs nav balsojis (aptauja nav aktīva)', 'Lūdzu, norādiet rīcību, ja lietotājs nav balsojis un aptauja nav aktīva.');
$GLOBALS['TL_LANG']['tl_poll']['inactive_behaviorVoted']    = array('Lietotājs ir balsojis (aptauja nav aktīva)', 'Lūdzu, norādiet rīcību, ja lietotājs ir balsojis un aptauja nav aktīva.');
$GLOBALS['TL_LANG']['tl_poll']['published']                 = array('Publicēt aptauju', 'Padariet aptauju publiski redzamu tīmekļa vietnē.');
$GLOBALS['TL_LANG']['tl_poll']['closed']                    = array('Aizvērt aptauju', 'Aizveriet aptauju un atspējojiet balsošanu.');
$GLOBALS['TL_LANG']['tl_poll']['activeStart']               = array('Aktīva no', 'DAtspējot balsošanu par aptauju pirms šīs dienas.');
$GLOBALS['TL_LANG']['tl_poll']['activeStop']                = array('Aktīva līdz', 'Atspējot balsošanu par aptauju šajā dienā un pēc tās.');
$GLOBALS['TL_LANG']['tl_poll']['showStart']                 = array('Rādīt no', 'Nerādīt aptauju vietnē pirms šīs dienas.');
$GLOBALS['TL_LANG']['tl_poll']['showStop']                  = array('Rādīt līdz', 'Nerādīt aptauju vietnē šajā dienā un pēc tās.');
$GLOBALS['TL_LANG']['tl_poll']['tstamp']                    = array('Pārskatīšanas datums', 'Jaunākās pārskatīšanas datums un laiks');



/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_poll']['title_legend']    = 'Nosaukums un rīcība';
$GLOBALS['TL_LANG']['tl_poll']['redirect_legend'] = 'Pārsūtīšanas iestatījumi';
$GLOBALS['TL_LANG']['tl_poll']['publish_legend']  = 'Publicēšanas iestatījumi';


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_poll']['type']['single']           = 'Viena balss (radio)';
$GLOBALS['TL_LANG']['tl_poll']['type']['multiple']         = 'Vairākas balsis (izvēles rūtiņa)';
$GLOBALS['TL_LANG']['tl_poll']['behaviorNotVoted']['opt1'] = 'Parādīt saiti "Parādīt rezultātus"';
$GLOBALS['TL_LANG']['tl_poll']['behaviorNotVoted']['opt2'] = 'Nerādīt rezultātus vispār';
$GLOBALS['TL_LANG']['tl_poll']['behaviorNotVoted']['opt3'] = 'Rādīt rezultātus nekavējoties';
$GLOBALS['TL_LANG']['tl_poll']['behaviorVoted']['opt1']    = 'Rādīt rezultātus nekavējoties';
$GLOBALS['TL_LANG']['tl_poll']['behaviorVoted']['opt2']    = 'Parādīt saiti "Parādīt rezultātus"';
$GLOBALS['TL_LANG']['tl_poll']['behaviorVoted']['opt3']    = 'Nerādīt rezultātus vispār';


/**
 * Miscellaneous
 */
$GLOBALS['TL_LANG']['tl_poll']['closedPoll'] = 'Slēgts';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_poll']['new']        = array('Jauna aptauja', 'Izveidojiet jaunu aptauju');
$GLOBALS['TL_LANG']['tl_poll']['show']       = array('Aptaujas detaļas', 'Parādiet aptaujas ID %s detaļas');
$GLOBALS['TL_LANG']['tl_poll']['edit']       = array('Rediģēt aptauju', 'Rediģēt aptauju ID %s');
$GLOBALS['TL_LANG']['tl_poll']['editheader'] = array('Rediģēt aptaujas iestatījumus', 'Rediģēt aptaujas ID %s iestatījumus');
$GLOBALS['TL_LANG']['tl_poll']['copy']       = array('Dublicēt aptauju', 'Dublicēt aptauju ID %s');
$GLOBALS['TL_LANG']['tl_poll']['delete']     = array('Dzēst aptauju', 'Dzēst aptauju ID %s');
$GLOBALS['TL_LANG']['tl_poll']['toggle']     = array('Publicēt/slēpt aptauju', 'Publicēt/slēpt aptauju ID %s');
$GLOBALS['TL_LANG']['tl_poll']['feature']    = array('Izcelt/neizcelt aptauju', 'Izcelt/neizcelt aptauju ID %s');
