<?php
namespace App\Traits;

/**
 * 用于设计淘口令显示的参数
 */
trait TpwdParameter
{
  // 生成制作淘口令的参数,参数为数据库的字段
  public function createTpwdPara ($couponInfo) {
    $couponInfo = $couponInfo;
    $prefix = $this->makePrefix();
    return [
      'url'  => $couponInfo->coupon_promote_link,
      'text' => $prefix.$couponInfo->goods_name,
      'logo' => $couponInfo->image
    ];
  }

  // 生成制作淘口令的参数,参数为api获得
  public function createTpwdParaFromApi ($couponInfo) {
    $prefix = $this->makePrefix();
    return [
      'url'  => $couponInfo['coupon_click_url'],
      'text' => $prefix.$couponInfo['title'],
      'logo' => $couponInfo['pict_url']
    ];
  }

  // 去除text字段的前缀信息
  public function removeTextPrefix ($text)
  {
    $prefix = $this->makePrefix();
    return str_replace($prefix, '', $text);
  }

  // 制造前缀
  public function makePrefix () {
    return '【'.config('website.name').'用户专享】';
  }
}
