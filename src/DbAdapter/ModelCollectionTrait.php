<?php

namespace Nece\Framework\Adapter\DbAdapter;

/**
 * 数据库模型集合公共方法 Trait
 *
 * @author nece001@163.com
 * @create 2026-06-03
 */
trait ModelCollectionTrait
{
    /**
     * 获取所有主键值
     *
     * @return array
     */
    public function keys()
    {
        $result = [];

        foreach ($this->all() as $item) {
            if (method_exists($item, 'getKey')) {
                $result[] = $item->getKey();
            }
        }

        return $result;
    }

    /**
     * 获取指定字段的所有值
     *
     * @param string $column
     * @return array
     */
    public function column($column)
    {
        $result = [];

        foreach ($this->all() as $item) {
            if (isset($item->$column)) {
                $result[] = $item->$column;
            }
        }

        return $result;
    }

    /**
     * 批量更新字段值
     *
     * @param string $column
     * @param mixed $value
     * @return bool
     */
    public function update($column, $value)
    {
        foreach ($this->all() as $item) {
            if (method_exists($item, 'save')) {
                $item->$column = $value;
                $item->save();
            }
        }

        return true;
    }

    /**
     * 批量删除
     *
     * @return bool
     */
    public function delete()
    {
        foreach ($this->all() as $item) {
            if (method_exists($item, 'delete')) {
                $item->delete();
            }
        }

        return true;
    }

    /**
     * 将集合转换为数组（包含模型的数组表示）
     *
     * @return array
     */
    public function toArray()
    {
        $result = [];

        foreach ($this->all() as $key => $item) {
            if (method_exists($item, 'toArray')) {
                $result[$key] = $item->toArray();
            } else {
                $result[$key] = (array) $item;
            }
        }

        return $result;
    }
}
