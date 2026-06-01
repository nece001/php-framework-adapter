<?php

namespace Nece\Framework\Adapter\Contract\Facade;

/**
 * 日志接口（psr-3）
 *
 * @author nece001@163.com
 * @create 2026-06-01 10:24:47
 */
interface Log
{
    /**
     * 获取日志记录器
     *
     * @author nece001@163.com
     * @create 2026-06-01 11:33:21
     *
     * @return Logger
     */
    public static function getLogger(): Logger;

    /**
     * 紧急情况
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    static public function emergency(string $message, array $context = []): void;

    /**
     * 警告
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    static public function alert(string $message, array $context = []): void;

    /**
     * 关键错误
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    static public function critical(string $message, array $context = []): void;

    /**
     * 错误
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    static public function error(string $message, array $context = []): void;

    /**
     * 警告
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    static public function warning(string $message, array $context = []): void;

    /**
     * 通知
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    static public function notice(string $message, array $context = []): void;

    /**
     * 信息
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    static public function info(string $message, array $context = []): void;

    /**
     * 调试
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    static public function debug(string $message, array $context = []): void;

    /**
     * 日志
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return void
     */
    static public function log($level, string $message, array $context = []): void;
}
