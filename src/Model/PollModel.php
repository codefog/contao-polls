<?php

namespace Codefog\PollsBundle\Model;

use Contao\Date;
use Contao\Model;
use Contao\Model\Collection;
use Terminal42\DcMultilingualBundle\Model\Multilingual;

// Use the multilingual model if available
if (class_exists(Multilingual::class)) {
    class PollParentModel extends Multilingual
    {
    }
} else {
    class PollParentModel extends Model
    {
    }
}

class PollModel extends PollParentModel
{
    protected static $strTable = 'tl_poll';

    /**
     * @return Collection|PollOptionModel[]|null
     */
    public function getOptions(): Collection|null
    {
        return PollOptionModel::findBy('pid', $this->id, ['order' => 'sorting']);
    }

    public function isActive(): bool
    {
        $time = Date::floorToMinute();

        if ($this->closed) {
            return false;
        }

        if (($this->activeStart && $this->activeStart > $time) || ($this->activeStop && $this->activeStop < $time)) {
            return false;
        }

        return true;
    }

    public static function findCurrentPublished(): static|null
    {
        $time = Date::floorToMinute();
        $columns = ["(showStart='' OR showStart<?) AND (showStop='' OR showStop>?)"];
        $values = [$time, $time];

        if (!static::isPreviewMode([])) {
            $columns[] = 'published=?';
            $values[] = 1;
        }

        return static::findOneBy($columns, $values, ['order' => 'showStart DESC, activeStart DESC']);
    }

    public static function findPublishedById(int $id): static|null
    {
        if (!$id) {
            return null;
        }

        $columns = ['id=?'];
        $values = [$id];

        if (!static::isPreviewMode([])) {
            $columns[] = 'published=?';
            $values[] = 1;
        }

        return static::findOneBy($columns, $values);
    }

    public static function countByCriteria(array $criteria): int
    {
        [$columns, $values] = static::getColumnsValuesFromCriteria($criteria);

        if (count($columns) === 0) {
            return static::countAll();
        }

        return static::countBy($columns, $values);
    }

    public static function findByCriteria(array $criteria, int $limit, int $offset): Collection|null
    {
        $options = [
            'limit' => $limit,
            'offset' => $offset,
            'order' => 'closed ASC, showStart DESC, activeStart DESC',
        ];

        [$columns, $values] = static::getColumnsValuesFromCriteria($criteria);

        if (count($columns) === 0) {
            return static::findAll($options);
        }

        return static::findBy($columns, $values, $options);
    }

    private static function getColumnsValuesFromCriteria(array $criteria): array
    {
        $time = Date::floorToMinute();
        $columns = [];
        $values = [];

        if (isset($criteria['active'])) {
            switch($criteria['active']) {
                case 'yes':
                    $columns[] = "closed='' AND (activeStart='' OR activeStart<$time) AND (activeStop='' OR activeStop>$time)";
                    break;
                case 'no':
                    $columns[] = "(closed=1 OR ((activeStart!='' AND activeStart>=$time) OR (activeStop!='' AND activeStop<=$time)))";
                    break;
            }
        }

        if (isset($criteria['featured'])) {
            switch($criteria['featured']) {
                case 'yes':
                    $columns[] = "featured=1";
                    break;
                case 'no':
                    $columns[] = "featured=''";
                    break;
            }
        }

        if (isset($criteria['visible'])) {
            switch($criteria['visible']) {
                case 'yes':
                    $columns[] = "(showStart='' OR showStart<$time) AND (showStop='' OR showStop>$time)";
                    break;
                case 'no':
                    $columns[] = "((showStart!='' AND showStart>=$time) OR (showStop!='' AND showStop<=$time))";
                    break;
            }
        }

        if (!static::isPreviewMode([])) {
            $columns[] = 'published=?';
            $values[] = 1;
        }

        return [$columns, $values];
    }
}
