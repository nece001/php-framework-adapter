<?php

namespace Nece\Framework\Adapter\Contract\Facade;

/**
 * 配置获取接口
 *
 * @author nece001@163.com
 * @create 2025-10-05 13:22:02
 */
interface IConfig
{
    /**
     * 获取配置变量值
     *
     * @author nece001@163.com
     * @create 2025-10-05 13:22:20
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function config(string $key, $default = null);

    /**
     * 获取环境变量值
     *
     * @author nece001@163.com
     * @create 2025-10-05 13:22:45
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function env(string $key, $default = null);
}
