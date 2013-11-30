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

namespace Polls;


/**
 * Front end module "poll list".
 */
class ModulePollList extends \Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_polllist';


	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### POLL LIST ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		return parent::generate();
	}


	/**
	 * Generate the module
	 */
	protected function compile()
	{
		$time = time();
		$offset = 0;
		$limit = null;
		$arrPolls = array();
		$arrWhere = array();

		// Maximum number of items
		if ($this->numberOfItems > 0)
		{
			$limit = $this->numberOfItems;
		}

		// Build the criteria
		if ($this->poll_visible == 'yes')
		{
			$arrWhere[] = "(showStart='' OR showStart<$time) AND (showStop='' OR showStop>$time)";
		}
		elseif ($this->poll_visible == 'no')
		{
			$arrWhere[] = "((showStart!='' AND showStart>=$time) OR (showStop!='' AND showStop<=$time))";
		}
		if ($this->poll_active == 'yes')
		{
			$arrWhere[] = "closed='' AND (activeStart='' OR activeStart<$time) AND (activeStop='' OR activeStop>$time)";
		}
		elseif ($this->poll_active == 'no')
		{
			$arrWhere[] = "(closed=1 OR ((activeStart!='' AND activeStart>=$time) OR (activeStop!='' AND activeStop<=$time)))";
		}
		if ($this->poll_featured == 'yes')
		{
			$arrWhere[] = "featured=1";
		}
		elseif ($this->poll_featured == 'no')
		{
			$arrWhere[] = "featured=''";
		}
		if (!BE_USER_LOGGED_IN)
		{
			$arrWhere[] = "published=1";
		}

		$total = $this->Database->execute("SELECT COUNT(*) AS total FROM tl_poll" . (!empty($arrWhere) ? " WHERE ".implode(" AND ", $arrWhere) : ""))->total;

		// Split the results
		if ($this->perPage > 0 && (!isset($limit) || $this->numberOfItems > $this->perPage))
		{
			// Adjust the overall limit
			if (isset($limit))
			{
				$total = min($limit, $total);
			}

			// Get the current page
			$id = 'page_n' . $this->id;
			$page = \Input::get($id) ?: 1;

			// Do not index or cache the page if the page number is outside the range
			if ($page < 1 || $page > max(ceil($total/$this->perPage), 1))
			{
				global $objPage;
				$objPage->noSearch = 1;
				$objPage->cache = 0;

				// Send a 404 header
				header('HTTP/1.1 404 Not Found');
				return;
			}

			// Set limit and offset
			$limit = $this->perPage;
			$offset = (max($page, 1) - 1) * $this->perPage;

			// Overall limit
			if ($offset + $limit > $total)
			{
				$limit = $total - $offset;
			}

			// Add the pagination menu
			$objPagination = new \Pagination($total, $this->perPage, 7, $id);
			$this->Template->pagination = $objPagination->generate("\n  ");
		}

		$objPollsStmt = $this->Database->prepare("SELECT * FROM tl_poll" . (!empty($arrWhere) ? " WHERE ".implode(" AND ", $arrWhere) : "") . " ORDER BY closed ASC, showStart DESC, activeStart DESC");

		// Limit the result
		if (isset($limit))
		{
			$objPollsStmt->limit($limit, $offset);
		}

		$objPolls = $objPollsStmt->execute();

		// Generate the polls
		while ($objPolls->next())
		{
			$objPoll = new \Poll($objPolls->id);
			$arrPolls[] = $objPoll->generate();
		}

		$this->Template->polls = $arrPolls;
	}
}
