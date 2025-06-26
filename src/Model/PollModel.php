<?php

namespace Codefog\PollsBundle\Model;

use Codefog\PollsBundle\EventListener\LoadDataContainerListener;
use Contao\Date;
use Contao\Model;
use Contao\Model\Collection;
use Terminal42\DcMultilingualBundle\Model\Multilingual;

// Use the multilingual model if available
if (LoadDataContainerListener::checkMultilingual()) {
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
        $t = static::getTable();
        $time = Date::floorToMinute();
        $columns = ["($t.showStart='' OR $t.showStart<?) AND ($t.showStop='' OR $t.showStop>?)"];
        $values = [$time, $time];

        if (!static::isPreviewMode([])) {
            $columns[] = "$t.published=?";
            $values[] = 1;
        }

        return static::findOneBy($columns, $values, ['order' => "$t.showStart DESC, $t.activeStart DESC"]);
    }

    public static function findPublishedById(int $id): static|null
    {
        if (!$id) {
            return null;
        }

        $t = static::getTable();
        $columns = ["$t.id=?"];
        $values = [$id];

        if (!static::isPreviewMode([])) {
            $columns[] = "$t.published=?";
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
        $t = static::getTable();

        $options = [
            'limit' => $limit,
            'offset' => $offset,
            'order' => "$t.closed ASC, $t.showStart DESC, $t.activeStart DESC",
        ];

        [$columns, $values] = static::getColumnsValuesFromCriteria($criteria);

        if (count($columns) === 0) {
            return static::findAll($options);
        }

        return static::findBy($columns, $values, $options);
    }

    private static function getColumnsValuesFromCriteria(array $criteria): array
    {
        $t = static::getTable();
        $time = Date::floorToMinute();
        $columns = [];
        $values = [];

        if (isset($criteria['active'])) {
            switch($criteria['active']) {
                case 'yes':
                    $columns[] = "$t.closed='' AND ($t.activeStart='' OR $t.activeStart<$time) AND ($t.activeStop='' OR $t.activeStop>$time)";
                    break;
                case 'no':
                    $columns[] = "($t.closed=1 OR (($t.activeStart!='' AND $t.activeStart>=$time) OR ($t.activeStop!='' AND $t.activeStop<=$time)))";
                    break;
            }
        }

        if (isset($criteria['featured'])) {
            switch($criteria['featured']) {
                case 'yes':
                    $columns[] = "$t.featured=1";
                    break;
                case 'no':
                    $columns[] = "$t.featured=''";
                    break;
            }
        }

        if (isset($criteria['visible'])) {
            switch($criteria['visible']) {
                case 'yes':
                    $columns[] = "($t.showStart='' OR $t.showStart<$time) AND ($t.showStop='' OR $t.showStop>$time)";
                    break;
                case 'no':
                    $columns[] = "(($t.showStart!='' AND $t.showStart>=$time) OR ($t.showStop!='' AND $t.showStop<=$time))";
                    break;
            }
        }

        if (!static::isPreviewMode([])) {
            $columns[] = "$t.published=?";
            $values[] = 1;
        }

        return [$columns, $values];
    }
}
