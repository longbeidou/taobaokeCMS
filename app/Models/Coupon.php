<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
  protected $table = "coupons";

  protected $fillable = [
    'goods_id','goods_name','image','goods_info_link','category','taobaoke_click_link','price','sales','rate','money','seller_wangwang','seller_id','shop_name','flat','coupon_id','coupon_total','coupon_last','coupon_info','coupon_begin_date','coupon_end_date','coupon_link','coupon_promote_link','price_now','rate_sales','is_recommend','is_show','tao_kou_ling'
  ];

  protected $hidden = [
    // 'password', 'remember_token'
  ];
}
