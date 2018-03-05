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
  public function finalPrice($couponInfo, $priceOrigin)
  {
    $couponInfoArray = $this->makeCouponInfoToArray($couponInfo);
    $count = $this->buyCount($couponInfoArray, $priceOrigin);

    return $priceOrigin-$couponInfoArray[1]/$count;
  }

  // 使用优惠券省多少钱
  public function saveMoney ($couponInfo, $priceOrigin)
  {
    $couponInfoArray = $this->makeCouponInfoToArray($couponInfo);
    $count = $this->buyCount($couponInfoArray, $priceOrigin);

    return $couponInfoArray[1]/$count;
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
