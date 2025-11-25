<?php

namespace Nece\Framework\Adapter\Contract\DataBase;

use Closure;
use Nece\Gears\PagingCollection;
use Nece\Gears\PagingVar;

/**
 * 查询接口
 *
 * @author nece001@163.com
 * @create 2025-10-05 19:46:58
 * 
 * @template T
 * 
 * @method self where($field, $op = null, $condition = null)
 * @method IModel find($data = null, ?Closure $closure = null)
 * 
 */
interface IQuery
{

    /**
     * 获取原始查询对象
     *
     * @author nece001@163.com
     * @create 2025-11-09 16:50:21
     *
     * @return T
     */
    public function getQuery();

    /**
     * 获取查询别名
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:24:23
     *
     * @return string
     */
    public function getAlias(): string;

    /**
     * 设置查询字段
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:24:52
     *
     * @param string|array $field
     * @return self
     */
    public function field($field): self;

    /**
     * 获取查询SQL语句
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:24:38
     *
     * @return string
     */
    public function toSql(): string;

    /**
     * 设置查询连接
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:25:06
     *
     * @param string|array $table
     * @param Closure $on
     * @param string $type
     * @return self
     */
    public function join($table, Closure $on, string $type = 'INNER'): self;

    /**
     * 设置查询左连接
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:25:20
     *
     * @param string|array $table
     * @param Closure $on
     * @return self
     */
    public function leftJoin($table, Closure $on): self;

    /**
     * 设置查询右连接
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:25:34
     *
     * @param string|array $table
     * @param Closure $on
     * @return self
     */
    public function rightJoin($table, Closure $on): self;

    /**
     * 设置查询全连接
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:25:48
     *
     * @param string $table
     * @param Closure $on
     * @return self
     */
    public function fullJoin(string $table, Closure $on): self;

    /**
     * 设置查询交叉连接
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:26:02
     *
     * @param string|array $table
     * @param Closure $on
     * @return self
     */
    public function crossJoin($table, Closure $on): self;

    /**
     * 设置查询分组
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:26:16
     *
     * @param string|array $field
     * @return self
     */
    public function group($field): self;

    /**
     * 设置查询排序
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:26:30
     *
     * @param string|array $field
     * @param string $order
     * @return self
     */
    public function order($field, string $order = 'asc'): self;

    /**
     * 获取全部查询结果
     *
     * @author nece001@163.com
     * @create 2025-11-09 16:51:17
     *
     * @return array
     */
    public function select(): array;

    /**
     * 获取分页查询结果
     *
     * @author nece001@163.com
     * @create 2025-11-09 16:51:30
     *
     * @param int $page
     * @param int $size
     * @return array
     */
    public function paginate(int $page, int $size): array;
}
