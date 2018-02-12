<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
  protected $table = "banners";

  protected $fillable = [
    'name', 'link', 'order', 'is_show', 'image', 'flat'
  ];

  protected $hidden = [
  ];

  // 获取banner的信息
  public static function banners($from)
  {
    if ($from === 'pc') {
      return Banner::where('is_show', 1)->where('flat', 'pc')->orderBy('order', 'asc')->get();
    }

    return Banner::where('is_show', 1)->where('flat', 'wx')->orderBy('order', 'asc')->get();
  }
}
