<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\BaseController;
use App\Models\Coupon;
use App\Models\Category;
use App\Models\CouponCategory;
use App\Libraries\Alimama\Contracts\AlimamaInterface;
use App\Services\MakeCouponShareImageService as MakeImage;
use App\Traits\EncryptOrDecryptImage;
use App\Traits\TpwdParameter;
use App\Traits\ShowFromToView;

class CouponController extends BaseController
{
    use EncryptOrDecryptImage, TpwdParameter, ShowFromToView;

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
      $couponInfo = Coupon::couponInfo($request->id);
      $TDK = ['title'=>$couponInfo->goods_name.' | '.config('website.name'),
              'keywords'=>'',
              'description'=>''];
      $couponInformationArr = Coupon::makeCouponInfoToArray ($couponInfo->coupon_info);
      $smallImages = $this->getCouponSmallImages($couponInfo->goods_id);
      $couponCountInfo = $this->couponCountInfo(['item_id'=>$couponInfo->goods_id, 'activity_id'=>$couponInfo->coupon_id])->data;

      if ($couponCountInfo->coupon_total_count == 0) {
         Coupon::notShow($couponInfo->id);
         Coupon::clearCouponLast($couponInfo->id);
      }

      if (self::$from == 'pc') {
        $categorys = Category::categorys(self::$from);
        $couponCategorys = CouponCategory::couponCategorys(self::$from);
        $couponsRecommend = Coupon::couponsRecommendRandom(self::$from, 16);
        $datetime = explode('-', $couponInfo->coupon_end_date);

        return view('home.pc.couponInformation.index', compact('TDK',
                                                               'categorys',
                                                               'couponCategorys',
                                                               'couponsRecommend',
                                                               'couponInfo',
                                                               'couponInformationArr',
                                                               'smallImages',
                                                               'couponCountInfo',
                                                               'datetime'
                                                             ));
      } else {
        $show_from = $this->showFrom(self::$from);
        $couponsGussYouLike = Coupon::couponsRecommendRandom(self::$from, 5, 4);
        if (empty($couponInfo->tao_kou_ling)) {
          $tpwdInfo = $this->createTpwdPara($couponInfo);
          $taoKouLing = (string)$this->taobao->tbkTpwdCreate($tpwdInfo)->data->model;
          // $taoKouLing = $this->taobao->wirelessShareTpwdCreate($tpwdInfo)->model;
          Coupon::where('id', $couponInfo->id)->update(['tao_kou_ling'=>$taoKouLing]);
        } else {
          $taoKouLing = $couponInfo->tao_kou_ling;
        }

        return view('home.wx.couponInformation.index', compact('TDK', 'show_from', 'couponsGussYouLike', 'couponInfo', 'couponInformationArr', 'taoKouLing', 'smallImages',  'couponCountInfo'));
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
        $smallImagesAll[$key]['src_encrypt'] = $this->encryptImage($smallImage);
        $smallImagesAll[$key]['src'] = $smallImage;
      }

      unset($smallImages);

      return $smallImagesAll;
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
