<?php

namespace Nece\Framework\Adapter\Contract\Facade;

/**
 * 路由接口
 * 
 * @author nece001@163.com
 * @create 2025-10-05 12:04:56
 * 
 * @template Route
 * @template Resource
 */
interface IRoute
{
    /**
     * 注册一个新的GET路由到路由器
     *
     * @param  string  $uri
     * @param  array|string|callable  $action
     * @return Route
     */
    public static function get($uri, $action);

    /**
     * 注册一个新的POST路由到路由器
     *
     * @param  string  $uri
     * @param  array|string|callable  $action
     * @return Route
     */
    public static function post($uri, $action);

    /**
     * 注册一个新的PUT路由到路由器
     *
     * @param  string  $uri
     * @param  array|string|callable  $action
     * @return Route
     */
    public static function put($uri, $action);

    /**
     * 注册一个新的DELETE路由到路由器
     *
     * @param  string  $uri
     * @param  array|string|callable  $action
     * @return Route
     */
    public static function delete($uri, $action);

    /**
     * 注册一个新的PATCH路由到路由器
     *
     * @param  string  $uri
     * @param  array|string|callable  $action
     * @return Route
     */
    public static function patch($uri, $action);

    /**
     * 注册一个新的OPTIONS路由到路由器
     *
     * @param  string  $uri
     * @param  array|string|callable  $action
     * @return Route
     */
    public static function options($uri, $action);

    /**
     * 注册一个新的路由到路由器，该路由支持给定的HTTP方法
     *
     * @param  array|string  $methods
     * @param  string  $uri
     * @param  array|string|callable  $action
     * @return Route
     */
    public static function match($methods, $uri, $action);

    /**
     * 注册一个新的路由到路由器，该路由支持所有HTTP方法
     *
     * @param  string  $uri
     * @param  array|string|callable  $route
     * @return Route
     */
    public static function any(string $uri, $route);

    /**
     * 路由资源到控制器
     *
     * @param  string  $name
     * @param  string  $controller
     * @param  array  $options
     * @return Resource
     */
    public static function resource($name, $controller, array $options = []);

    /**
     * 创建一个路由组，该组共享相同的属性
     *
     * @param  string  $name
     * @param  \Closure|string  $routes
     * @param  array  $middleware
     * @return Group
     */
    public static function group(string $name, $routes, array $middleware = []);

    /**
     * 生成路由URL
     * 
     * @param string $name 路由名称
     * @param array $parameters 路由参数
     * @param bool $absolute 是否生成绝对URL
     * @return string
     */
    public static function url(string $name, array $parameters = [], bool $absolute = true): string;

    /**
     * 修复路由规则
     * 
     * @param string $rule 路由规则
     * @return string
     */
    public static function fixRule(string $rule): string;
}
