<?php

namespace App\Presenters;

use App\Traits\CouponRelated;

/**
 * 涉及优惠券的相关显示
 */
class CouponPresenter
{
  use CouponRelated;

  // 最终价
  public function finalPrice($couponInfo, $priceOrigin, $num = 2)
  {
    $couponInfoArray = $this->makeCouponInfoToArray($couponInfo);
    $count = $this->buyCount($couponInfoArray, $priceOrigin);

    $finalPrice = $priceOrigin-$couponInfoArray[1]/$count;

    return round($finalPrice, $num);
  }

  // 使用优惠券省多少钱
  public function saveMoney ($couponInfo, $priceOrigin, $num = 2)
  {
    $couponInfoArray = $this->makeCouponInfoToArray($couponInfo);
    $count = $this->buyCount($couponInfoArray, $priceOrigin);

    $saveMoney = $couponInfoArray[1]/$count;

    return round($saveMoney, $num);
  }

  // 买几件商品可以使用优惠券
  public function buyCount ($couponInfoArray, $priceOrigin)
  {
    $num = 1;

    for ( $i = 1; $i++; $i < 100) {
      if ($priceOrigin*$num >= $couponInfoArray[0]) {
        return $num;
      }

      $num++;
    }

    return $num;
  }
}
