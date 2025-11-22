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
     * 注册模型全局范围
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:23:40
     *
     * @param string $type
     * @param  $scope
     * @return void
     */
    public static function registerModelGlobalScope($type, IRepostoryModelScope $scope): void;

    /**
     * 注册模型保存事件
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:24:00
     *
     * @param string $type
     * @param IRepositoryModelEvent $event
     * @return void
     */
    public static function registerModelSavedEvent($type, IRepositoryModelEvent $event): void;

    /**
     * 注册模型删除事件
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:24:20
     *
     * @param string $type
     * @param IRepositoryModelEvent $event
     * @return void
     */
    public static function registerModelDeletedEvent($type, IRepositoryModelEvent $event): void;

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
     * 聚合根加载数据
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:26:31
     *
     * @param AggregateRoot $aggregateRoot
     * @return void
     */
    public function load($aggregateRoot): void;

    /**
     * 聚合根保存
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:26:42
     *
     * @param AggregateRoot $aggregateRoot
     * @return void
     */
    public function save($aggregateRoot): void;

    /**
     * 聚合根删除
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:26:52
     *
     * @param AggregateRoot $aggregateRoot
     * @return void
     */
    public function delete($aggregateRoot): void;
}
