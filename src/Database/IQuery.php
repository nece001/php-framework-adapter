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
    public function fetch(): array;
}
