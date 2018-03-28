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
use App\Traits\CouponCategorySelfWhere;

class IndexController extends BaseController
{
    use ShowFromToView, CouponCategorySelfWhere;

    public function index (Request $request)
    {
      $TDK = ['title'=>config('website.name').' - 专业的淘宝天猫优惠券分享网站',
              'keywords'=>'',
              'description'=>''];

      $banners = Banner::banners(self::$from);
      $categorys = Category::categorys(self::$from);
      $brandCategorys = BrandCategory::brandCategorys(self::$from);
      $brands = Brand::brands(self::$from, $brandCategorys);
      $coupons = Coupon::couponsRecommendRandom(self::$from, 6);
      $couponCategorys = CouponCategory::couponCategorys(self::$from);
      $from = self::$from;

      if (self::$from === 'pc') {
        $couponsRecommend = Coupon::couponsRecommendRandom(self::$from, 36);
        $allCouponsCategoryToCoupons = $this->allCouponsCategoryToCoupons($couponCategorys);

        return view('home.pc.index.index', compact('TDK',
                                                   'banners',
                                                   'categorys',
                                                   'couponCategorys',
                                                   'brandCategorys',
                                                   'brands',
                                                   'coupons',
                                                   'from',
                                                   'couponsRecommend',
                                                   'allCouponsCategoryToCoupons'
                                                 ));
      } else {
        $show_from = $this->showFrom(self::$from);
        return view('home.wx.index.index', compact('TDK',
                                                   'show_from',
                                                   'banners',
                                                   'categorys',
                                                   'couponCategorys',
                                                   'brandCategorys',
                                                   'brands',
                                                   'coupons',
                                                   'from'
                                                 ));
      }
    }

    // 获取优惠券分类对应的优惠券
    public function allCouponsCategoryToCoupons ($couponCategorys, $num = 9)
    {
      $allCouponsCategoryToCoupons = [];

      foreach ($couponCategorys as $key => $couponCategory) {
        $coupons = new Coupon;
        $coupons = $this->selfWhere($couponCategory->self_where, $coupons);
        $coupons = $coupons->orderBy('created_at', 'desc')->take($num)->get();
        $allCouponsCategoryToCoupons[$key]['category_name'] = $couponCategory->category_name;
        $allCouponsCategoryToCoupons[$key]['id'] = $couponCategory->id;
        $allCouponsCategoryToCoupons[$key]['coupons'] = $coupons;
      }

      return $allCouponsCategoryToCoupons;
    }
}
