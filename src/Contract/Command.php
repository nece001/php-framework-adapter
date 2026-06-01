<?php

namespace Nece\Framework\Adapter\Contract;

/**
 * 命令行接口
 *
 * @author nece001@163.com
 * @create 2026-06-01 10:24:47
 */
interface Command
{
    /**
     * 处理命令
     *
     * @return void
     */
    public function handle(): void;

    /**
     * 获取命令行参数
     *
     * @param string $name
     * @return mixed
     */
    public function argument(string $name);

    /**
     * 获取命令行选项
     *
     * @param string $name
     * @return mixed
     */
    public function option(string $name);

    /**
     * 询问用户
     *
     * @param string $question
     * @param mixed $default
     * @return mixed
     */
    public function ask(string $question, $default = null);

    /**
     * 确认用户操作
     *
     * @param string $question
     * @param bool $default
     * @return bool
     */
    public function confirm(string $question, bool $default = false): bool;

    /**
     * 选择用户操作
     *
     * @param string $question
     * @param array $choices
     * @param mixed $default
     * @return mixed
     */
    public function choice(string $question, array $choices, $default = null);

    /**
     * 输出空行
     *
     * @param int $count
     * @return void
     */
    public function newLine(int $count = 1): void;

    /**
     * 输出消息（带换行）
     *
     * @param string $message
     * @return void
     */
    public function writeln(string $message): void;

    /**
     * 输出消息（不带换行）
     *
     * @param string $message
     * @return void
     */
    public function write(string $message): void;

    /**
     * 输出信息消息
     *
     * @param string $message
     * @return void
     */
    public function info(string $message): void;

    /**
     * 输出注释消息
     *
     * @param string $message
     * @return void
     */
    public function comment(string $message): void;

    /**
     * 输出问题消息
     *
     * @param string $question
     * @return void
     */
    public function question(string $question): void;

    /**
     * 输出警告消息
     *
     * @param string $message
     * @return void
     */
    public function warn(string $message): void;

    /**
     * 输出错误消息
     *
     * @param string $message
     * @return void
     */
    public function error(string $message): void;
}