<?php

namespace App\Presenters;

/**
 * 是否显示图片的加密地址
 */
class ImageSrcShowFrom
{
  // 图片对应的地址，用于本地的coupon表
  public function imageSrc($coupon, $show_from)
  {
    $show_from ? $imagePath = route('image.index', $coupon->image_encrypt) : $imagePath = $coupon->image ;

    return $imagePath;
  }

  // 返回商品小图片列表对应的图片
  public function imageSmallSrc ($smallImage, $show_from)
  {
    $show_from ? $imagePath = route('image.index', $smallImage['src_encrypt']) : $imagePath = $smallImage['src'] ;

    return $imagePath;
  }

  // 超级搜索用到的图片地址确认
  public function imageSuperSearchSrc ($Image, $show_from)
  {
    $show_from ? $imagePath = route('image.index', $Image['image_encrypt']) : $imagePath = $Image['pict_url'] ;

    return $imagePath;
  }
}
