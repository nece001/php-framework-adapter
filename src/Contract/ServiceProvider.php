<?php

namespace Nece\Framework\Adapter\Contract;

use Closure;

/**
 * 服务提供器接口
 *
 * @author nece001@163.com
 * @create 2026-06-01 10:24:47
 */
interface ServiceProvider
{
    /**
     * 服务注册
     *
     * @return void
     */
    public function register();

    /**
     * 服务启动
     *
     * @return void
     */
    public function boot();

    /**
     * 绑定服务
     *
     * @param string|array $abstract
     * @param string|array $concrete
     * @return void
     */
    public function bind($abstract, $concrete = null): void;

    /**
     * 添加视图命名空间
     *
     * @param string $namespace
     * @param string $path
     * @return void
     */
    public function addViewNamespaces(string $namespace, string $path): void;

    /**
     * 加载路由文件
     *
     * @param string $filename 路由文件路径
     * @return void
     */
    public function loadRouteFile(string $filename): void;

    /**
     * 注册路由
     *
     * @param Closure $closure
     * @return void
     */
    public function addRoutes(Closure $closure): void;

    /**
     * 注册命令
     *
     * @param array $commands
     * @return void
     */
    public function registerCommands(array $commands): void;
}