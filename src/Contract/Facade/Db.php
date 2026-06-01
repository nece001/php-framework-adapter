<?php

namespace Nece\Framework\Adapter\Contract;

interface Db
{
    /**
     * 创建原始表达式.
     *
     * @param mixed $value 表达式值
     *
     * 使用方法：
     * - Db::raw('COUNT(*)')
     * - Db::raw('NOW()')
     *
     * @return mixed
     */
    public static function raw($value);

    /**
     * 创建函数表达式.
     *
     * @param string $func  函数名（如 COUNT, SUM, AVG, MIN, MAX）
     * @param string $field 字段名
     * @param string $alias 别名
     *
     * 使用方法：
     * - Db::rawFunc('COUNT', 'id', 'total')
     * - Db::rawFunc('SUM', 'amount', 'sum_amount')
     *
     * @return mixed
     */
    public static function rawFunc(string $func, string $field, string $alias);

    /**
     * 创建计数函数表达式.
     *
     * @param string $field 字段名
     * @param string $alias 别名
     *
     * 使用方法：
     * - Db::rawCount('id', 'user_count')
     *
     * @return mixed
     */
    public static function rawCount(string $field, string $alias);

    /**
     * 创建求和函数表达式.
     *
     * @param string $field 字段名
     * @param string $alias 别名
     *
     * 使用方法：
     * - Db::rawSum('price', 'total_price')
     *
     * @return mixed
     */
    public static function rawSum(string $field, string $alias);

    /**
     * 创建平均值函数表达式.
     *
     * @param string $field 字段名
     * @param string $alias 别名
     *
     * 使用方法：
     * - Db::rawAvg('score', 'avg_score')
     *
     * @return mixed
     */
    public static function rawAvg(string $field, string $alias);

    /**
     * 创建最小值函数表达式.
     *
     * @param string $field 字段名
     * @param string $alias 别名
     *
     * 使用方法：
     * - Db::rawMin('price', 'min_price')
     *
     * @return mixed
     */
    public static function rawMin(string $field, string $alias);

    /**
     * 创建最大值函数表达式.
     *
     * @param string $field 字段名
     * @param string $alias 别名
     *
     * 使用方法：
     * - Db::rawMax('price', 'max_price')
     *
     * @return mixed
     */
    public static function rawMax(string $field, string $alias);

    /**
     * 开启事务.
     *
     * 使用方法：
     * - Db::startTrans()
     *
     * @return void
     */
    public static function startTrans(): void;

    /**
     * 提交事务.
     *
     * 使用方法：
     * - Db::commit()
     *
     * @return void
     */
    public static function commit(): void;

    /**
     * 回滚事务.
     *
     * 使用方法：
     * - Db::rollback()
     *
     * @return void
     */
    public static function rollback(): void;

    /**
     * 执行事务回调.
     *
     * @param callable $callback 事务回调函数
     *
     * 使用方法：
     * - Db::transaction(function() {
     *     // 事务操作
     * });
     *
     * @return mixed
     */
    public static function transaction(callable $callback);

    /**
     * 执行SQL语句.
     *
     * @param string $sql SQL语句
     *
     * 使用方法：
     * - Db::execute('UPDATE users SET status = 1')
     *
     * @return mixed
     */
    public static function execute(string $sql);
}