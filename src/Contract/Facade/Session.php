<?php

namespace Nece\Framework\Adapter\Contract\Facade;

/**
 * 会话接口
 *
 * @author nece001@163.com
 * @create 2026-06-01 10:24:47
 *
 * @template Session
 */
interface Session
{
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
     * 删除会话属性
     * 
     * @param string $key 属性键名
     * @return void
     */
    public static function delete(string $key): void;

    /**
     * 检查会话属性是否存在
     * 
     * @param string $key 属性键名
     * @return bool
     */
    public static function has(string $key): bool;

    /**
     * 设置会话属性
     *
     * @author nece001@163.com
     * @create 2026-06-05 23:48:09
     *
     * @param array|string $key 属性键名或数组，数组时批量设置，字符串时单个设置
     * @param mixed $value 属性值或数组值
     * @return void
     */
    public static function put($key, $value = null): void;

    /**
     * 从会话中获取并删除属性
     *
     * @author nece001@163.com
     * @create 2026-06-05 23:50:03
     *
     * @param string $key
     * @return mixed
     */
    public static function pull(string $key);
}
