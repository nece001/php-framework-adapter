<?php

namespace Nece\Gears;

use Closure;

/**
 * 服务提供器接口
 *
 * @author nece001@163.com
 * @create 2025-10-05 10:53:55
 */
interface IServiceProvider
{
    /**
     * 服务注册
     *
     * @author nece001@163.com
     * @create 2025-10-05 17:41:54
     *
     * @return void
     */
    public function register();

    /**
     * 服务启动
     *
     * @author nece001@163.com
     * @create 2025-10-05 17:42:02
     *
     * @return void
     */
    public function boot();

    /**
     * 绑定服务
     *
     * @author nece001@163.com
     * @create 2025-10-05 17:42:22
     *
     * @param string|array $abstract
     * @param string|array $concrete
     * @return void
     */
    public function bind(string|array $abstract, $concrete = null): void;

    /**
     * 添加视图命名空间
     *
     * @author nece001@163.com
     * @create 2025-10-05 17:42:38
     *
     * @param string $namespace
     * @param string $path
     * @return void
     */
    public function addViewNamespaces(string $namespace, string $path): void;

    /**
     * 加载路由文件
     *
     * @author nece001@163.com
     * @create 2025-10-05 18:00:06
     *
     * @param string $filename 路由文件路径
     * @return void
     */
    public function loadRouteFile(string $filename): void;

    /**
     * 注册路由
     *
     * @author nece001@163.com
     * @create 2025-10-05 18:00:06
     *
     * @param Closure $closure
     * @return void
     */
    public function addRoutes(Closure $closure): void;

    /**
     * 注册命令
     *
     * @author nece001@163.com
     * @create 2025-10-05 18:00:06
     *
     * @param array $commands
     * @return void
     */
    public function registerCommands(array $commands): void;
}
