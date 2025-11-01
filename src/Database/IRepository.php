<?php

namespace Nece\Framework\Adapter\Contract\DataBase;

/**
 * 仓储对象接口
 *
 * @author nece001@163.com
 * @create 2025-11-01 19:44:52
 */
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
    public function transaction(callable $callback);

    /**
     * 开启事务
     *
     * @author nece001@163.com
     * @create 2025-10-07 00:05:43
     *
     * @return void
     */
    public function startTrans(): void;

    /**
     * 提交事务
     *
     * @author nece001@163.com
     * @create 2025-10-07 00:05:54
     *
     * @return void
     */
    public function commit(): void;

    /**
     * 回滚事务
     *
     * @author nece001@163.com
     * @create 2025-10-07 00:06:02
     *
     * @return void
     */
    public function rollback(): void;

    /**
     * 创建查询对象
     *
     * @author nece001@163.com
     * @create 2025-10-07 00:06:14
     *
     * @param string $alias
     * @return IQuery
     */
    public function query(string $alias = ''): IQuery;

    /**
     * 获取模型名
     *
     * @author nece001@163.com
     * @create 2025-11-01 19:44:19
     *
     * @return string
     */
    public function getModelName(): string;

    /**
     * 获取实体名
     *
     * @author nece001@163.com
     * @create 2025-11-01 19:44:27
     *
     * @return string
     */
    public function getEntityName(): string;

    /**
     * 获取DTO名
     *
     * @author nece001@163.com
     * @create 2025-11-01 19:44:35
     *
     * @return string
     */
    public function getDtoName(): string;
}
