<?php

namespace Nece\Framework\Adapter\Contract;

/**
 * 控制器接口
 *
 * @author nece001@163.com
 * @create 2025-10-05 12:05:20
 * 
 * @template Request
 * @template Response
 */
interface IController
{
    /**
     * 获取当前请求
     * 
     * @return Request
     */
    public function getRequest();

    /**
     * 获取请求参数
     *
     * @author nece001@163.com
     * @create 2025-10-05 12:50:26
     *
     * @param string $name 参数键名
     * @param mixed $default 默认值
     * @param string|array|null $filter 过滤函数
     * @return mixed
     */
    public function param($name = '', $default = null, string|array|null $filter = '');

    /**
     * 渲染视图
     * 
     * @param string $view 视图路径
     * @param array $data 视图数据
     * @return Response
     */
    public function renderView(string $view, $data);

    /**
     * 重定向
     * 
     * @param string $url 重定向URL
     * @param mixed $result 重定向结果
     * @param int $code HTTP状态码
     * @return Response
     */
    public function redirectTo(string $url, $result, int $code = 302);
}
