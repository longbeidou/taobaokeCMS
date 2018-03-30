<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\BaseController;
use App\Models\CouponCategory;
use App\Models\Coupon;
use App\Models\Category;
use App\Models\BrandCategory;
use App\Traits\CouponCategorySelfWhere;
use App\Traits\ShowFromToView;

class CouponCategoryController extends BaseController
{
    use CouponCategorySelfWhere, ShowFromToView;

    public $pageSize = 24;

    // 优惠券分类的列表
    public function index(Request $request)
    {
      $oldRequest = $request->all();
      $currentUrl = $request->url();
      $from = self::$from;
      $coupons = $this->coupons($request, $this->pageSize);
      $couponCategory = $this->couponCategory($request);
      $couponCategoryName = empty($couponCategory->category_name) ? '全部优惠券商品' : $couponCategory->category_name.'优惠券商品';
      $TDK = ['title'=>$couponCategoryName.' | '.config('website.name'),
              'keywords'=>'',
              'description'=>''];
      $categorys = Category::categorys(self::$from);
      $couponCategorys = CouponCategory::couponCategorys(self::$from);

      if (self::$from == 'pc') {
        $requestId = $request->id;
        $couponsRecommend = Coupon::couponsRecommendRandom(self::$from, 6);
        return view('home.pc.couponCategory.index', compact('TDK',
                                                   'oldRequest',
                                                   'categorys',
                                                   'requestId',
                                                   'currentUrl',
                                                   'couponCategorys',
                                                   'coupons',
                                                   'from',
                                                   'couponsRecommend'
                                                 ));
      } else {
        $show_from = $this->showFrom(self::$from);
        $couponsGussYouLike = Coupon::couponsRecommendRandom(self::$from, 5, 4);
        return view('home.wx.couponCategory.index', compact('oldRequest',
                                                            'currentUrl',
                                                            'show_from',
                                                            'from',
                                                            'TDK',
                                                            'coupons',
                                                            'couponsGussYouLike',
                                                            'categorys',
                                                            'couponCategory',
                                                            'couponCategorys'
                                                          ));
      }
    }

    // 优惠券搜索结果的列表
    public function search(Request $request)
    {
      if (empty($request->search)) {
        return back();
      }

      $oldRequest = $request->all();
      $currentUrl = $request->url();
      $from = self::$from;
      $TDK = ['title'=>'"'.$request->search.'"的优惠券商品搜素结果 | '.config('website.name'),
              'keywords'=>'',
              'description'=>''];

      $categorys = Category::categorys(self::$from);
      $couponCategorys = CouponCategory::couponCategorys(self::$from);
      $show_from = $this->showFrom(self::$from);

      if (self::$from == 'pc') {
        $coupons = $this->searchCoupons($request, $this->pageSize-10);
        $couponsCount = $this->searchCouponsCount($request);
        $couponsRecommend = Coupon::couponsRecommendRandom(self::$from, 16);
        return view('home.pc.superSearch.result_local', compact('oldRequest',
                                                             'currentUrl',
                                                             'show_from',
                                                             'from',
                                                             'TDK',
                                                             'coupons',
                                                             'couponsCount',
                                                             'categorys',
                                                             'couponCategorys',
                                                             'couponsRecommend'
                                                           ));
      } else {
        $coupons = $this->searchCoupons($request, $this->pageSize);
        $couponsGussYouLike = Coupon::couponsRecommendRandom(self::$from, 5, 4);
        return view('home.wx.couponCategory.search', compact('oldRequest',
                                                             'currentUrl',
                                                             'show_from',
                                                             'from',
                                                             'TDK',
                                                             'coupons',
                                                             'couponsGussYouLike',
                                                             'categorys',
                                                             'couponCategorys'
                                                           ));
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

      $coupons = $coupons->where('coupon_last', '>', 0);
      $coupons = $coupons->where('is_show', 1);
      $coupons = $this->couponOrderBy($coupons, $request->order);

      return $coupons->paginate($pageSize);
    }

    // 获取优惠券搜索的信息
    public function searchCoupons (Request $request, $pageSize = 20)
    {
      $coupons = new Coupon;
      $coupons = $this->searchStrToWhere($coupons, $request->search);
      $coupons = $coupons->where('coupon_last', '>', 0);
      $coupons = $coupons->where('is_show', 1);
      $coupons = $this->couponOrderBy($coupons, $request->order);

      return $coupons->paginate($pageSize);
    }

    // 获取优惠券搜索的结果总数
    public function searchCouponsCount (Request $request)
    {
      $coupons = new Coupon;
      $coupons = $this->searchStrToWhere($coupons, $request->search);
      $coupons = $coupons->where('coupon_last', '>', 0);
      $coupons = $coupons->where('is_show', 1);

      return $coupons->count();
    }

    // 搜索关键词处理
    public function searchStrToWhere ($coupons, $searchStr)
    {
      //将字符串按照空格来分割成数组
      $qarr = explode(' ', $searchStr);
      $qarr = array_filter($qarr);
      foreach ($qarr as $key => $value) {
          $qarr[$key] = '%'.$value.'%';
      }
      $qarr = array_values($qarr);
      foreach ($qarr as $key => $value) {
          $coupons = $coupons->where('goods_name','like',$value);
      }
      return $coupons;
    }

    // 优惠券的排序
    public function couponOrderBy ($coupons, $order)
    {
      switch ($order) {
        case 'sales_down':
          $coupons = $coupons->orderBy('sales', 'desc');
          break;

        case 'sales_up':
          $coupons = $coupons->orderBy('sales', 'asc');
          break;

        case 'rate_down':
          $coupons = $coupons->orderBy('rate_sales', 'desc');
          break;

        case 'rate_up':
          $coupons = $coupons->orderBy('rate_sales', 'asc');
          break;

        case 'price_now_down':
          $coupons = $coupons->orderBy('price_now', 'desc');
          break;

        case 'price_now_up':
          $coupons = $coupons->orderBy('price_now', 'asc');
          break;

        case 'taobao':
          $coupons = $coupons->orderBy('flat', 'asc');
          break;

        case 'tmall':
          $coupons = $coupons->orderBy('flat', 'desc');
          break;

        default:
          $coupons = $coupons->orderBy('id', 'desc');
          break;
      }

      return $coupons;
    }

    // 获取制定id的优惠券分类信息
    public function couponCategory ($request)
    {
      if (!empty($request->id)) {
        return CouponCategory::find($request->id);
      }

      return null;
    }
}
