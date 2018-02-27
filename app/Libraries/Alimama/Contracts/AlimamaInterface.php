<?php

namespace App\Libraries\Alimama\Contracts;

/**
 * 淘宝客的接口
 */
interface AlimamaInterface
{
  // 获取淘口令, $info为请求的数组
  public function wirelessShareTpwdCreate (Array $info);

  // 获取淘宝客商品详情（简版）信息
  public function tbkItemInfoGet ($num_iids, $platform, $fields);

  // 推广券信息查询
  public function tbkCouponGet($info);
}
