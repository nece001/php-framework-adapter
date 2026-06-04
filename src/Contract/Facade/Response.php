<?php

namespace Nece\Framework\Adapter\Contract\Facade;

interface Response
{
    /**
     * 基础响应
     * @param string $body 响应体
     * @param int $status 状态码
     * @param array $headers 请求头
     * @return mixed
     */
    public static function response(string $body = '', int $status = 200, array $headers = []);

    /**
     * JSON 响应
     * @param mixed $data 数据
     * @param int $options 选项
     * @return mixed
     */
    public static function json($data, int $options = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);

    /**
     * XML 响应
     * @param mixed $xml XML数据
     * @return mixed
     */
    public static function xml($xml);

    /**
     * JSONP 响应
     * @param mixed $data 数据
     * @param string $callback_name 回调函数名
     * @return mixed
     */
    public static function jsonp($data, string $callback_name = 'callback');

    /**
     * 重定向响应
     * @param string $location 重定向地址
     * @param int $status 状态码
     * @param array $headers 请求头
     * @return mixed
     */
    public static function redirect(string $location, int $status = 302, array $headers = []);

    /**
     * 视图响应
     * @param mixed $template 模板
     * @param array $vars 变量
     * @param string|null $app 应用
     * @param string|null $plugin 插件
     * @return mixed
     */
    public static function view(mixed $template = null, array $vars = [], ?string $app = null, ?string $plugin = null);

    /**
     * 文件下载响应
     * @param string $file_path 文件路径
     * @param string|null $filename 文件名
     * @return mixed
     */
    public static function download(string $file_path, ?string $filename = null);

    /**
     * 404 未找到
     * @return mixed
     */
    public static function notFound();
}