<?php

namespace Codefog\PollsBundle\Model;

use Codefog\PollsBundle\EventListener\LoadDataContainerListener;
use Contao\Model;
use Terminal42\DcMultilingualBundle\Model\Multilingual;

// Use the multilingual model if available
if (LoadDataContainerListener::checkMultilingual()) {
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

    public function countVotes(): int
    {
        return PollVoteModel::countBy('pid', $this->id);
    }
}
