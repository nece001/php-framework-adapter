<?php

namespace Nece\Framework\Adapter\Contract;

use Throwable;

class Exception extends \Exception
{
    /**
     * 框架适配异常
     *
     * @author nece001@163.com
     * @create 2025-10-05 11:00:00
     *
     * @param string $message 错误消息
     * @param string|int    $code    错误码
     */
    public function __construct(string $message = '', string|int $code = 0, Throwable|null $previous = null)
    {
        parent::__construct($message, 0, $previous);
        $this->code = $code;
    }
}
