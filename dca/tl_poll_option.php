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
 * Table tl_poll_option
 */
$GLOBALS['TL_DCA']['tl_poll_option'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_poll',
		'ctable'                      => array('tl_poll_votes'),
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'pid' => 'index'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'fields'                  => array('sorting'),
			'headerFields'            => array('title', 'tstamp', 'published'),
			'child_record_callback'   => array('tl_poll_option', 'listPollOptions')
		),
		'global_operations' => array
		(
			'reset' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_poll_option']['reset'],
				'href'                => 'key=reset',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['tl_poll_option']['reset'][2] . '\')) return false; Backend.getScrollOffset();"'
			),
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
				'label'               => &$GLOBALS['TL_LANG']['tl_poll_option']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_poll_option']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_poll_option']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_poll_option']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset(); return AjaxRequest.toggleVisibility(this, %s);"',
				'button_callback'     => array('tl_poll_option', 'toggleIcon')
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_poll_option']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			),
			'votes' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_poll_option']['votes'],
				'href'                => 'table=tl_poll_votes',
				'icon'                => 'system/modules/polls/assets/icon.png'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{title_legend},title,published'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array
		(
			'foreignKey'              => 'tl_poll.title',
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'sorting' => array
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
			'label'                   => &$GLOBALS['TL_LANG']['tl_poll_option']['title'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_poll_option']['published'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true, 'tl_class'=>'w50 m12'),
			'sql'                     => "char(1) NOT NULL default ''"
		)
	)
);


/**
 * Provide support for DC_Multilingual
 */
if (\Poll::checkMultilingual())
{
	$GLOBALS['TL_DCA']['tl_poll_option']['config']['dataContainer'] = 'Multilingual';
	$GLOBALS['TL_DCA']['tl_poll_option']['config']['languages'] = Poll::getAvailableLanguages();
	$GLOBALS['TL_DCA']['tl_poll_option']['config']['pidColumn'] = 'lid';
	$GLOBALS['TL_DCA']['tl_poll_option']['config']['fallbackLang'] = Poll::getFallbackLanguage();

	// Make "title" field translatable
	$GLOBALS['TL_DCA']['tl_poll_option']['fields']['title']['eval']['translatableFor'] = '*';
}


/**
 * Provide miscellaneous methods that are used by the data configuration array.
 */
class tl_poll_option extends Backend
{

    /**
     * Reset the poll and purge all votes
     */
    public function resetPoll()
    {
        if (\Input::get('key') != 'reset')
        {
            $this->redirect($this->getReferer());
        }

        $this->Database->prepare("DELETE FROM tl_poll_votes WHERE pid IN (SELECT id FROM tl_poll_option WHERE pid=?)")->execute(\Input::get('id'));
        $this->redirect(str_replace('&key=reset', '', \Environment::get('request')));
    }


	/**
	 * List poll options
	 * @param array
	 * @return string
	 */
	public function listPollOptions($arrRow)
	{
		static $intTotal;

		// Get the total number of votes
		if ($intTotal === null)
		{
			$intTotal = $this->Database->prepare("SELECT COUNT(*) AS total FROM tl_poll_votes WHERE pid IN (SELECT id FROM tl_poll_option WHERE pid=?)")
									   ->execute($arrRow['pid'])
									   ->total;
		}

		$intVotes = $this->Database->prepare("SELECT COUNT(*) AS total FROM tl_poll_votes WHERE pid=?")
								   ->execute($arrRow['id'])
								   ->total;

		$width = $intTotal ? (round(($intVotes / $intTotal), 2) * 200) : 0;
		$prcnt = $intTotal ? (round(($intVotes / $intTotal), 2) * 100) : 0;

		if (version_compare(VERSION, '4.4', '>=')) {
		    $height = 16;
        } else {
		    $height = 14;
        }

		return '<div><div style="display:inline-block;margin-right:8px;background-color:#8AB858;height:'.$height.'px;line-height:14px;text-align:right;width:' . ($width + 30) . 'px;"><span style="color:#ffffff;font-size:10px;margin-right:4px;">' . $prcnt . ' %</span></div>' . $arrRow['title'] . ' <span style="padding-left:3px;color:#b3b3b3;">[' . sprintf((($intVotes == 1) ? $GLOBALS['TL_LANG']['tl_poll_option']['voteSingle'] : $GLOBALS['TL_LANG']['tl_poll_option']['votePlural']), $intVotes) . ']</span></div>';
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
	 * Publish/unpublish a poll option
	 * @param integer
	 * @param boolean
	 */
	public function toggleVisibility($intId, $blnVisible)
	{
		$this->createInitialVersion('tl_poll_option', $intId);

		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_poll_option']['fields']['published']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_poll_option']['fields']['published']['save_callback'] as $callback)
			{
				$this->import($callback[0]);
				$blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
			}
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_poll_option SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);

		$this->createNewVersion('tl_poll_option', $intId);
	}
}
