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
 * @method mixed field(string|array $field)
 * @method mixed where(string $column, mixed $value)
 */
interface IQuery
{
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
     * 设置查询是否去重
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:24:38
     *
     * @param boolean $distinct
     * @return self
     */
    public function distinct(bool $distinct = true): self;

    /**
     * 设置查询字段
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:24:52
     *
     * @param string|array $field
     * @return self
     */
    public function field(string|array $field): self;

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
    public function join(string|array $table, Closure $on, string $type = 'INNER'): self;

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
    public function leftJoin(string|array $table, Closure $on): self;

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
    public function rightJoin(string|array $table, Closure $on): self;

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
    public function crossJoin(string|array $table, Closure $on): self;

    /**
     * 设置查询条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:26:16
     *
     * @param string $field
     * @param string $op
     * @param mixed $condition
     * @return self
     */
    public function where($field, $op = null, $condition = null): self;

    /**
     * 设置查询排序
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:26:30
     *
     * @param string $field
     * @param string $direction
     * @return self
     */
    public function order(string $field, string $direction = 'asc'): self;

    /**
     * 设置查询分组
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:26:44
     *
     * @param string $field
     * @return self
     */
    public function group(string $field): self;

    /**
     * 设置查询分组
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:26:58
     *
     * @param string $group
     * @return self
     */
    public function groupRaw(string $group): self;

    /**
     * 设置查询分组条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:27:12
     *
     * @param string $field
     * @param string $operator
     * @param mixed $value
     * @return self
     */
    public function having(string $field, string $operator, $value): self;

    /**
     * 设置查询分页
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:27:26
     *
     * @param int $page
     * @param int $limit
     * @return self
     */
    public function page(int $page, int $limit): self;

    /**
     * 设置查询分页
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:27:40
     *
     * @param int $limit
     * @return self
     */
    public function limit(int $limit): self;

    /**
     * 设置查询是否加锁
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:28:04
     *
     * @param boolean $lock
     * @return self
     */
    public function lock(bool $lock = true): self;

    /**
     * 设置查询注释
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:28:28
     *
     * @param string $comment
     * @return self
     */
    public function comment(string $comment): self;

    /**
     * 设置查询联合查询
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:28:42
     *
     * @param Closure $closure
     * @return self
     */
    public function union(Closure $closure): self;

    /**
     * 设置查询分区查询
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:29:06
     *
     * @param string $partition
     * @return self
     */
    public function partition(string $partition): self;

    /**
     * 获取查询字段值
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:29:20
     *
     * @param string $field
     * @param mixed $default
     * @return mixed
     */
    public function value(string $field, $default = null);

    /**
     * 获取查询第一条记录
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:29:34
     *
     * @return mixed
     */
    public function first();

    /**
     * 获取查询记录数组
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:29:48
     *
     * @return array
     */
    public function fetch(): array;

    /**
     * 获取查询分页记录
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:29:56
     *
     * @param PagingVar $paging
     * @return PagingCollection
     */
    public function paginate(PagingVar $paging): PagingCollection;

    /**
     * 分块查询处理
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:30:04
     *
     * @param int $size
     * @param callable $callback
     * @param string|null $column
     * @param string $order
     * @return void
     */
    public function chunk(int $size, callable $callback, ?string $column = null, string $order = 'asc');

    /**
     * 获取查询SQL语句
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:30:12
     *
     * @return string
     */
    public function toSql(): string;

    /**
     * 设置查询或条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:30:20
     *
     * @param string $field
     * @param null $op
     * @param null $condition
     * @return self
     */
    public function whereOr($field, $op = null, $condition = null): self;

    /**
     * 设置查询异或条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:30:28
     *
     * @param string $field
     * @param null $op
     * @param null $condition
     * @return self
     */
    public function whereXor($field, $op = null, $condition = null): self;

    /**
     * 设置查询空值条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:30:36
     *
     * @param string $field
     * @param string $logic
     * @return self
     */
    public function whereNull(string $field, string $logic = 'AND'): self;

    /**
     * 设置查询非空值条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:30:44
     *
     * @param string $field
     * @param string $logic
     * @return self
     */
    public function whereNotNull(string $field, string $logic = 'AND'): self;

    /**
     * 设置查询或空值条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:30:52
     *
     * @param string $field
     * @return self
     */
    public function whereOrNull(string $field): self;

    /**
     * 设置查询或非空值条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:31:00
     *
     * @param string $field
     * @return self
     */
    public function whereOrNotNull(string $field): self;

    /**
     * 设置查询存在条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:31:08
     *
     * @param mixed $condition
     * @param string $logic
     * @return self
     */
    public function whereExists($condition, string $logic = 'AND'): self;

