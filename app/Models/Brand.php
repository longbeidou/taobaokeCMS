<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
  protected $table = "brands";

  protected $fillable = [
    'name', 'order', 'brand_category_id', 'keywords', 'is_show', 'image', 'total'
  ];

  protected $hidden = [
  ];

  // 获取品牌信息
  public static function brands($from, $brandCategorys, $pcNum = 9, $wxNum = 6)
  {
    $brands = [];

    if ( $brandCategorys->count() ) {
      $brands[0] = self::getBrandsByNum($from, $pcNum, $wxNum);

      foreach ($brandCategorys as $key => $brandCategory) {
        if ($from === 'pc') {
          $brands[$key+1] = Brand::where('brand_category_id', $brandCategory->id)
                                  ->where('is_show', 1)
                                  ->where('total', '>=', 1)
                                  ->orderBy('order', 'asc')
                                  ->take($pcNum)
                                  ->get();
        } else {
          $brands[$key+1] = Brand::where('brand_category_id', $brandCategory->id)
                                  ->where('is_show', 1)
                                  ->where('total', '>=', 1)
                                  ->orderBy('order', 'asc')
                                  ->take($wxNum)
                                  ->get();
        }
      }
    }

    return $brands;
  }

  // 获取制定数量的品牌数据
  public static function getBrandsByNum ($from, $pcNum, $wxNum)
  {
    if ($from === 'pc') {
      return Brand::where('is_show', 1)->where('total', '>=', 1)->orderBy('total', 'desc')->take($pcNum)->get();
    } else {
      return Brand::where('is_show', 1)->where('total', '>=', 1)->orderBy('total', 'desc')->take($wxNum)->get();
    }
  }
}
