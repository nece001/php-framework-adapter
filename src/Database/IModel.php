<?php

namespace Nece\Framework\Adapter\Contract\DataBase;

/**
 * 模型接口
 *
 * @author nece001@163.com
 * @create 2025-10-05 11:13:16
 * 
 * @method array toArray()
 */
interface IModel
{
    /**
     * 开始事务
     *
     * @author nece001@163.com
     * @create 2025-10-05 11:13:16
     *
     * @return void
     */
    public function startTrans(): void;

    /**
     * 提交事务
     *
     * @author nece001@163.com
     * @create 2025-10-05 11:13:16
     *
     * @return void
     */
    public function commit(): void;

    /**
     * 回滚事务
     *
     * @author nece001@163.com
     * @create 2025-10-05 11:13:16
     *
     * @return void
     */
    public function rollback(): void;

    /**
     * 保存
     *
     * @author nece001@163.com
     * @create 2025-10-05 11:13:16
     *
     * @param array $data
     * @return bool
     */
    public function save(array $data = []);

    /**
     * 删除
     *
     * @author nece001@163.com
     * @create 2025-10-05 11:13:16
     *
     * @return bool
     */
    public function delete();

    /**
     * 获取表名(包含前缀)
     *
     * @author nece001@163.com
     * @create 2025-10-05 11:13:16
     *
     * @return string
     */
    public function getTable(): string;

    /**
     * 填充字段数据
     *
     * @author nece001@163.com
     * @create 2025-10-08 11:44:13
     *
     * @param array $data
     * @return self
     */
    public function fill(array $data): self;

    /**
     * 创建查询
     *
     * @author nece001@163.com
     * @create 2025-10-05 11:13:16
     *
     * @param string|null $alias
     * @return IQuery
     */
    public function newQuery($alias = null): IQuery;
}
