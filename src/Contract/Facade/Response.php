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
     * @param int $status 状态码
     * @param array $headers 请求头
     * @param array $options 选项
     * @return mixed
     */
    public static function json($data, int $status = 200, array $headers = [], array $options = []);

    /**
     * XML 响应
     * @param mixed $xml XML数据
     * @param int $status 状态码
     * @param array $headers 请求头
     * @param array $options 选项
     * @return mixed
     */
    public static function xml($xml, int $status = 200, array $headers = [], array $options = []);

    /**
     * JSONP 响应
     * @param mixed $data 数据
     * @param int $status 状态码
     * @param array $headers 请求头
     * @param array $options 选项
     * @return mixed
     */
    public static function jsonp($data, int $status = 200, array $headers = [], array $options = []);

    /**
     * 重定向响应
     * @param string $location 重定向地址
     * @param int $status 状态码
     * @return mixed
     */
    public static function redirect(string $location, int $status = 302);

    /**
     * 视图响应
     * @param mixed $template 模板
     * @param array $vars 变量
     * @param int $status 状态码
     * @return mixed
     */
    public static function view(mixed $template = null, array $vars = [], int $status = 200);

    /**
     * 文件下载响应
     * @param string $filename 文件名
     * @param string $name 下载文件名
     * @param bool $content 是否为内容
     * @param int $expire 过期时间
     * @return mixed
     */
    public static function download(string $filename, string $name = '', bool $content = false, int $expire = 180);

    /**
     * 404 未找到
     * @return mixed
     */
    public static function notFound();

    /**
     * 构建数据响应
     *
     * @param mixed $code 状态码
     * @param string $status 状态描述，success 或 failure用来判断请求是否成功或失败
     * @param string $message 消息描述
     * @param array $data 数据
     * @return void
     */
    public static function buildData($code, $status, $message, $data = []);
}