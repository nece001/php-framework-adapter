<?php

namespace Nece\Framework\Adapter\Contract\Facade;

/**
 * 容器接口
 * 作用：解决依赖注入的兼容问题
 *
 * @author nece001@163.com
 * @create 2025-09-13 14:35:02
 */
interface IContainer
{
    /**
     * 初始化应用
     *
     * @author nece001@163.com
     * @create 2025-09-13 14:34:15
     *
     * @return void
     */
    public static function initApp(): void;

    /**
     * 获取应用实例
     *
     * @author nece001@163.com
     * @create 2025-09-13 14:35:08
     *
     * @return Object
     */
    public static function getApp();

    /**
     * 依赖注入创建实例
     *
     * @author nece001@163.com
     * @create 2025-09-13 14:35:20
     *
     * @param string $abstract
     * @param array $vars
     * @param boolean $newInstance
     * @return Object
     */
    public static function make(string $abstract, array $vars = [], bool $newInstance = false);
}
