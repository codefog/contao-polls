<?php

namespace Codefog\PollsBundle\Model;

use Contao\Model;

class PollVoteModel extends Model
{
	protected static $strTable = 'tl_poll_vote';

    public static function countVotes(int $pollId): int
    {
        [$columns, $values] = static::generatePollCriteria($pollId);

        return static::countBy($columns, $values);
    }

    public static function hasIpVoted(int $pollId, int $expires, string $ip): bool
    {
        [$columns, $values] = static::generatePollCriteria($pollId, $expires);

        $columns[] = 'tstamp>?';
        $values[] = $expires;

        $columns[] = 'ip=?';
        $values[] = $ip;

        return static::findOneBy($columns, $values) !== null;
    }

    public static function hasMemberVoted(int $pollId, int $expires, int $memberId): bool
    {
        [$columns, $values] = static::generatePollCriteria($pollId, $expires);

        $columns[] = 'tstamp>?';
        $values[] = $expires;

        $columns[] = 'member=?';
        $values[] = $memberId;

        return static::findOneBy($columns, $values) !== null;
    }

    private static function generatePollCriteria(int $pollId): array
    {
        if (!static::isPreviewMode([])) {
            $columns[] = 'pid IN (SELECT id FROM tl_poll_option WHERE pid=? AND published=?)';
            $values[] = $pollId;
            $values[] = 1;
        } else {
            $columns[] = 'pid IN (SELECT id FROM tl_poll_option WHERE pid=?)';
            $values[] = $pollId;
        }

        return [$columns, $values];
    }
}
