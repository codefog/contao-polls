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
 * Table tl_poll_votes 
 */
$GLOBALS['TL_DCA']['tl_poll_votes'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_poll_option',
		'closed'                      => true,
		'doNotCopyRecords'            => true,
		'notEditable'                 => true,
		'onload_callback' => array
		(
			array('tl_poll_votes', 'filterItemsByParent')
		),
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
			'mode'                    => 1,
			'fields'                  => array('tstamp'),
			'flag'                    => 12,
			'panelLayout'             => 'filter;search,limit',
		),
		'label' => array
		(
			'fields'                  => array('tstamp', 'ip', 'member'),
			'showColumns'             => true,
			'label_callback'          => array('tl_poll_votes', 'addMemberUsername')
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
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_poll_votes']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_poll_votes']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
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
			'foreignKey'              => 'tl_poll_option.title',
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'tstamp' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_poll_votes']['tstamp'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 8,
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'ip' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_poll_votes']['ip'],
			'exclude'                 => true,
			'filter'                  => true,
			'search'                  => true,
			'sql'                     => "varchar(16) NOT NULL default ''"
		),
		'member' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_poll_votes']['member'],
			'exclude'                 => true,
			'filter'                  => true,
			'search'                  => true,
			'foreignKey'              => 'tl_member.username',
			'reference'               => array(0=>$GLOBALS['TL_LANG']['tl_poll_votes']['anonymous']),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		)
	)
);


/**
 * Provide miscellaneous methods that are used by the data configuration array.
 */
class tl_poll_votes extends Backend
{

	/**
	 * Limit the displayed items so filter panel can handle things correctly
	 */
	public function filterItemsByParent()
	{
		$GLOBALS['TL_DCA']['tl_poll_votes']['list']['sorting']['root'] = $this->Database->prepare("SELECT id FROM tl_poll_votes WHERE pid=?")->execute($this->Input->get('id'))->fetchEach('id');
	}


	/**
	 * Add a member username
	 * @param array
	 * @param string
	 * @param DataContainer
	 * @param array
	 * @return string
	 */
	public function addMemberUsername($row, $label, DataContainer $dc, $args)
	{
		if ($row['member'])
		{
			$objMember = $this->Database->prepare("SELECT * FROM tl_member WHERE id=?")
										->execute($row['member']);

			if ($objMember->numRows)
			{
				$args[2] = '<a href="contao/main.php?do=member&act=show&id=' . $row['member'] . '&rt=' . REQUEST_TOKEN . '">' . $objMember->username . ' (ID ' . $row['member'] . ')</a>';
			}
		}

		return $args;
	}
}
