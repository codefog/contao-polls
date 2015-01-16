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
 * Class PollOptionModel
 *
 * Reads and writes poll options.
 */
class PollOptionModel extends \Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_poll_option';
}