    /**
     * 设置查询不存在条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:31:16
     *
     * @param mixed $condition
     * @param string $logic
     * @return self
     */
    public function whereNotExists($condition, string $logic = 'AND'): self;

    /**
     * 设置查询IN条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:31:24
     *
     * @param string $field
     * @param mixed $condition
     * @param string $logic
     * @return self
     */
    public function whereIn(string $field, $condition, string $logic = 'AND'): self;

    /**
     * 设置查询或IN条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:31:32
     *
     * @param string $field
     * @param mixed $condition
     * @return self
     */
    public function whereOrIn(string $field, $condition): self;

    /**
     * 设置查询不在IN条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:31:40
     *
     * @param string $field
     * @param mixed $condition
     * @param string $logic
     * @return self
     */
    public function whereNotIn(string $field, $condition, string $logic = 'AND'): self;

    /**
     * 设置查询或不在IN条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:31:48
     *
     * @param string $field
     * @param mixed $condition
     * @return self
     */
    public function whereOrNotIn(string $field, $condition): self;

    /**
     * 设置查询LIKE条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:31:56
     *
     * @param string $field
     * @param mixed $condition
     * @param string $logic
     * @return self
     */
    public function whereLike(string $field, $condition, string $logic = 'AND'): self;

    /**
     * 设置查询或LIKE条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:32:04
     *
     * @param string $field
     * @param mixed $condition
     * @return self
     */
    public function whereOrLike(string $field, $condition): self;

    /**
     * 设置查询不在LIKE条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:32:12
     *
     * @param string $field
     * @param mixed $condition
     * @param string $logic
     * @return self
     */
    public function whereNotLike(string $field, $condition, string $logic = 'AND'): self;

    /**
     * 设置查询或不在LIKE条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:32:20
     *
     * @param string $field
     * @param mixed $condition
     * @return self
     */
    public function whereOrNotLike(string $field, $condition): self;

    /**
     * 设置查询在BETWEEN条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:32:28
     *
     * @param string $field
     * @param mixed $condition
     * @param string $logic
     * @return self
     */
    public function whereBetween(string $field, $condition, string $logic = 'AND'): self;

    /**
     * 设置查询不在BETWEEN条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:32:36
     *
     * @param string $field
     * @param mixed $condition
     * @param string $logic
     * @return self
     */
    public function whereNotBetween(string $field, $condition, string $logic = 'AND'): self;

    /**
     * 设置查询或在BETWEEN条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:32:44
     *
     * @param string $field
     * @param mixed $condition
     * @return self
     */
    public function whereOrBetween(string $field, $condition): self;

    /**
     * 设置查询或不在BETWEEN条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:32:52
     *
     * @param string $field
     * @param mixed $condition
     * @return self
     */
    public function whereOrNotBetween(string $field, $condition): self;

    /**
     * 设置查询JSON包含条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:33:00
     *
     * @param string $field
     * @param mixed $condition
     * @param string $logic
     * @return self
     */
    public function whereJsonContains(string $field, $condition, string $logic = 'AND'): self;

    /**
     * 设置查询或JSON包含条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:33:08
     *
     * @param string $field
     * @param mixed $condition
     * @param string $logic
     * @return self
     */
    public function whereOrJsonContains(string $field, $condition, string $logic = 'AND'): self;

    /**
     * 设置查询列比较条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:33:16
     *
     * @param string $field1
     * @param string $operator
     * @param ?string $field2
     * @param string $logic
     * @return self
     */
    public function whereColumn(string $field1, string $operator, ?string $field2 = null, string $logic = 'AND'): self;

    /**
     * 设置查询或列比较条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:33:24
     *
     * @param string $field1
     * @param string $operator
     * @param ?string $field2
     * @return self
     */
    public function whereOrColumn(string $field1, string $operator, ?string $field2 = null): self;

    /**
     * 设置查询原始条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:33:32
     *
     * @param string $where
     * @param array $bind
     * @param string $logic
     * @return self
     */
    public function whereRaw(string $where, array $bind = [], string $logic = 'AND'): self;

    /**
     * 设置查询或原始条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:33:40
     *
     * @param string $where
     * @param array $bind
     * @param string $logic
     * @return self
     */
    public function whereOrRaw(string $where, array $bind = [], string $logic = 'AND'): self;

    /**
     * 条件成立后设置查询条件
     *
     * @author nece001@163.com
     * @create 2025-10-09 21:33:48
     *
     * @param mixed $condition
     * @param Closure|array $query
     * @param Closure|array|null $otherwise
     * @return self
     */
    public function when($condition, Closure | array $query, Closure | array | null $otherwise = null): self;
}
