<?php

namespace Nece\Framework\Adapter\Contract\DataBase;

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
     * 查询表
     *
     * @author nece001@163.com
     * @create 2025-10-08 11:34:30
     *
     * @param string $table
     * @param string $alias
     * @return self
     */
    public function from(string $table, string $alias = '');

    /**
     * 获取表别名
     *
     * @author nece001@163.com
     * @create 2025-10-08 11:34:30
     *
     * @return string
     */
    public function getAlias();

    /**
     * 填充字段数据
     *
     * @author nece001@163.com
     * @create 2025-10-08 11:44:13
     *
     * @param array $data
     * @return self
     */
    public function fillData(array $data): self;
}
