<?php

namespace Nece\Framework\Adapter\Contract\Facade;

/**
 * 容器接口
 * 作用：解决依赖注入的兼容问题
 *
 * @author nece001@163.com
 * @create 2026-06-01 10:24:47
 */
interface Container
{
    /**
     * 初始化应用
     *
     * @return void
     */
    public static function initApp(): void;

    /**
     * 获取应用实例
     *
     * @return Object
     */
    public static function getApp();

    /**
     * 依赖注入创建实例
     *
     * @param string $abstract
     * @param array $vars
     * @param boolean $newInstance
     * @return Object
     */
    public static function make(string $abstract, array $vars = [], bool $newInstance = false);
}