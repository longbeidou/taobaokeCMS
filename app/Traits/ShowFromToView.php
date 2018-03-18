<?php

namespace App\Traits;

/**
 * 检查http请求的访问来源
 */
trait ShowFromToView
{
    public function showFrom($from)
    {
        $allow = $this->getShowFrom();

        in_array($from, $allow) ? $show_from = true : $show_from = false;

        return $show_from;
    }

    public function getShowFrom ()
    {
      return config('website.show_from');
    }
}
