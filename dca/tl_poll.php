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
 * Load tl_module language files
 */
System::loadLanguageFile('tl_module');


/**
 * Table tl_poll 
 */
$GLOBALS['TL_DCA']['tl_poll'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ctable'                      => array('tl_poll_option'),
		'switchToEdit'                => true,
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('title'),
			'flag'                    => 1,
			'panelLayout'             => 'filter;search,limit',
		),
		'label' => array
		(
			'fields'                  => array('title'),
			'format'                  => '%s',
			'label_callback'          => array('tl_poll', 'addStatus')
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_poll']['edit'],
				'href'                => 'table=tl_poll_option',
				'icon'                => 'edit.gif',
				'attributes'          => 'class="contextmenu"'
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_poll']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif',
				'attributes'          => 'class="edit-header"'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_poll']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_poll']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_poll']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset(); return AjaxRequest.toggleVisibility(this, %s);"',
				'button_callback'     => array('tl_poll', 'toggleIcon')
			),
			'feature' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_poll']['feature'],
				'icon'                => 'featured.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset(); return AjaxRequest.toggleFeatured(this, %s);"',
				'button_callback'     => array('tl_poll', 'iconFeatured')
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_poll']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{title_legend},title,voteInterval,protected,featured,active_behaviorNotVoted,active_behaviorVoted,inactive_behaviorNotVoted,inactive_behaviorVoted;{redirect_legend:hide},jumpTo;{publish_legend},published,closed,activeStart,activeStop,showStart,showStop'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'lid' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'language' => array
		(
			'sql'                     => "varchar(2) NOT NULL default ''"
		),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_poll']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'voteInterval' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_poll']['voteInterval'],
			'default'                 => 86400,
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit', 'tl_class'=>'w50'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'protected' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_poll']['protected'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'featured' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_poll']['featured'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'active_behaviorNotVoted' => array
 		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_poll']['active_behaviorNotVoted'],
 			'default'                 => 'opt1',
 			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('opt1', 'opt2'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_poll']['behaviorNotVoted'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(4) NOT NULL default ''"
		),
		'active_behaviorVoted' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_poll']['active_behaviorVoted'],
			'default'                 => 'opt1',
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('opt1', 'opt2', 'opt3'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_poll']['behaviorVoted'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(4) NOT NULL default ''"
 		),
		'inactive_behaviorNotVoted' => array
 		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_poll']['inactive_behaviorNotVoted'],
 			'default'                 => 'opt1',
 			'exclude'                 => true,
			'inputType'               => 'select',
 			'options'                 => array('opt1', 'opt2'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_poll']['behaviorNotVoted'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(4) NOT NULL default ''"
		),
		'inactive_behaviorVoted' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_poll']['inactive_behaviorVoted'],
			'default'                 => 'opt1',
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('opt1', 'opt2', 'opt3'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_poll']['behaviorVoted'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(4) NOT NULL default ''"
		),
		'jumpTo' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_module']['jumpTo'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'pageTree',
			'eval'                    => array('fieldType'=>'radio', 'tl_class'=>'clr'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_poll']['published'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true, 'tl_class'=>'w50'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'closed' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_poll']['closed'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true, 'tl_class'=>'w50'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'activeStart' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_poll']['activeStart'],
			'exclude'                 => true,
			'search'                  => true,
			'flag'                    => 8,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'activeStop' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_poll']['activeStop'],
			'exclude'                 => true,
			'search'                  => true,
			'flag'                    => 8,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'showStart' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_poll']['showStart'],
			'exclude'                 => true,
			'search'                  => true,
			'flag'                    => 8,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'showStop' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_poll']['showStop'],
			'exclude'                 => true,
			'search'                  => true,
			'flag'                    => 8,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "varchar(10) NOT NULL default ''"
		)
	)
);


/**
 * Provide support for DC_Multilingual
 */
if (\Poll::checkMultilingual())
{
	$GLOBALS['TL_DCA']['tl_poll']['config']['dataContainer'] = 'Multilingual';
	$GLOBALS['TL_DCA']['tl_poll']['config']['languages'] = Poll::getAvailableLanguages();
	$GLOBALS['TL_DCA']['tl_poll']['config']['pidColumn'] = 'lid';
	$GLOBALS['TL_DCA']['tl_poll']['config']['fallbackLang'] = Poll::getFallbackLanguage();

	// Make "title" field translatable
	$GLOBALS['TL_DCA']['tl_poll']['fields']['title']['eval']['translatableFor'] = '*';
}


/**
 * Provide miscellaneous methods that are used by the data configuration array.
 */
class tl_poll extends Backend
{

	/**
	 * Add the poll status
	 * @param array
	 * @param string
	 * @return string
	 */
	public function addStatus($arrRow, $strLabel)
	{
		if ($arrRow['closed'])
		{
			$strLabel .= ' <span style="padding-left:3px;color:#b3b3b3;">[' . $GLOBALS['TL_LANG']['tl_poll']['closedPoll'] . ']</span>';
		}

		return $strLabel;
	}


	/**
	 * Return the "feature/unfeature element" button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function iconFeatured($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen($this->Input->get('fid')))
		{
			$this->toggleFeatured($this->Input->get('fid'), ($this->Input->get('state') == 1));
			$this->redirect($this->getReferer());
		}

		$href .= '&amp;fid='.$row['id'].'&amp;state='.($row['featured'] ? '' : 1);

		if (!$row['featured'])
		{
			$icon = 'featured_.gif';
		}		

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}


	/**
	 * Feature/unfeature a poll
	 * @param integer
	 * @param boolean
	 * @return string
	 */
	public function toggleFeatured($intId, $blnVisible)
	{
		$this->createInitialVersion('tl_poll', $intId);
	
		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_poll']['fields']['featured']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_poll']['fields']['featured']['save_callback'] as $callback)
			{
				$this->import($callback[0]);
				$blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
			}
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_poll SET tstamp=". time() .", featured='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);

		$this->createNewVersion('tl_poll', $intId);
	}


	/**
	 * Return the "toggle visibility" button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen($this->Input->get('tid')))
		{
			$this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 1));
			$this->redirect($this->getReferer());
		}

		$href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

		if (!$row['published'])
		{
			$icon = 'invisible.gif';
		}		

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}


	/**
	 * Publish/unpublish a poll
	 * @param integer
	 * @param boolean
	 */
	public function toggleVisibility($intId, $blnVisible)
	{
		$this->createInitialVersion('tl_poll', $intId);
	
		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_poll']['fields']['published']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_poll']['fields']['published']['save_callback'] as $callback)
			{
				$this->import($callback[0]);
				$blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
			}
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_poll SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);

		$this->createNewVersion('tl_poll', $intId);
	}
}
