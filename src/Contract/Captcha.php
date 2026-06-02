<?php

namespace Nece\Framework\Adapter\Contract;

interface Captcha
{
    /**
     * 生成验证码图片内容
     *
     * @author nece001@163.com
     * @create 2026-06-02 23:27:28
     *
     * @return string
     */
    public function image(): string;

    /**
     * 获取验证码值
     *
     * @author nece001@163.com
     * @create 2026-06-02 23:27:35
     *
     * @return string
     */
    public function getPhrase(): string;
}
