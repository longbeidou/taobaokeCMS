<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\BaseController;
use App\Models\Coupon;
use App\Libraries\Alimama\Contracts\AlimamaInterface;
use App\Services\MakeCouponShareImageService as MakeImage;

class CouponController extends BaseController
{
    public $taobao;
    public $image;

    public function __construct(AlimamaInterface $taobao, MakeImage $image)
    {
      $this->taobao = $taobao;
      $this->image = $image;
    }

    public function index(Request $request)
    {
      $TDK = ['title'=>'网站首页',
              'keywords'=>'',
              'description'=>''];

      $couponsGussYouLike = Coupon::couponsRecommendRandom(self::$from, 5, 4);
      $couponInfo = Coupon::couponInfo($request->id);
      $couponInformationArr = Coupon::makeCouponInfoToArray ($couponInfo->coupon_info);

      if (empty($couponInfo->tao_kou_ling)) {
        $taoKouLing = $this->taobao->createShareTpwd(['url'=>$couponInfo->coupon_link])->model;
        Coupon::where('id', $couponInfo->id)->update(['tao_kou_ling'=>$taoKouLing]);
      } else {
        $taoKouLing = $couponInfo->tao_kou_ling;
      }

      if (self::$from == 'pc') {
        //
      } else {
        return view('home.wx.couponInformation.index', compact('TDK', 'couponsGussYouLike', 'couponInfo', 'couponInformationArr', 'taoKouLing'));
      }
    }

    // 返回商品优惠券的分享海报图片
    public function shareCouponImage(Request $request)
    {
      $coupon = Coupon::couponInfo($request->id);
      $img = $this->image->makeImage($coupon);

      return $img->response();
    }
}
