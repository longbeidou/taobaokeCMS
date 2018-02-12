<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\SourceOfAccessController;
use App\Models\CouponCategory;
use App\Models\Coupon;
use App\Models\Category;
use App\Models\BrandCategory;
use App\Traits\CouponCategorySelfWhere;

class CouponCategoryController extends SourceOfAccessController
{
    public $pageSize = 20;

    // 优惠券分类的列表
    public function index(Request $request)
    {
      $oldRequest = $request->all();
      $from = self::$from;
      $TDK = ['title'=>'网站首页',
              'keywords'=>'',
              'description'=>''];

      $coupons = $this->coupons($request, $this->pageSize);
      $couponsGussYouLike = Coupon::couponsRecommendRandom(self::$from, 5, 4);
      $categorys = Category::categorys(self::$from);
      $couponCategorys = CouponCategory::couponCategorys(self::$from);

      if (self::$from == 'pc') {
        //
      } else {
        return view('home.wx.couponCategory.index', compact('oldRequest', 'from', 'TDK', 'coupons', 'couponsGussYouLike', 'categorys', 'couponCategorys'));
      }
    }

    // 获取优惠券信息
    public function coupons (Request $request, $pageSize = 20)
    {
      $coupons = new Coupon;

      if ( !empty($request->id) ) {
        $couponCategory = CouponCategory::where('id', $request->id)->first(['self_where']);

        if (empty($couponCategory->self_where)) {
          return redirect()->route('home.coupon');
        }

        $coupons = $this->selfWhere($couponCategory->self_where, $coupons);
      }

      return $coupons->paginate($pageSize);
    }
}
