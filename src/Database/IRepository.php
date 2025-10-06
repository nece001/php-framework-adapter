<?php

namespace Nece\Framework\Adapter\Contract\DataBase;

interface IRepository
{
    /**
     * 执行事务
     *
     * @author nece001@163.com
     * @create 2025-10-07 00:05:27
     *
     * @param callable $callback
     * @return mixed
     */
    public static function transaction(callable $callback);

    /**
     * 开启事务
     *
     * @author nece001@163.com
     * @create 2025-10-07 00:05:43
     *
     * @return void
     */
    public static function startTrans();

    /**
     * 提交事务
     *
     * @author nece001@163.com
     * @create 2025-10-07 00:05:54
     *
     * @return void
     */
    public static function commit();

    /**
     * 回滚事务
     *
     * @author nece001@163.com
     * @create 2025-10-07 00:06:02
     *
     * @return void
     */
    public static function rollback();
}
