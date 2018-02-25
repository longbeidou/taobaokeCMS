<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\BaseController;
use App\Models\Coupon;
use App\Libraries\Alimama\Contracts\AlimamaInterface;
use App\Services\MakeCouponShareImageService as MakeImage;
use App\Traits\EncryptOrDecryptImage;

class CouponController extends BaseController
{
    use EncryptOrDecryptImage;

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
      $smallImages = $this->getCouponSmallImages($couponInfo->goods_id);

      if (empty($couponInfo->tao_kou_ling)) {
        $taoKouLing = $this->taobao->wirelessShareTpwdCreate(['url'=>$couponInfo->coupon_link])->model;
        Coupon::where('id', $couponInfo->id)->update(['tao_kou_ling'=>$taoKouLing]);
      } else {
        $taoKouLing = $couponInfo->tao_kou_ling;
      }

      if (self::$from == 'pc') {
        //
      } else {
        return view('home.wx.couponInformation.index', compact('TDK', 'couponsGussYouLike', 'couponInfo', 'couponInformationArr', 'taoKouLing', 'smallImages'));
      }
    }

    // 返回商品优惠券的分享海报图片
    public function shareCouponImage(Request $request)
    {
      $coupon = Coupon::couponInfo($request->id);
      $img = $this->image->makeImage($coupon);

      return $img->response();
    }

    // 获取优惠券的小图片信息
    public function getCouponSmallImages ($num_iids, $platform = 1, $fields = '')
    {
      $smallImages = $this->taobao->tbkItemInfoGet($num_iids, $platform, $fields)
                                  ->results
                                  ->n_tbk_item
                                  ->small_images
                                  ->string;
      $smallImages = (array)$smallImages;

      foreach ($smallImages as $key => $smallImage) {
        $smallImages[$key] = $this->encryptImage($smallImage);
      }

      return $smallImages;
    }
}
