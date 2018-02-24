<?php

namespace App\Libraries\Alimama\Contracts;

/**
 * 淘宝客的接口
 */
interface AlimamaInterface
{
  // 获取淘口令, $info为请求的数组
  public function createShareTpwd (Array $info);
}
