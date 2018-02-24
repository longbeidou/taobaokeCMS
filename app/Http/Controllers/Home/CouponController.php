<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\BaseController;
use App\Models\Coupon;
use App\Libraries\Alimama\Contracts\AlimamaInterface;

class CouponController extends BaseController
{
    public $taobao;

    public function __construct(AlimamaInterface $taobao)
    {
      $this->taobao = $taobao;
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
}
