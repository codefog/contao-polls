<?php

use Contao\ArrayUtil;

// Backend modules
ArrayUtil::arrayInsert($GLOBALS['BE_MOD']['content'], 4, [
    'polls' => [
        'tables' => ['tl_poll', 'tl_poll_option', 'tl_poll_votes'],
        'reset' => [\Codefog\PollsBundle\BackendController\ResetPollController::class, '__invoke'],
    ],
]);

// Models
$GLOBALS['TL_MODELS']['tl_poll'] = \Codefog\PollsBundle\Model\PollModel::class;
$GLOBALS['TL_MODELS']['tl_poll_option'] = \Codefog\PollsBundle\Model\PollOptionModel::class;
$GLOBALS['TL_MODELS']['tl_poll_votes'] = \Codefog\PollsBundle\Model\PollVotesModel::class;
