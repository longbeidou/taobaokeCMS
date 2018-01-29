<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponCategory extends Model
{
    protected $table = "coupon_categorys";

    protected $fillable = [
      'category_name', 'self_where', 'imgage_small', 'order', 'is_show'
    ];
}
