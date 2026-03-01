<?php

namespace Nece\Framework\Adapter\Contract\Facade;

/**
 * 日志接口（psr-3）
 *
 * @author nece001@163.com
 * @create 2025-10-05 10:38:42
 */
interface ILog
{
    /**
     * 紧急情况
     *
     * @author nece001@163.com
     * @create 2025-10-05 10:43:06
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    static public function emergency(string $message, array $context = []): void;

    /**
     * 警告
     *
     * @author nece001@163.com
     * @create 2025-10-05 10:43:22
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    static public function alert(string $message, array $context = []): void;

    /**
     * 关键错误
     *
     * @author nece001@163.com
     * @create 2025-10-05 10:43:38
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    static public function critical(string $message, array $context = []): void;

    /**
     * 错误
     *
     * @author nece001@163.com
     * @create 2025-10-05 10:43:54
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    static public function error(string $message, array $context = []): void;

    /**
     * 警告
     *
     * @author nece001@163.com
     * @create 2025-10-05 10:44:09
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    static public function warning(string $message, array $context = []): void;

    /**
     * 通知
     *
     * @author nece001@163.com
     * @create 2025-10-05 10:44:24
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    static public function notice(string $message, array $context = []): void;

    /**
     * 信息
     *
     * @author nece001@163.com
     * @create 2025-10-05 10:44:39
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    static public function info(string $message, array $context = []): void;

    /**
     * 调试
     *
     * @author nece001@163.com
     * @create 2025-10-05 10:44:54
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    static public function debug(string $message, array $context = []): void;

    /**
     * 日志
     *
     * @author nece001@163.com
     * @create 2025-10-05 10:45:09
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return void
     */
    static public function log($level, string $message, array $context = []): void;
}
