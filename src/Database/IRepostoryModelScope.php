<?php

namespace Nece\Framework\Adapter\Contract\DataBase;

/**
 * 存储仓库模型查询范围（全局作用域）
 *
 * @author nece001@163.com
 * @create 2025-11-22 20:45:38
 */
interface IRepostoryModelScope
{
    public function apply($model);
}
