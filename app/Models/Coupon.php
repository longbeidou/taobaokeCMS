<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
  protected $table = "coupons";

  protected $fillable = [
    // 'name', 'email', 'password'
  ];

  protected $hidden = [
    // 'password', 'remember_token'
  ];
}
