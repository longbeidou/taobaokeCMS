<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponCategory extends Model
{
    protected $table = "coupon_categorys";

    protected $fillable = [
      'category_name', 'self_where', 'image_small', 'order', 'is_show', 'font_icon'
    ];
}
