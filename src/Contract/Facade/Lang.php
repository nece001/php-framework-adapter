<?php

namespace Nece\Framework\Adapter\Contract\Facade;

/**
 * 语言接口
 *
 * @author nece001@163.com
 * @create 2026-06-01 10:24:47
 */
interface Lang
{
    public static function trans(string $key, array $replace = []): string;
}
