<?php

namespace Nece\Framework\Adapter\Facade;

/**
 * 验证器接口
 * 验证规则统一参考：https://learnku.com/docs/laravel/12.x/validation/16955
 *
 * @author nece001@163.com
 * @create 2025-10-05 10:58:42
 * 
 * @throws ValidateException
 */
interface IValidate
{
    /**
     * 验证数据
     *
     * @author nece001@163.com
     * @create 2025-10-05 10:54:20
     *
     * @param array $data 数据
     * @param array $validate 验证规则
     * @param array $message 错误消息
     * @param bool  $batch 是否批量验证（false=只要有一条数据验证失败就抛异常）
     *
     * @return void
     */
    public static function validate(array $data, array $validate, array $message = [], bool $batch = false): void;
}