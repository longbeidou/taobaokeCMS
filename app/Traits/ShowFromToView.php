<?php

namespace App\Traits;

/**
 * 检查http请求的访问来源
 */
trait ShowFromToView
{
    public $allow = ['wechat', 'qq'];

    public function showFrom($from)
    {
        in_array($from, $this->allow) ? $show_from = true : $show_from = false;

        return $show_from;
    }
}
