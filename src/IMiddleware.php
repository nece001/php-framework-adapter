<?php

namespace Nece\Framework\Adapter;

use Closure;

/**
 * 中间件接口
 * 
 * @template T
 * @author nece001@163.com
 * @create 2025-09-29 19:33:29
 */
interface IMiddleware
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
