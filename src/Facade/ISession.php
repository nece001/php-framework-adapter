<?php

namespace Nece\Framework\Adapter\Facade;

/**
 * 会话接口
 *
 * @author nece001@163.com
 * @create 2025-10-05 12:05:20
 * 
 * @template Session
 */
interface ISession
{
    /**
     * 开始会话
     * 
     * @return void
     */
    public static function start(): void;

    /**
     * 销毁会话
     * 
     * @return void
     */
    public static function destroy(): void;

    /**
     * 设置会话属性
     * 
     * @param string $key 属性键名
     * @param mixed $value 属性值
     * @return void
     */
    public static function set(string $key, $value): void;

    /**
     * 获取会话属性
     * 
     * @param string $key 属性键名
     * @param mixed $default 默认值
     * @return mixed
     */
    public static function get(string $key, $default = null);

    /**
     * 检查会话属性是否存在
     * 
     * @param string $key 属性键名
     * @return bool
     */
    public static function has(string $key): bool;
}
