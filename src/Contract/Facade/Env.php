<?php

namespace Nece\Framework\Adapter\Contract\Facade;

/**
 * 环境变量接口
 *
 * @author nece001@163.com
 * @create 2026-06-01 10:24:47
 */
interface Env
{
    /**
     * 获取环境变量
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = null);

    /**
     * 设置环境变量
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set($key, $value);

    /**
     * 判断环境变量是否存在
     *
     * @param string $key
     * @return boolean
     */
    public static function has($key): bool;


}