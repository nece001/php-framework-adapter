<?php

namespace Nece\Framework\Adapter\DbAdapter;

use Nece\Framework\Adapter\Collection as BaseCollection;

class Collection extends BaseCollection
{
    use ModelCollectionTrait;

    /**
     * 根据条件筛选模型
     *
     * @param callable $callback
     * @return static
     */
    public function where(callable $callback)
    {
        $result = [];

        foreach ($this->all() as $item) {
            if ($callback($item)) {
                $result[] = $item;
            }
        }

        return new static($result);
    }

    /**
     * 根据字段值筛选模型
     *
     * @param string $column
     * @param mixed $value
     * @return static
     */
    public function whereColumn($column, $value)
    {
        $result = [];

        foreach ($this->all() as $item) {
            if (isset($item->$column) && $item->$column == $value) {
                $result[] = $item;
            }
        }

        return new static($result);
    }

    /**
     * 对集合中的模型进行排序
     *
     * @param string $column
     * @param string $direction
     * @return static
     */
    public function order($column, $direction = 'asc')
    {
        $items = $this->all();

        usort($items, function ($a, $b) use ($column, $direction) {
            $valueA = isset($a->$column) ? $a->$column : null;
            $valueB = isset($b->$column) ? $b->$column : null;

            if ($valueA == $valueB) {
                return 0;
            }

            $result = $valueA < $valueB ? -1 : 1;

            return strtolower($direction) === 'desc' ? -$result : $result;
        });

        return new static($items);
    }
}
