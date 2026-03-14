<?php

namespace Nece\Framework\Adapter\Contract\Facade;

interface IEnv
{
    /**
     * 获取环境变量
     *
     * @author nece001@163.com
     * @create 2026-03-14 22:39:51
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = null);

    /**
     * 设置环境变量
     *
     * @author nece001@163.com
     * @create 2026-03-14 22:40:13
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set($key, $value);

    /**
     * 判断环境变量是否存在
     *
     * @author nece001@163.com
     * @create 2026-03-14 22:40:37
     *
     * @param string $key
     * @return boolean
     */
    public static function has($key): bool;


}
