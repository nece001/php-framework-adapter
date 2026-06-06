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
     * 参数是必需的
     */
    public const ARGUMENT_REQUIRED = 1;

    /**
     * 参数是可选的（默认行为）
     */
    public const ARGUMENT_OPTIONAL = 2;

    /**
     * 参数接受多个值
     */
    public const ARGUMENT_IS_ARRAY = 4;

    /**
     * 选项不接受值（默认行为）
     */
    public const OPTION_VALUE_NONE = 1;

    /**
     * 选项必须有值
     */
    public const OPTION_VALUE_REQUIRED = 2;

    /**
     * 选项的值是可选的
     */
    public const OPTION_VALUE_OPTIONAL = 4;

    /**
     * 选项接受多个值
     */
    public const OPTION_VALUE_IS_ARRAY = 8;

    /**
     * 选项允许传递否定变体
     */
    public const OPTION_VALUE_NEGATABLE = 16;

    /**
     * 处理命令
     *
     * @return void
     */
    public function handle();

    /**
     * 获取命令行参数
     *
     * @param string $name
     * @return mixed
     */
    public function getArg($name);

    /**
     * 获取命令行选项
     *
     * @param string $name
     * @return mixed
     */
    public function getOpt($name);

    /**
     * 询问用户
     *
     * @param string $question
     * @param mixed $default
     * @return mixed
     */
    public function showAsk($question, $default = null);

    /**
     * 确认用户操作
     *
     * @param string $question
     * @param bool $default
     * @return bool
     */
    public function showConfirm($question, $default = false);

    /**
     * 选择用户操作
     *
     * @param string $question
     * @param array $choices
     * @param mixed $default
     * @param int|null $attempts
     * @param bool $multiple
     * @return mixed
     */
    public function showChoice($question, array $choices, $default = null, $attempts = null, $multiple = false);

    /**
     * 输出空行
     *
     * @param int $count
     * @return void
     */
    public function showLine($count = 1);

    /**
     * 输出信息消息
     *
     * @param string $message
     * @return void
     */
    public function showInfo($message);

    /**
     * 输出注释消息
     *
     * @param string $message
     * @return void
     */
    public function showComment($message);

    /**
     * 输出问题消息
     *
     * @param string $question
     * @return void
     */
    public function showQuestion($question);

    /**
     * 输出警告消息
     *
     * @param string $message
     * @return void
     */
    public function showWarn($message);

    /**
     * 输出错误消息
     *
     * @param string $message
     * @return void
     */
    public function showError($message);

    /**
     * 添加命令行参数
     *
     * @param string $name 参数名称
     * @param int|null $mode 参数模式（ARGUMENT_REQUIRED/ARGUMENT_OPTIONAL/ARGUMENT_IS_ARRAY）
     * @param string $description 参数描述
     * @param mixed $default 默认值
     * @param array $suggestedValues 输入补全的值
     * @return $this
     */
    public function addArg(string $name, ?int $mode = null, string $description = '', $default = null, array $suggestedValues = []): self;

    /**
     * 添加命令行选项
     *
     * @param string $name 选项名称
     * @param string|null $shortcut 快捷方式
     * @param int|null $mode 选项模式（OPTION_VALUE_NONE/OPTION_VALUE_REQUIRED等）
     * @param string $description 选项描述
     * @param mixed $default 默认值
     * @param array $suggestedValues 输入补全的值
     * @return $this
     */
    public function addOpt(string $name, ?string $shortcut = null, ?int $mode = null, string $description = '', $default = null, array $suggestedValues = []): self;
}