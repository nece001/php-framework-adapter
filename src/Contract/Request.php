<?php

namespace Nece\Framework\Adapter\Contract;

/**
 * 请求接口
 *
 * 统一封装不同框架的请求对象，提供一致的API接口
 * 包含常用的请求参数获取、请求类型判断、请求信息获取等功能
 *
 * PHP版本要求：>= 7.2
 *
 * @author nece001@163.com
 * @create 2026-06-01 10:24:47
 */
interface Request
{
    /**
     * 获取当前请求的参数（合并GET、POST、路由参数）
     *
     * @param string|array $name    变量名，支持数组批量获取
     * @param mixed        $default 默认值
     * @param string|array $filter  过滤方法（如 'trim,strip_tags' 或回调函数）
     * @return mixed
     *
     * @example
     * ```php
     * // 获取单个参数
     * $id = $request->param('id');
     * 
     * // 获取参数并设置默认值
     * $name = $request->param('name', 'default');
     * 
     * // 批量获取参数
     * $data = $request->param(['id', 'name']);
     * 
     * // 使用过滤器
     * $email = $request->param('email', '', 'trim,email');
     * ```
     */
    public function param($name = '', $default = null, $filter = ''): array;

    /**
     * 获取包含文件在内的所有请求参数
     *
     * @param string|array $name   变量名
     * @param string|array $filter 过滤方法
     * @return mixed
     */
    public function all($name = '', $filter = ''): array;

    /**
     * 获取GET参数
     *
     * @param string|array|bool $name    变量名，true返回原始数组
     * @param mixed             $default 默认值
     * @param string|array      $filter  过滤方法
     * @return mixed
     */
    public function get($name = '', $default = null, $filter = ''): array;

    /**
     * 获取POST参数
     *
     * @param string|array|bool $name    变量名，true返回原始数组
     * @param mixed             $default 默认值
     * @param string|array      $filter  过滤方法
     * @return mixed
     */
    public function post($name = '', $default = null, $filter = ''): array;

    /**
     * 获取PUT参数
     *
     * @param string|array|bool $name    变量名，true返回原始数组
     * @param mixed             $default 默认值
     * @param string|array      $filter  过滤方法
     * @return mixed
     */
    public function put($name = '', $default = null, $filter = ''): array;

    /**
     * 获取DELETE参数
     *
     * @param string|array|bool $name    变量名，true返回原始数组
     * @param mixed             $default 默认值
     * @param string|array      $filter  过滤方法
     * @return mixed
     */
    public function delete($name = '', $default = null, $filter = ''): array;

    /**
     * 获取变量（底层方法，支持过滤和默认值）
     *
     * @param array        $data    数据源
     * @param string|bool  $name    字段名，false返回原始数据
     * @param mixed        $default 默认值
     * @param string|array $filter  过滤函数
     * @return mixed
     */
    public function input(array $data = [], $name = '', $default = null, $filter = ''): array;

    /**
     * 获取路由参数
     *
     * @param string|array|bool $name    变量名，true返回原始数组
     * @param mixed             $default 默认值
     * @param string|array      $filter  过滤方法
     * @return mixed
     */
    public function route($name = '', $default = null, $filter = ''): array;

    /**
     * 获取Cookie参数
     *
     * @param string       $name    变量名
     * @param mixed        $default 默认值
     * @param string|array $filter  过滤方法
     * @return mixed
     */
    public function cookie(string $name = '', $default = null, $filter = ''): array;

    /**
     * 获取Session数据
     *
     * @param string $name    变量名，空字符串返回所有session
     * @param mixed  $default 默认值
     * @return mixed
     */
    public function session(string $name = '', $default = null): array;

    /**
     * 获取SERVER参数
     *
     * @param string $name    变量名（不区分大小写）
     * @param string $default 默认值
     * @return mixed
     */
    public function server(string $name = '', string $default = ''): array;

    /**
     * 获取Header信息
     *
     * @param string     $name    header名称（不区分大小写，支持下划线和短横线）
     * @param string     $default 默认值
     * @return array
     *
     * @example
     * ```php
     * // 获取单个header
     * $token = $request->header('Authorization');
     * $token = $request->header('authorization'); // 不区分大小写
     * 
     * // 获取所有headers
     * $headers = $request->header();
     * ```
     */
    public function header(string $name = '', string $default = null): array;

    /**
     * 获取上传文件
     *
     * @param string $name 文件字段名
     * @return array
     */
    public function file(string $name = ''): array;

    /**
     * 判断请求类型
     *
     * @param bool $origin 是否获取原始请求类型（不考虑_method隐藏字段）
     * @return string 请求类型（GET, POST, PUT, DELETE, PATCH等）
     */
    public function method(bool $origin = false): string;

    /**
     * 是否为GET请求
     * @return bool
     */
    public function isGet(): bool;

    /**
     * 是否为POST请求
     * @return bool
     */
    public function isPost(): bool;

    /**
     * 是否为PUT请求
     * @return bool
     */
    public function isPut(): bool;

    /**
     * 是否为DELETE请求
     * @return bool
     */
    public function isDelete(): bool;

    /**
     * 是否为AJAX请求
     *
     * @param bool $ajax true时只检测X-Requested-With头
     * @return bool
     */
    public function isAjax(bool $ajax = false): bool;

    /**
     * 是否为JSON请求
     * @return bool
     */
    public function isJson(): bool;

    /**
     * 是否为HTTPS请求
     * @return bool
     */
    public function isSsl(): bool;

    /**
     * 是否为CLI模式
     * @return bool
     */
    public function isCli(): bool;

    /**
     * 是否存在指定请求参数
     *
     * @param string $name       参数名
     * @param string $type       参数类型（param/get/post/put/route/cookie/session等）
     * @param bool   $checkEmpty 是否检查空值
     * @return bool
     */
    public function has(string $name, string $type = 'param', bool $checkEmpty = false): bool;

    /**
     * 只获取指定的参数
     *
     * @param array        $name   要获取的参数名数组
     * @param string|array $data   数据源类型或数组
     * @param string|array $filter 过滤方法
     * @return array
     *
     * @example
     * ```php
     * // 只获取指定字段
     * $data = $request->only(['id', 'name', 'email']);
     * 
     * // 指定数据源
     * $data = $request->only(['id', 'name'], 'post');
     * ```
     */
    public function only(array $name, $data = 'param', $filter = ''): array;

    /**
     * 排除指定参数后获取
     *
     * @param array  $name 要排除的参数名数组
     * @param string $type 参数类型
     * @return array
     */
    public function except(array $name, string $type = 'param'): array;

    /**
     * 获取客户端IP地址
     * @return string
     */
    public function ip(): string;

    /**
     * 获取当前URL
     *
     * @param bool $complete 是否包含完整域名
     * @return string
     */
    public function url(bool $complete = false): string;

    /**
     * 获取当前域名
     *
     * @param bool $port 是否包含端口号
     * @return string
     */
    public function domain(bool $port = false): string;

    /**
     * 获取当前请求的pathinfo（不含域名和query string）
     * @return string
     */
    public function pathinfo(): string;

    /**
     * 获取当前URL的后缀
     * @return string
     */
    public function ext(): string;

    /**
     * 获取当前请求的Content-Type
     * @return string
     */
    public function contentType(): string;

    /**
     * 获取当前请求的完整内容（php://input）
     * @return string
     */
    public function getContent(): string;

    /**
     * 获取请求时间
     *
     * @param bool $float 是否返回浮点类型（包含微秒）
     * @return int
     */
    public function time(bool $float = false): int;
}