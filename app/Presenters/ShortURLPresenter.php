<?php

namespace App\Presenters;

/**
 * 优惠券直播用     补充：由于此操作耗时较长，已暂停使用
 */
class ShortURLPresenter
{
  public $api = 'http://api.t.sina.com.cn/short_url/shorten.json?source=3271760578&url_long=';

  // 用于倒计时
  public function makeLongURLToShortURL($longURL)
  {
    $url = $this->api.$longURL;

    try {
      $contents = file_get_contents($url);
    } catch (\Exception $e) {
      return $longURL;
    }

    $contents = json_decode($contents, true);
    return $contents[0]['url_short'];
  }
}
