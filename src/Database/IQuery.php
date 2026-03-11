<?php

namespace Nece\Framework\Adapter\Contract\DataBase;

use Closure;

/**
 * 查询接口
 *
 * @author nece001@163.com
 * @create 2025-10-05 19:46:58
 * 
 * @template T
 * 
 * @method IModel find($data = null, ?Closure $closure = null)
 * @method self where($field, $op = null, $condition = null)
 * @method self whereIn($field, $condition = null)
 * @method self when($condition, Closure $closure)
 * @method int count()
 * @method int min(string $field)
 * @method int max(string $field)
 * @method int sum(string $field)
 * @method int avg(string $field)
 * @method array column(string $field)
 * @method mixed value(string $field)
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
     * 设置原生排序
     *
     * @author nece001@163.com
     * @create 2026-03-07 15:47:25
     *
     * @param string $order
     * @return self
     */
    public function orderRaw($order): self;

    /**
     * 增加字段值
     *
     * @author nece001@163.com
     * @create 2026-03-07 15:48:42
     *
     * @param string $field
     * @param int $step
     * @return self
     */
    public function increment(string $field, int $step = 1): self;

    /**
     * 设置查询锁
     *
     * @author nece001@163.com
     * @create 2026-03-07 15:50:52
     *
     * @param bool $lock 是否加锁
     * @return self
     */
    public function lock($lock = false): self;

    /**
     * 设置偏移
     *
     * @author nece001@163.com
     * @create 2026-03-10 13:45:39
     *
     * @param integer $offset
     * @return self
     */
    public function offset(int $offset): self;

    /**
     * 设置限制数
     *
     * @author nece001@163.com
     * @create 2026-03-10 13:45:51
     *
     * @param integer $limit
     * @return self
     */
    public function limit(int $limit): self;

    /**
     * 更新查询
     *
     * @author nece001@163.com
     * @create 2026-03-07 15:51:44
     *
     * @param array $data
     * @return int
     */
    public function update(array $data = []): int;

    /**
     * 设置查询注释
     *
     * @author nece001@163.com
     * @create 2026-03-07 16:09:00
     *
     * @param string $comment
     * @return self
     */
    public function comment($comment): self;

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

    /**
     * 返回列的数组
     *
     * @author nece001@163.com
     * @create 2026-02-25 13:59:27
     *
     * @param string|array $field
     * @param string $key
     * @return array
     */
    public function pluck($field, $key = ''): array;
}