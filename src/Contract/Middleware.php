<?php

namespace Nece\Framework\Adapter\Contract;

use Closure;

/**
 * 中间件接口
 *
 * @author nece001@163.com
 * @create 2026-06-01 10:24:47
 *
 * @template T
 */
interface Middleware
{
    /**
     * 处理请求
     *
     * @param T $request
     * @param Closure $next
     * @return Response
     */
    public function handle($request, Closure $next);
}