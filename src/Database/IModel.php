<?php

namespace Nece\Framework\Adapter;

/**
 * 模型接口
 *
 * @author nece001@163.com
 * @create 2025-10-05 11:13:16
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
     * 获取表名
     *
     * @author nece001@163.com
     * @create 2025-10-05 11:13:16
     *
     * @return string
     */
    public function getTableName(): string;

    /**
     * 保存
     *
     * @author nece001@163.com
     * @create 2025-10-05 11:13:16
     *
     * @param array $data
     * @return bool
     */
    public function save(array $data): bool;

    /**
     * 删除
     *
     * @author nece001@163.com
     * @create 2025-10-05 11:13:16
     *
     * @return bool
     */
    public function delete(): bool;
}
