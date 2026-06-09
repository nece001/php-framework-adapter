<?php

namespace Nece\Framework\Adapter\Contract;

use Throwable;

class Exception extends \Exception
{
    /**
     * 框架适配异常
     *
     * @author nece001@163.com
     * @create 2026-06-01 10:24:47
     *
     * @param string $message 错误消息
     * @param mixed $code    错误码
     */
    public function __construct(string $message = '',  $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
        $this->code = $code;
    }
}