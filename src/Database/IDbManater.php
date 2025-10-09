<?php

namespace Nece\Framework\Adapter\Contract\DataBase;

use Closure;

/**
 * 数据库管理器接口
 *
 * @template QueryBuilder
 * @template Expression
 * @author nece001@163.com
 * @create 2025-10-05 11:13:16
 */
interface IDbManater
{
    /**
     * 获取查询构建器
     *
     * @author nece001@163.com
     * @create 2025-10-05 11:28:24
     *
     * @param string $table 表名
     * @param string $as 别名
     * @return QueryBuilder
     */
    public static function table($table, $as = null);

    /**
     * 原始表达式
     *
     * @param  mixed  $value
     * @return Expression
     */
    public static function raw($value);

    /**
     * 原始函数表达式
     *
     * @author nece001@163.com
     * @create 2025-10-07 23:04:25
     *
     * @param string $func 函数名
     * @param string $field 字段名
     * @param string $alias 别名
     * @return Expression
     */
    public static function rawFunc(string $func, string $field, string $alias);

    /**
     * 计数函数表达式
     *
     * @author nece001@163.com
     * @create 2025-10-07 23:04:43
     *
     * @param string $field 字段名
     * @param string $alias 别名
     * @return Expression
     */
    public static function rawCount(string $field, string $alias);

    /**
     * 求和函数表达式
     *
     * @author nece001@163.com
     * @create 2025-10-07 23:04:52
     *
     * @param string $field 字段名
     * @param string $alias 别名
     * @return Expression
     */
    public static function rawSum(string $field, string $alias);

    /**
     * 平均值函数表达式
     *
     * @author nece001@163.com
     * @create 2025-10-07 23:05:01
     *
     * @param string $field 字段名
     * @param string $alias 别名
     * @return Expression
     */
    public static function rawAvg(string $field, string $alias);

    /**
     * 最小值函数表达式
     *
     * @author nece001@163.com
     * @create 2025-10-07 23:05:10
     *
     * @param string $field 字段名
     * @param string $alias 别名
     * @return Expression
     */
    public static function rawMin(string $field, string $alias);

    /**
     * 最大值函数表达式
     *
     * @author nece001@163.com
     * @create 2025-10-07 23:05:19
     *
     * @param string $field 字段名
     * @param string $alias 别名
     * @return Expression
     */
    public static function rawMax(string $field, string $alias);
}
