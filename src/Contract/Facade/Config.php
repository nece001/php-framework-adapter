<?php

namespace Nece\Framework\Adapter\Contract\Facade;

/**
 * 配置获取接口
 *
 * @author nece001@163.com
 * @create 2026-06-01 10:24:47
 */
interface Config
{
    /**
     * 获取配置变量值
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get(string $key, $default = null);
}