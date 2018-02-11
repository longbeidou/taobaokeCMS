<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\SourceOfAccess;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\Coupon;

class IndexController extends Controller
{
    use SourceOfAccess;

    public static $from;
    public $fromArr = ['pc','wechat','qq','wx'];

    public function __construct()
    {
      self::$from = $this->from();
    }

    public function index (Request $request)
    {
      $TDK = ['title'=>'网站首页',
              'keywords'=>'',
              'description'=>''];

      self::$from = in_array($request->from, $this->fromArr) ? $request->from : self::$from;
      $banners = $this->banners();
      $categorys = $this->categorys();
      $brandCategorys = $this->brandCategorys();
      $brands = $this->brands($brandCategorys);
      $coupons = $this->coupons();

      if (self::$from === 'pc') {

        return view('home.wx.index.index', compact('TDK', 'banners', 'categorys', 'brandCategorys', 'brands', 'coupons'));
      } else {
        $from = self::$from;

        return view('home.wx.index.index', compact('TDK', 'banners', 'categorys', 'brandCategorys', 'brands', 'coupons', 'from'));
      }
    }

    // 获取banner的信息
    public function banners()
    {
      if (self::$from === 'pc') {
        return Banner::where('is_show', 1)->where('flat', 'pc')->orderBy('order', 'asc')->get();
      }

      return Banner::where('is_show', 1)->where('flat', 'wx')->orderBy('order', 'asc')->get();
    }

    // 获取品牌分类信息
    public function brandCategorys ($pcNum = 10, $wxNum = 5)
    {
      if (self::$from === 'pc') {

        return BrandCategory::where('is_show', 1)->where('total', '>=', 1)->orderBy('order', 'asc')->take($pcNum)->get();
      }

      return BrandCategory::where('is_show', 1)->where('total', '>=', 6)->orderBy('order', 'asc')->take($wxNum)->get();
    }

    // 获取品牌信息
    public function brands($brandCategorys, $pcNum = 10, $wxNum = 6)
    {
      $brands = [];

      if ( $brandCategorys->count() ) {
        $brands[0] = $this->getBrandsByNum($pcNum, $wxNum);

        foreach ($brandCategorys as $key => $brandCategory) {
          if (self::$from === 'pc') {
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
    public function getBrandsByNum ($pcNum, $wxNum)
    {
      if (self::$from === 'pc') {
        return Brand::where('is_show', 1)->where('total', '>=', 1)->orderBy('total', 'desc')->take($pcNum)->get();
      } else {
        return Brand::where('is_show', 1)->where('total', '>=', 1)->orderBy('total', 'desc')->take($wxNum)->get();
      }
    }

    // 获取分类信息
    public function categorys()
    {
      $categorys = new Category;

      switch (self::$from) {
        case 'pc':
          $categorys = $categorys->where('is_show', 1)->where('is_show_pc', 1)->orderBy('order', 'asc')->get()->toArray();
          $categorys = $this->addLinkToCategorys($categorys,'link_pc');
          break;

        case 'wx':
          $categorys = $categorys->where('is_show', 1)->where('is_show_wx', 1)->orderBy('order', 'asc')->get()->toArray();
          $categorys = $this->addLinkToCategorys($categorys, 'link_wx');
          break;

        case 'wechat':
          $categorys = $categorys->where('is_show', 1)->where('is_show_wechat', 1)->orderBy('order', 'asc')->get()->toArray();
          $categorys = $this->addLinkToCategorys($categorys, 'link_wechat');
          break;

        case 'qq':
          $categorys = $categorys->where('is_show', 1)->where('is_show_qq', 1)->orderBy('order', 'asc')->get()->toArray();
          $categorys = $this->addLinkToCategorys($categorys, 'link_qq');
          break;
      }

      return $categorys;
    }

    // 获取优惠券
    public function coupons($pcNum = 20, $wxNum = 8)
    {
      if (self::$from == 'pc') {

        return Coupon::where('is_show', 1)->where('is_recommend', 1)->inRandomOrder()->take($pcNum)->get();
      } else {

        return Coupon::where('is_show', 1)->where('is_recommend', 1)->inRandomOrder()->take($wxNum)->get();
      }
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
