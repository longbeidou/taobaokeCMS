<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\BaseController;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\Coupon;
use App\Models\CouponCategory;
use App\Traits\ShowFromToView;

class IndexController extends BaseController
{
    use ShowFromToView;

    public function index (Request $request)
    {
      $TDK = ['title'=>config('website.name').' - 专业的淘宝天猫优惠券分享网站',
              'keywords'=>'',
              'description'=>''];

      $banners = Banner::banners(self::$from);
      $categorys = Category::categorys(self::$from);
      $brandCategorys = BrandCategory::brandCategorys(self::$from);
      $brands = Brand::brands(self::$from, $brandCategorys);
      $coupons = Coupon::couponsRecommendRandom(self::$from);
      $couponCategorys = CouponCategory::couponCategorys(self::$from);
      $from = self::$from;
      $show_from = $this->showFrom(self::$from);

      if (self::$from === 'pc') {
        return view('home.wx.index.index', compact('TDK', 'show_from', 'banners', 'categorys', 'couponCategorys', 'brandCategorys', 'brands', 'coupons', 'from'));
      } else {
        return view('home.wx.index.index', compact('TDK', 'show_from', 'banners', 'categorys', 'couponCategorys', 'brandCategorys', 'brands', 'coupons', 'from'));
      }
    }
}
