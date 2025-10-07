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
     * 查询单条记录
     *
     * @param  string  $query
     * @param  array  $bindings
     * @param  bool  $useReadPdo
     * @return mixed
     */
    public static function selectOne($query, $bindings = [], $useReadPdo = true);

    /**
     * 查询单个字段值
     *
     * @param  string  $query
     * @param  array  $bindings
     * @param  bool  $useReadPdo
     * @return mixed
     *
     * @throws RuntimeException
     */
    public static function scalar($query, $bindings = [], $useReadPdo = true);

    /**
     * 查询多条记录
     *
     * @param  string  $query
     * @param  array  $bindings
     * @param  bool  $useReadPdo
     * @return array
     */
    public static function select($query, $bindings = [], $useReadPdo = true);

    /**
     * 查询多条记录并返回生成器
     *
     * @param  string  $query
     * @param  array  $bindings
     * @param  bool  $useReadPdo
     * @return \Generator
     */
    public static function cursor($query, $bindings = [], $useReadPdo = true);

    /**
     * 执行插入SQL语句
     *
     * @param  string  $query
     * @param  array  $bindings
     * @return bool
     */
    public static function insert($query, $bindings = []);

    /**
     * 执行更新SQL语句
     *
     * @param  string  $query
     * @param  array  $bindings
     * @return int
     */
    public static function update($query, $bindings = []);

    /**
     * 执行删除SQL语句
     *
     * @param  string  $query
     * @param  array  $bindings
     * @return int
     */
    public static function delete($query, $bindings = []);

    /**
     * 执行SQL语句并返回布尔结果
     *
     * @param  string  $query
     * @param  array  $bindings
     * @return bool
     */
    public static function statement($query, $bindings = []);

    /**
     * 执行SQL语句并返回受影响的行数
     *
     * @param  string  $query
     * @param  array  $bindings
     * @return int
     */
    public static function affectingStatement($query, $bindings = []);

    /**
     * 执行原始SQL语句
     *
     * @param  string  $query
     * @return bool
     */
    public static function unprepared($query);

    /**
     * 准备SQL语句绑定参数
     *
     * @param  array  $bindings
     * @return array
     */
    public static function prepareBindings(array $bindings);

    /**
     * 执行数据库事务
     *
     * @param  \Closure  $callback
     * @param  int  $attempts
     * @return mixed
     *
     * @throws \Throwable
     */
    public static function transaction(Closure $callback, $attempts = 1);

    /**
     * 开始数据库事务
     *
     * @return void
     */
    public static function beginTransaction();

    /**
     * 提交当前数据库事务
     *
     * @return void
     */
    public static function commit();

    /**
     * 回滚当前数据库事务
     *
     * @return void
     */
    public static function rollBack();

    /**
     * 获取当前数据库事务层级
     *
     * @return int
     */
    public static function transactionLevel();

    /**
     * 执行给定回调函数在"dry run"模式下
     *
     * @param  \Closure  $callback
     * @return array
     */
    public static function pretend(Closure $callback);

    /**
     * 获取当前数据库连接的数据库名
     *
     * @return string
     */
    public static function getDatabaseName();
}
