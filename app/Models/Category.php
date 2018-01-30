<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $table = "categorys";

  protected $fillable = [
    'name', 'imgage_small', 'order', 'font_icon', 'pc_link', 'pc_is_show', 'wx_link', 'wx_is_show', 'wechat_link', 'wechat_is_show', 'qq_link', 'qq_is_show'
  ];

  protected $hidden = [
  ];
}
