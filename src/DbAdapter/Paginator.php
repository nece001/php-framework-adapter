<?php

namespace Nece\Framework\Adapter\DbAdapter;

use Nece\Framework\Adapter\Paginator as BasePaginator;

/**
 * 数据库模型专用分页器
 *
 * @author nece001@163.com
 * @create 2026-06-03
 */
class Paginator extends BasePaginator
{
    use ModelCollectionTrait;

    /**
     * 获取分页数据数组（模型转数组）
     *
     * @return array
     */
    public function toArray(): array
    {
        $items = parent::toArray();

        return [
            'data' => $items,
            'total' => $this->total(),
            'per_page' => $this->pageSize(),
            'current_page' => $this->currentPage(),
            'last_page' => $this->lastPage(),
            'first_page' => 1,
            'has_previous_page' => $this->hasPreviousPage(),
            'has_next_page' => $this->hasNextPage(),
            'first_item' => $this->firstItem(),
            'last_item' => $this->lastItem(),
        ];
    }
}
