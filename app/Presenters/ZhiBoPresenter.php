<?php

namespace App\Presenters;

use Carbon\Carbon;

/**
 * 优惠券直播用
 */
class ZhiBoPresenter
{
  // 用于倒计时
  public function daoJiShi($key, $count, $minutes = 3)
  {
    $now = Carbon::now();
    $time = $now->subMinutes(($count-$key)*$minutes);

    return $time->toTimeString();
  }
}
