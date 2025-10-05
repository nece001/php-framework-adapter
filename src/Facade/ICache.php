<?php

namespace Nece\Framework\Adapter\Facade;

/**
 * 缓存接口 (psr-16)
 *
 * @author nece001@163.com
 * @create 2025-10-05 10:38:25
 */
interface ICache
{
    /**
     * 获取缓存
     *
     * @author nece001@163.com
     * @create 2025-10-05 10:37:22
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    static public function get(string $key, mixed $default = null): mixed;

    /**
     * 设置缓存
     *
     * @author nece001@163.com
     * @create 2025-10-05 10:37:29
     *
     * @param string $key
     * @param mixed $value
     * @param null|integer|\DateInterval|null $ttl
     * @return boolean
     */
    static public function set(string $key, mixed $value, null|int|\DateInterval $ttl = null): bool;

    /**
     * 删除缓存
     *
     * @author nece001@163.com
     * @create 2025-10-05 10:37:36
     *
     * @param string $key
     * @return boolean
     */
    static public function delete(string $key): bool;

    /**
     * 清空缓存
     *
     * @author nece001@163.com
     * @create 2025-10-05 10:37:43
     *
     * @return boolean
     */
    static public function clear(): bool;

    /**
     * 获取多个缓存
     *
     * @author nece001@163.com
     * @create 2025-10-05 10:37:49
     *
     * @param iterable $keys
     * @param mixed $default
     * @return iterable
     */
    static public function getMultiple(iterable $keys, mixed $default = null): iterable;

    /**
     * 设置多个缓存
     *
     * @author nece001@163.com
     * @create 2025-10-05 10:37:56
     *
     * @param iterable $values
     * @param null|integer|\DateInterval|null $ttl
     * @return boolean
     */
    static public function setMultiple(iterable $values, null|int|\DateInterval $ttl = null): bool;

    /**
     * 删除多个缓存
     *
     * @author nece001@163.com
     * @create 2025-10-05 10:38:03
     *
     * @param iterable $keys
     * @return boolean
     */
    static public function deleteMultiple(iterable $keys): bool;

    /**
     * 判断缓存是否存在
     *
     * @author nece001@163.com
     * @create 2025-10-05 10:38:10
     *
     * @param string $key
     * @return boolean
     */
    static public function has(string $key): bool;
}
