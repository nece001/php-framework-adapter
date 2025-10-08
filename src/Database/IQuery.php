<?php

namespace Nece\Framework\Adapter\Contract\DataBase;

use Nece\Gears\PagingCollection;
use Nece\Gears\PagingVar;

/**
 * 查询接口
 *
 * @author nece001@163.com
 * @create 2025-10-05 19:46:58
 * 
 * @method mixed field(string|array $field)
 * @method mixed where(string $column, mixed $value)
 */
interface IQuery
{
    /**
     * 分页列表
     *
     * @author nece001@163.com
     * @create 2025-10-08 10:43:52
     *
     * @param PagingVar $paging
     * @return PagingCollection
     */
    public function paging(PagingVar $paging): PagingCollection;

    /**
     * 查询所有结果列表
     *
     * @author nece001@163.com
     * @create 2025-10-08 10:44:05
     *
     * @return array
     */
    public function fetch(): array;
}
