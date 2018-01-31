<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $table = "categorys";

  protected $fillable = [
    'name', 'image_small','is_show', 'order', 'font_icon', 'link_pc', 'link_wx', 'link_wechat', 'link_qq', 'is_show_pc', 'is_show_wx', 'is_show_wechat', 'is_show_qq', 'image_magic_top', 'image_magic_left', 'image_magic_buttom'
  ];

  protected $hidden = [
  ];
}
