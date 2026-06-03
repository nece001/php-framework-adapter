<?php

namespace Nece\Framework\Adapter\Contract;

/**
 * 控制器接口
 *
 * @author nece001@163.com
 * @create 2026-06-01 10:24:47
 * 
 * @template Request
 * @template Response
 */
interface Controller
{
    /**
     * 获取当前请求
     * 
     * @return Request
     */
    public function request(): Request;

    /**
     * 渲染视图
     * 
     * @param string $view 视图路径
     * @param array $data 视图数据
     * @return Response
     */
    public function render(string $view, $data);

    /**
     * 返回响应
     *
     * @author nece001@163.com
     * @create 2026-06-02 23:39:16
     *
     * @param string $body
     * @param integer $status
     * @param array $headers
     * @return Response
     */
    public function response(string $body = '', int $status = 200, array $headers = []);

    /**
     * 重定向
     * 
     * @param string $url 重定向URL
     * @param int $code HTTP状态码
     * @return Response
     */
    public function redirect(string $url, int $code = 302);

    /**
     * 返回 JSON 响应
     *
     * @param mixed $data 数据
     * @param int $code HTTP状态码
     * @param array $headers 响应头
     * @return Response
     */
    public function json($data, int $code = 200, array $headers = []);

    /**
     * 返回 XML 响应
     *
     * @param mixed $data 数据
     * @param int $code HTTP状态码
     * @param array $headers 响应头
     * @return Response
     */
    public function xml($data, int $code = 200, array $headers = []);

    /**
     * 获取 Session
     *
     * @param string $name Session键名
     * @param mixed $default 默认值
     * @return mixed
     */
    public function session(string $name = '', $default = null);

    /**
     * 获取 Session 并删除
     *
     * @author nece001@163.com
     * @create 2026-06-03 10:29:09
     *
     * @param string $name
     * @param mixed $default 默认值
     * @return mixed
     */
    public function pullSession(string $name, $default = null);

    /**
     * 设置 Session
     *
     * @param string $name Session键名
     * @param mixed $value Session值
     * @return $this
     */
    public function setSession(string $name, $value);

    /**
     * 删除 Session
     *
     * @param string $name Session键名
     * @return $this
     */
    public function deleteSession(string $name);

    /**
     * 设置 Session 过期时间
     *
     * @param int $life_time Session 过期时间（秒）
     * @return $this
     */
    public function setSessionLifeTime(int $life_time);

    /**
     * 文件下载
     *
     * @param string $file 文件路径
     * @param string|null $name 下载文件名
     * @param array $headers 响应头
     * @return Response
     */
    public function download(string $file, string $name = null, array $headers = []);

    /**
     * 流式响应
     *
     * @param resource $stream 数据流
     * @param int $code HTTP状态码
     * @param array $headers 响应头
     * @return Response
     */
    public function stream($stream, int $code = 200, array $headers = []);

    /**
     * 设置 Cookie
     *
     * @param string $name Cookie名称
     * @param string $value Cookie值
     * @param int $expire 过期时间（秒）
     * @param string $path 路径
     * @param string $domain 域名
     * @param bool $secure 是否安全连接
     * @param bool $httpOnly 是否仅HTTP访问
     * @return $this
     */
    public function setCookie(string $name, string $value = '', int $expire = 0, string $path = '/', string $domain = '', bool $secure = false, bool $httpOnly = true);

    /**
     * 删除 Cookie
     *
     * @param string $name Cookie名称
     * @param string $path 路径
     * @param string $domain 域名
     * @return $this
     */
    public function deleteCookie(string $name, string $path = '/', string $domain = '');
}
