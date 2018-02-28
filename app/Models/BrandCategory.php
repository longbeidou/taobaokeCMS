<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandCategory extends Model
{
  protected $table = "brand_categorys";

  protected $fillable = [
    'name', 'is_show', 'order', 'font_icon', 'total'
  ];

  protected $hidden = [
  ];

  // 获取品牌分类信息
  public static function brandCategorys ($from, $pcNum = 10, $wxNum = 5)
  {
    if ($from === 'pc') {

      return BrandCategory::where('is_show', 1)->where('total', '>=', 1)->orderBy('order', 'asc')->take($pcNum)->get();
    }

    return BrandCategory::where('is_show', 1)->where('total', '>=', 6)->orderBy('order', 'asc')->take($wxNum)->get();
  }

  // 获取全部可以展示的品牌分类信息
  public static function AllBrandCategorys ($isShow = 1, $order = 'asc', $total = 1)
  {
    return BrandCategory::where('total', '>=', $total)->where('is_show', $isShow)->orderBy('order', $order)->get();
  }
}
