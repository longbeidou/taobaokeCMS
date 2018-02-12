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

  // 获取分类信息
  public static function categorys($from)
  {
    switch ($from) {
      case 'pc':
        $categorys = Category::where('is_show', 1)->where('is_show_pc', 1)->orderBy('order', 'asc')->get()->toArray();
        $categorys = self::addLinkToCategorys($categorys,'link_pc');
        break;

      case 'wx':
        $categorys = Category::where('is_show', 1)->where('is_show_wx', 1)->orderBy('order', 'asc')->get()->toArray();
        $categorys = self::addLinkToCategorys($categorys, 'link_wx');
        break;

      case 'wechat':
        $categorys = Category::where('is_show', 1)->where('is_show_wechat', 1)->orderBy('order', 'asc')->get()->toArray();
        $categorys = self::addLinkToCategorys($categorys, 'link_wechat');
        break;

      case 'qq':
        $categorys = Category::where('is_show', 1)->where('is_show_qq', 1)->orderBy('order', 'asc')->get()->toArray();
        $categorys = self::addLinkToCategorys($categorys, 'link_qq');
        break;
    }

    return $categorys;
  }

  // 给分类增加link属性
  public static function addLinkToCategorys($categorys, $field)
  {
    if ( count($categorys) ) {
      foreach ($categorys as $key => $category) {
        $categorys[$key]['link'] = $category[$field];
      }

      return $categorys;
    }

    return $categorys;
  }
}
