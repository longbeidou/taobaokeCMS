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

    public function __construct(Request $request, AlimamaInterface $taobao, MakeImage $image)
    {
      $this->taobao = $taobao;
      $this->image = $image;
      $this->__construct_base($request);
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
      $couponCountInfo = $this->couponCountInfo(['item_id'=>$couponInfo->goods_id, 'activity_id'=>$couponInfo->coupon_id])->data;

      if ($couponCountInfo->coupon_total_count) {
         Coupon::notShow($couponInfo->id);
         Coupon::clearCouponLast($couponInfo->id);
      }

      if (empty($couponInfo->tao_kou_ling)) {
        $taoKouLing = $this->taobao->wirelessShareTpwdCreate(['url'=>$couponInfo->coupon_link])->model;
        Coupon::where('id', $couponInfo->id)->update(['tao_kou_ling'=>$taoKouLing]);
      } else {
        $taoKouLing = $couponInfo->tao_kou_ling;
      }

      if (self::$from == 'pc') {
        //
      } else {
        return view('home.wx.couponInformation.index', compact('TDK', 'couponsGussYouLike', 'couponInfo', 'couponInformationArr', 'taoKouLing', 'smallImages',  'couponCountInfo'));
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
      self::$from == 'pc' ? $platform = 1 : $platform = 2;
      $smallImages = $this->taobao->tbkItemInfoGet($num_iids, $platform, $fields);

      if (empty($smallImages->results)) {
        return [];
      }

      $smallImages = $smallImages->results->n_tbk_item->small_images->string;
      $smallImages = (array)$smallImages;

      foreach ($smallImages as $key => $smallImage) {
        $smallImages[$key] = $this->encryptImage($smallImage);
      }

      return $smallImages;
    }

    // 更加是否是移动端来确定显示的是页面还是链接
    public function urlConfirm ($id) {
      if (self::$from == 'wechat') {
        return view('home.wx.couponInformation.url_confirm');
      } else {
        $taoBaoKeLink = Coupon::couponInfo($id)->coupon_promote_link;
        header('Location:'.$taoBaoKeLink);
      }
    }

    // 获取优惠券数量的信息
    public function couponCountInfo ($info) {
      return $this->taobao->tbkCouponGet($info);
    }
}
