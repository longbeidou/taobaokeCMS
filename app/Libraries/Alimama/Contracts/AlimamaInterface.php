<?php

namespace App\Libraries\Alimama\Contracts;

/**
 * 淘宝客的接口
 */
interface AlimamaInterface
{
  // 获取淘口令, $info为请求的数组
  public function wirelessShareTpwdCreate (Array $info);

  // 获取淘宝客的淘口令, $info为请求的数组
  public function tbkTpwdCreate (Array $info);

  // 获取淘宝客商品详情（简版）信息
  public function tbkItemInfoGet ($num_iids, $platform, $fields);

  // 推广券信息查询
  public function tbkCouponGet($info);

  // 查询解析淘口令
  public function wirelessShareTpwdQuery($tpwd);

  // 好券清单API导购
  public function tbkDgItemCouponGet($info, $adzone_id);

  // 淘宝客商品查询, $info为请求的数组
  public function tbkItemGet (Array $info, $platform, $fields);

  // 聚划算商品搜索接口
  public function juItemsSearch (Array $info);
}
