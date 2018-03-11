<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\BaseController;
use App\Libraries\Alimama\Contracts\AlimamaInterface;

class SuperSearchController extends BaseController
{
    public $taobao;

    public function __construct(Request $request, AlimamaInterface $taobao)
    {
      $this->taobao = $taobao;
      $this->__construct_base($request);
    }

    // 超级搜索
    public function index ()
    {
      $TDK = ['title'=>'超级搜索 | '.config('website.name'),
              'keywords'=>'',
              'description'=>''];
      in_array(self::$from, ['wechat', 'qq']) ? $show_from = true : $show_from = false;

      if (self::$from == 'pc') {
        //
      } else {
          return view('home.wx.superSearch.index', compact('TDK', 'show_from'));
      }
    }

    // 执行搜索
    public function result (Request $request)
    {
      if (empty($request->q)) {
        return back();
      }

      $TDK = ['title'=>'超级搜索的优惠券商品搜索结果 | '.config('website.name'),
              'keywords'=>'',
              'description'=>''];
      $has_search = true;
      in_array(self::$from, ['wechat', 'qq']) ? $show_from = true : $show_from = false;

      $goodsInfoJson = $this->taobao->wirelessShareTpwdQuery($request->q);

      if (!(bool)$goodsInfoJson->suc || empty($goodsInfoJson->content)) {
        return back()->withErrors(['使出了吃奶的力气也没有找到要相关的宝贝，建议搜索其他的宝贝试试~~~']);
      }

      $goodsInfo = ((array)$goodsInfoJson);

      $q = explode('（', $goodsInfo['content']);
      $q = explode('）', $q[1]);
      $goodsInfo['q'] = $q[0];

      $itemCoupons = $this->taobao->tbkDgItemCouponGet(['q'=>$goodsInfo['q'].'sd', 'page_size'=>'10']);
      $itemCouponsArr = $this->getItemCoupons($itemCoupons->results);

      if (self::$from == 'pc') {
        //
      } else {
          $itemCouponsArr = $this->addTaoKouLing($itemCouponsArr);
          return view('home.wx.superSearch.index', compact('TDK', 'show_from', 'itemCouponsArr', 'has_search'));
      }
    }

    // 将查询的结果信息转变成数组
    public function getItemCoupons ($json)
    {
      if (empty($json)) {
        return [];
      }

      $array = (array)$json;
      foreach ($array['tbk_coupon'] as $key => $value) {
        $array['tbk_coupon'][$key] = (array)$value;
      }

      return $array['tbk_coupon'];
    }

    // 给数组的每个商品信息加入淘口令
    public function addTaoKouLing($itemCoupons)
    {
      if ($itemCoupons == []) {
        return [];
      }

      foreach ($itemCoupons as $key => $value) {
        $itemCoupons[$key]['tkl'] = (string)$this->taobao->tbkTpwdCreate(['url'=>$value['coupon_click_url']])->data->model;
      }

      return $itemCoupons;
    }
}
