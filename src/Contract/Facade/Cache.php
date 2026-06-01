<?php

namespace Nece\Framework\Adapter\Contract\Facade;

/**
 * 缓存接口 (psr-16)
 *
 * @author nece001@163.com
 * @create 2026-06-01 10:24:47
 */
interface Cache
{
    /**
     * 获取缓存
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    static public function get(string $key, $default = null);

    /**
     * 设置缓存
     *
     * @param string $key
     * @param mixed $value
     * @param null|integer|\DateInterval|null $ttl
     * @return boolean
     */
    static public function set(string $key, mixed $value, $ttl = null): bool;

    /**
     * 删除缓存
     *
     * @param string $key
     * @return boolean
     */
    static public function delete(string $key): bool;

    /**
     * 清空缓存
     *
     * @return boolean
     */
    static public function clear(): bool;

    /**
     * 获取多个缓存
     *
     * @param iterable $keys
     * @param mixed $default
     * @return iterable
     */
    static public function getMultiple(iterable $keys, $default = null): iterable;

    /**
     * 设置多个缓存
     *
     * @param iterable $values
     * @param null|integer|\DateInterval|null $ttl
     * @return boolean
     */
    static public function setMultiple(iterable $values, $ttl = null): bool;

    /**
     * 删除多个缓存
     *
     * @param iterable $keys
     * @return boolean
     */
    static public function deleteMultiple(iterable $keys): bool;

    /**
     * 判断缓存是否存在
     *
     * @param string $key
     * @return boolean
     */
    static public function has(string $key): bool;
}