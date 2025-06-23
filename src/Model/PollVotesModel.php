<?php

namespace Codefog\PollsBundle\Model;

use Contao\Model;

class PollVotesModel extends Model
{
	protected static $strTable = 'tl_poll_votes';

    public static function hasIpVoted(int $pollId, int $expires, string $ip): bool
    {
        [$columns, $values] = static::generateVotedCriteria($pollId, $expires);

        $columns[] = 'ip=?';
        $values[] = $ip;

        return static::findOneBy($columns, $values) !== null;
    }

    public static function hasMemberVoted(int $pollId, int $expires, int $memberId): bool
    {
        [$columns, $values] = static::generateVotedCriteria($pollId, $expires);

        $columns[] = 'member=?';
        $values[] = $memberId;

        return static::findOneBy($columns, $values) !== null;
    }

    private static function generateVotedCriteria(int $pollId, int $expires): array
    {
        $columns = ['tstamp>?'];
        $values = [$expires];

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
