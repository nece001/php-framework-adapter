<?php

namespace Nece\Framework\Adapter\Exception;

use Nece\Framework\Adapter\Contract\Exception;

class NotFoundException extends Exception
{
    public function __construct(string $message = '未找到资源', string $code = 'not_found', Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->code = $code;
    }
}
