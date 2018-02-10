<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\SourceOfAccess;
use App\Models\Banner;
use App\Models\Category;

class IndexController extends Controller
{
    use SourceOfAccess;

    public $from;
    public $fromArr = ['pc','wechat','qq','wx'];

    public function __construct()
    {
      $this->from = $this->from();
    }

    public function index (Request $request)
    {
      $TDK = ['title'=>'网站首页',
              'keywords'=>'',
              'description'=>''];

      $this->from = in_array($request->from, $this->fromArr) ? $request->from : $this->from;
      $banners = $this->banners($this->from);
      $categorys = $this->categorys($this->from);
      dd($categorys);

      return view('home.wx.index.index', compact('TDK', 'banners', 'categorys'));
    }

    // 获取banner的信息
    public function banners($from)
    {
      if ($from === 'pc') {
        return Banner::where('is_show', 1)->where('flat', 'pc')->orderBy('order', 'asc')->get();
      }

      return Banner::where('is_show', 1)->where('flat', 'wx')->orderBy('order', 'asc')->get();
    }

    // 获取分类信息
    public function categorys($from)
    {
      $categorys = new Category;

      switch ($from) {
        case 'pc':
          $categorys = $categorys->where('is_show_pc', 1)->orderBy('order', 'asc')->get()->toArray();
          $categorys = $this->addLinkToCategorys($categorys,'link_pc');
          break;

        case 'wx':
          $categorys = $categorys->where('is_show_wx', 1)->orderBy('order', 'asc')->get()->toArray();
          $categorys = $this->addLinkToCategorys($categorys, 'link_wx');
          break;

        case 'wechat':
          $categorys = $categorys->where('is_show_wechat', 1)->orderBy('order', 'asc')->get()->toArray();
          $categorys = $this->addLinkToCategorys($categorys, 'link_wechat');
          break;

        case 'qq':
          $categorys = $categorys->where('is_show_qq', 1)->orderBy('order', 'asc')->get()->toArray();
          $categorys = $this->addLinkToCategorys($categorys, 'link_qq');
          break;
      }

      return $categorys;
    }

    // 给分类增加link属性
    public function addLinkToCategorys($categorys, $field)
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
