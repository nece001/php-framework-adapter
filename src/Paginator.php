<?php

namespace Nece\Framework\Adapter;

/**
 * 通用分页器实现
 *
 * @author nece001@163.com
 * @create 2026-06-01 10:24:47
 */
class Paginator extends Collection
{
    /**
     * 总记录数
     *
     * @var int
     */
    protected $total;

    /**
     * 每页数量
     *
     * @var int
     */
    protected $pageSize;

    /**
     * 当前页码
     *
     * @var int
     */
    protected $currentPage;

    /**
     * 构造函数
     *
     * @param array $items       当前页数据列表
     * @param int   $total       总记录数
     * @param int   $currentPage 当前页码
     * @param int   $pageSize    每页数量
     */
    public function __construct(array $items, int $total, int $currentPage, int $pageSize)
    {
        parent::__construct($items);
        $this->total = $total;
        $this->currentPage = max(1, $currentPage);
        $this->pageSize = max(1, $pageSize);
    }

    /**
     * 获取总记录数
     *
     * @return int
     */
    public function total(): int
    {
        return $this->total;
    }

    /**
     * 获取每页数量
     *
     * @return int
     */
    public function pageSize(): int
    {
        return $this->pageSize;
    }

    /**
     * 获取当前页码
     *
     * @return int
     */
    public function currentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * 获取总页数
     *
     * @return int
     */
    public function lastPage(): int
    {
        if ($this->total <= 0) {
            return 1;
        }
        return (int) ceil($this->total / $this->pageSize);
    }

    /**
     * 是否有上一页
     *
     * @return bool
     */
    public function hasPreviousPage(): bool
    {
        return $this->currentPage > 1;
    }

    /**
     * 是否有下一页
     *
     * @return bool
     */
    public function hasNextPage(): bool
    {
        return $this->currentPage < $this->lastPage();
    }

    /**
     * 是否是第一页
     *
     * @return bool
     */
    public function isFirstPage(): bool
    {
        return $this->currentPage === 1;
    }

    /**
     * 是否是最后一页
     *
     * @return bool
     */
    public function isLastPage(): bool
    {
        return $this->currentPage >= $this->lastPage();
    }

    /**
     * 获取上一页页码
     *
     * @return int|null
     */
    public function previousPage(): ?int
    {
        if ($this->hasPreviousPage()) {
            return $this->currentPage - 1;
        }
        return null;
    }

    /**
     * 获取下一页页码
     *
     * @return int|null
     */
    public function nextPage(): ?int
    {
        if ($this->hasNextPage()) {
            return $this->currentPage + 1;
        }
        return null;
    }

    /**
     * 获取分页数据数组
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'items' => $this->items(),
            'total' => $this->total(),
            'page_size' => $this->pageSize(),
            'current_page' => $this->currentPage(),
            'last_page' => $this->lastPage(),
            'has_previous_page' => $this->hasPreviousPage(),
            'has_next_page' => $this->hasNextPage(),
            'previous_page' => $this->previousPage(),
            'next_page' => $this->nextPage(),
            'first_item' => $this->firstItem(),
            'last_item' => $this->lastItem(),
        ];
    }

    /**
     * 获取当前页起始记录编号
     *
     * @return int
     */
    public function firstItem(): int
    {
        if ($this->total <= 0) {
            return 0;
        }
        return ($this->currentPage - 1) * $this->pageSize + 1;
    }

    /**
     * 获取当前页结束记录编号
     *
     * @return int
     */
    public function lastItem(): int
    {
        if ($this->total <= 0) {
            return 0;
        }
        return min($this->currentPage * $this->pageSize, $this->total);
    }
}