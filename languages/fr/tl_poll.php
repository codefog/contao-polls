<?php

/**
 * polls extension for Contao Open Source CMS
 *
 * Copyright (C) 2014 Codefog
 *
 * @package polls
 * @author  Codefog <http://codefog.pl>
 * @author  Kamil Kuzminski <kamil.kuzminski@codefog.pl>
 * Translator: Lionel Maccaud (https://github.com/lionel-m)
 * @license LGPL
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_poll']['title']                     = array('Titre', 'Veuillez, s\'il vous plaît, insérer le titre du sondage.');
$GLOBALS['TL_LANG']['tl_poll']['type']                      = array('Type', 'Ici vous pouvez choisir le type de sondage.');
$GLOBALS['TL_LANG']['tl_poll']['voteInterval']              = array('Intervalle entre chaque vote', 'Ici vous pouvez définir la valeur du temps en seconde avant qu\'un utilisateur puisse voter à nouveau. Mettre à 0 si le vote ne peut être effectué qu\'une seule fois.');
$GLOBALS['TL_LANG']['tl_poll']['protected']                 = array('Sondage protégé', 'Seuls les utilisateurs identifiés pourront voter.');
$GLOBALS['TL_LANG']['tl_poll']['featured']                  = array('Sondage vedette', 'Définir le sondage en tant que vedette.');
$GLOBALS['TL_LANG']['tl_poll']['active_behaviorNotVoted']   = array('L\'utilisateur n\'a pas voté (sondage actif)', 'Veuillez, s\'il vous plaît, spécifier le comportement à appliquer si l\'utilisateur n\'a pas voté et que le sondage est actif.');
$GLOBALS['TL_LANG']['tl_poll']['active_behaviorVoted']      = array('L\'utilisateur a voté (sondage actif)', 'Veuillez, s\'il vous plaît, spécifier le comportement à appliquer si l\'utilisateur a voté et que le sondage est actif.');
$GLOBALS['TL_LANG']['tl_poll']['inactive_behaviorNotVoted'] = array('L\'utilisateur n\'a pas voté (sondage inactif)', 'Veuillez, s\'il vous plaît, spécifier le comportement à appliquer si l\'utilisateur n\'a pas voté et que le sondage est inactif.');
$GLOBALS['TL_LANG']['tl_poll']['inactive_behaviorVoted']    = array('L\'utilisateur a voté (sondage inactif)', 'Veuillez, s\'il vous plaît, spécifier le comportement à appliquer si l\'utilisateur a voté et que le sondage est inactif.');
$GLOBALS['TL_LANG']['tl_poll']['published']                 = array('Publier le sondage', 'Rendre le sondage publiquement visible sur le site internet.');
$GLOBALS['TL_LANG']['tl_poll']['closed']                    = array('Clore le sondage', 'Clore le sondage et désactiver le vote.');
$GLOBALS['TL_LANG']['tl_poll']['activeStart']               = array('Actif à partir du', 'Désactiver le vote du sondage avant ce jour.');
$GLOBALS['TL_LANG']['tl_poll']['activeStop']                = array('Actif jusqu\'au', 'Désactiver le vote du sondage à compter de ce jour.');
$GLOBALS['TL_LANG']['tl_poll']['showStart']                 = array('Afficher à partir du', 'Ne pas activer le vote du sondage sur le site avant ce jour.');
$GLOBALS['TL_LANG']['tl_poll']['showStop']                  = array('Afficher jusqu\'au', 'Désactiver le vote du sondage sur le site à compter de ce jour.');
$GLOBALS['TL_LANG']['tl_poll']['tstamp']                    = array('Date de révision', 'Date et heure de la dernière révision');



/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_poll']['title_legend']    = 'Titre et comportement';
$GLOBALS['TL_LANG']['tl_poll']['redirect_legend'] = 'Paramètres de redirection';
$GLOBALS['TL_LANG']['tl_poll']['publish_legend']  = 'Paramètres de publication';


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_poll']['type']['single']           = 'Vote simple (radio)';
$GLOBALS['TL_LANG']['tl_poll']['type']['multiple']         = 'Vote multiple (case à cocher)';
$GLOBALS['TL_LANG']['tl_poll']['behaviorNotVoted']['opt1'] = 'Afficher un lien "Afficher les résultats"';
$GLOBALS['TL_LANG']['tl_poll']['behaviorNotVoted']['opt2'] = 'Ne pas afficher les résultats';
$GLOBALS['TL_LANG']['tl_poll']['behaviorNotVoted']['opt3'] = 'Afficher les résultats immédiatement';
$GLOBALS['TL_LANG']['tl_poll']['behaviorVoted']['opt1']    = 'Afficher les résultats immédiatement';
$GLOBALS['TL_LANG']['tl_poll']['behaviorVoted']['opt2']    = 'Afficher un lien "Afficher les résultats"';
$GLOBALS['TL_LANG']['tl_poll']['behaviorVoted']['opt3']    = 'Ne pas afficher les résultats';


/**
 * Miscellaneous
 */
$GLOBALS['TL_LANG']['tl_poll']['closedPoll'] = 'Clos';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_poll']['new']        = array('Nouveau sondage', 'Créer un nouveau sondage');
$GLOBALS['TL_LANG']['tl_poll']['show']       = array('Afficher les détails du sondage', 'Afficher les détails du sondage avec l\'ID %s');
$GLOBALS['TL_LANG']['tl_poll']['edit']       = array('Éditer le sondage', 'Éditer le sondage avec l\'ID %s');
$GLOBALS['TL_LANG']['tl_poll']['editheader'] = array('Éditer les paramètres du sondage', 'Éditer les paramètres du sondage avec l\'ID %s');
$GLOBALS['TL_LANG']['tl_poll']['copy']       = array('Dupliquer le sondage', 'Dupliquer le sondage avec l\'ID %s');
$GLOBALS['TL_LANG']['tl_poll']['delete']     = array('Supprimer le sondage', 'Supprimer le sondage avec l\'ID %s');
$GLOBALS['TL_LANG']['tl_poll']['toggle']     = array('Publier/Dépublier le sondage', 'Publier/Dépublier le sondage avec l\'ID %s');
$GLOBALS['TL_LANG']['tl_poll']['feature']    = array('Définir le sondage en tant que vedette ou standard', 'Définir le sondage en tant que vedette ou standard avec l\'ID %s');
