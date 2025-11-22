<?php

namespace Nece\Framework\Adapter\Contract\DataBase;

/**
 * 存储仓库模型事件
 *
 * @author nece001@163.com
 * @create 2025-11-22 20:44:24
 */
interface IRepositoryModelEvent
{
    public function handle($model);
}
