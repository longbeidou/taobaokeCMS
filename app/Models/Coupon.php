<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\EncryptOrDecryptImage;

class Coupon extends Model
{
  use EncryptOrDecryptImage;

  protected $table = "coupons";

  protected $fillable = [
    'goods_id','goods_name','image', 'image_encrypt','goods_info_link','category','taobaoke_click_link','price','sales','rate','money','seller_wangwang','seller_id','shop_name','flat','coupon_id','coupon_total','coupon_last','coupon_info','coupon_begin_date','coupon_end_date','coupon_link','coupon_promote_link','price_now','rate_sales','is_recommend','is_show','tao_kou_ling'
  ];

  protected $hidden = [
  ];

  public function setImageEncryptAttribute ($value)
  {
    $this->attributes['image_encrypt'] = $this->encryptImage($value);
  }

  // 获取优惠券
  public static function couponsRecommendRandom($from, $pcNum = 20, $wxNum = 8)
  {
    if ($from == 'pc') {

      return Coupon::where('is_show', 1)->where('is_recommend', 1)->inRandomOrder()->take($pcNum)->get();
    } else {

      return Coupon::where('is_show', 1)->where('is_recommend', 1)->inRandomOrder()->take($wxNum)->get();
    }
  }

  // 获取制定id的优惠券信息
  public static function couponInfo($id)
  {
    return Coupon::find($id);
  }

  // 将优惠券的面额处理成数组
  public static function makeCouponInfoToArray ($couponInfo)
  {
    $couponInfoToSameStr = str_replace(['满', '元', '减', '无条件券'], ['', '', '-', '-'], $couponInfo);
    $couponInfoArray = explode('-', $couponInfoToSameStr);
    if ($couponInfoArray[1] == 0) {
      return [0, $couponInfoArray[0]];
    } else {
      return $couponInfoArray;
    }
  }

  // 将优惠券设为不显示
  public static function notShow ($id)
  {
    return Coupon::where('id', $id)->update(['is_show' => 0]);
  }

  // 清空优惠券的剩余数量
  public static function clearCouponLast ($id)
  {
    return Coupon::where('id', $id)->update(['coupon_last'=>0]);
  }
}
