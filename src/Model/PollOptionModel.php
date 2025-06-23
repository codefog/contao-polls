<?php

namespace Codefog\PollsBundle\Model;

use Contao\Model;
use Terminal42\DcMultilingualBundle\Model\Multilingual;

// Use the multilingual model if available
if (class_exists(Multilingual::class)) {
    class PollOptionParentModel extends Multilingual
    {
    }
} else {
    class PollOptionParentModel extends Model
    {
    }
}

class PollOptionModel extends PollOptionParentModel
{
	protected static $strTable = 'tl_poll_option';
}
