<?php

namespace Nece\Framework\Adapter\Contract\Facade;

interface Route
{
    /**
     * 添加路由规则
     *
     * @author nece001@163.com
     * @create 2026-06-08 16:57:29
     *
     * @param array $rules
     * @return void
     */
    public static function addRules(array $rules): void;

    /**
     * 生成路由URL
     *
     * @author nece001@163.com
     * @create 2026-06-08 16:57:38
     *
     * @param string $name
     * @param array $params
     * @return string
     */
    public static function url(string $name, array $params = []): string;
}
