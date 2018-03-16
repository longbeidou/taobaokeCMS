<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\BaseController;
use App\Models\CouponCategory;
use App\Models\Coupon;
use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\Category;
use App\Traits\CouponCategorySelfWhere;
use App\Traits\ShowFromToView;

class BrandController extends BaseController
{
  use CouponCategorySelfWhere, ShowFromToView;

  public $pageSize = 12;

  // 优惠券分类的列表
  public function index(Request $request)
  {
    $oldRequest = $request->all();
    $currentUrl = $request->url();
    $id = empty($request->id) ? 0 : $request->id;
    $from = self::$from;
    $TDK = ['title'=>'优惠券商品品牌 | '.config('website.name'),
            'keywords'=>'',
            'description'=>''];

    $AllBrandCategorys = BrandCategory::AllBrandCategorys();
    $brands = $this->brands($id, $this->pageSize);
    $couponsGussYouLike = Coupon::couponsRecommendRandom(self::$from, 5, 4);
    $categorys = Category::categorys(self::$from);
    $couponCategorys = CouponCategory::couponCategorys(self::$from);
    $show_from = $this->showFrom(self::$from);

    if (self::$from == 'pc') {
      //
    } else {
      return view('home.wx.brand.index', compact('oldRequest', 'show_from', 'id', 'currentUrl', 'from', 'TDK', 'AllBrandCategorys', 'brands', 'couponsGussYouLike', 'categorys', 'couponCategorys'));
    }
  }

  // 获取优惠券信息
  public function brands ($id, $pageSize = 20)
  {
    $brands = Brand::where('is_show', 1)
                    ->where('total', '>', 0);

    if ( $id != 0) {
      $brands = $brands->where('brand_category_id', $id);
    }

    return $brands->orderBy('order', 'asc')
                  ->paginate($pageSize);

  }

  // 展示品牌对应的优惠的列表
  public function brandCoupons(Request $request)
  {
    $oldRequest = $request->all();
    $currentUrl = $request->url();
    $from = self::$from;
    $coupons = $this->coupons($request, $this->pageSize);
    $couponsGussYouLike = Coupon::couponsRecommendRandom(self::$from, 5, 4);
    $brand = $this->brandInfo($request);
    $TDK = ['title'=>$brand->name.'优惠券商品 | '.config('website.name'),
            'keywords'=>'',
            'description'=>''];
    $categorys = Category::categorys(self::$from);
    $couponCategorys = CouponCategory::couponCategorys(self::$from);
    $show_from = $this->showFrom(self::$from);

    if (self::$from == 'pc') {
      //
    } else {
      return view('home.wx.couponCategory.index', compact('oldRequest', 'show_from', 'currentUrl', 'from', 'TDK', 'brand', 'coupons', 'couponsGussYouLike', 'categorys', 'couponCategorys'));
    }
  }

  // 获取优惠券信息
  public function coupons (Request $request, $pageSize = 20)
  {
    $coupons = new Coupon;

    if ( !empty($request->id) ) {
      $keywords = Brand::find($request->id)->keywords;
      $coupons = $coupons->where('goods_name', 'like', $keywords);
    }

    $coupons = $coupons->where('coupon_last', '>', 0);

    switch ($request->order) {
      case 'sales_down':
        $coupons = $coupons->orderBy('sales', 'desc');
        break;

      case 'rate_down':
        $coupons = $coupons->orderBy('rate_sales', 'desc');
        break;
    }

    return $coupons->paginate($pageSize);
  }

  // 获取品牌信息
  public function brandInfo($request)
  {
    if (!empty($request->id)) {
      return Brand::find($request->id);
    }

    return null;
  }
}
