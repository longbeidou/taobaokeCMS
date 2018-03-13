<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\BaseController;
use App\Libraries\Alimama\Contracts\AlimamaInterface;
use App\Traits\TpwdParameter;

class SuperSearchController extends BaseController
{
    use TpwdParameter;

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

      if ($m = $this->hasTwpd($request->q)) {
        $goodsInfoJson = $this->getCouponInfoFromTpwd($request->q);
        
        if ((bool)$goodsInfoJson->suc && !empty($goodsInfoJson->content)) {
          $keyword = $this->getQueryKeyWordFromTwpdInfo($goodsInfoJson);
        }
      }

      empty($keyword) ? $keyword = $request->q : '';
      $itemCoupons = $this->taobao->tbkDgItemCouponGet(['q'=>$keyword, 'page_size'=>'10']);
      $itemCouponsArr = $this->getItemCoupons($itemCoupons->results);

      if (count($itemCouponsArr) == 0) {
        return back()->withErrors(['使出了吃奶的力气也没有找到要相关的宝贝，建议搜索其他的宝贝试试或者联系客服进行内部专属渠道人工查询~~~']);
      }

      if (self::$from == 'pc') {
        //
      } else {
          $itemCouponsArr = $this->addTaoKouLing($itemCouponsArr);
          return view('home.wx.superSearch.index', compact('TDK', 'show_from', 'itemCouponsArr', 'has_search'));
      }
    }

    // 处理好券清单的查询词
    public function getQueryKeyWordFromTwpdInfo ($goodsInfoJson)
    {
      $goodsInfo = ((array)$goodsInfoJson);
      $str = str_replace(PHP_EOL, '', $goodsInfo['content']);
      $q = $this->removeTextPrefix($str);
      $q = $this->filterKuoHao($q);
      $q = $this->filterShuMingHao($q);
      unset($goodsInfo);
      unset($goodsInfoJson);
      return $q;
    }

    // 过滤字符串中（）字符来获取商品名称
    public function filterKuoHao ($str)
    {
      $q = explode('（', $str);
      if (count($q) == 2) {
        $q = explode('）', $q[1]);
      }
      return $q[0];
    }

    // 过滤书名号【】的算法获取商品名称
    public function filterShuMingHao ($str) {
      $q = explode('【', $str);
      unset($str);

      return $q[0];
    }

    // 通过淘宝口令获取口令背后的信息
    public function getCouponInfoFromTpwd ($str)
    {
      return $this->taobao->wirelessShareTpwdQuery($str);
    }

    // 检验字符串中是否存在口令
    public function hasTwpd ($str)
    {
      $codes = ['￥'];
      foreach ($codes as  $code) {
        $strArr = explode($code, $str);
        if (count($strArr) == 3) {
          break;
        }
      }
      unset($codes);
      unset($str);
      if (count($strArr) == 3 && strlen($strArr[1]) == 11) {
        unset($strArr);
        return true;
      } else {
        unset($strArr);
        return false;
      }
    }

    // 将查询的结果信息转变成数组
    public function getItemCoupons ($json)
    {
      if (empty($json)) {
        return [];
      }

      $array = (array)$json;

      if (empty($array['tbk_coupon']->category)) {
        foreach ($array['tbk_coupon'] as $key => $value) {
          $itemCoupons[$key] = (array)$value;
        }
      } else {
        $oneCoupon = (array)$array['tbk_coupon'];
        $itemCoupons[0] = $oneCoupon;
      }
      unset($array);

      return $itemCoupons;
    }

    // 给数组的每个商品信息加入淘口令
    public function addTaoKouLing($itemCoupons)
    {
      if ($itemCoupons == []) {
        return [];
      }

      foreach ($itemCoupons as $key => $value) {
        $tpwdInfo = $this->createTpwdParaFromApi($value);
        $itemCoupons[$key]['tkl'] = (string)$this->taobao->tbkTpwdCreate($tpwdInfo)->data->model;
      }

      return $itemCoupons;
    }

    // 将淘宝客商品查询的商品信息转换成数组
    public function makeItemsXmlToArray ($items, $param)
    {
      $itemsArr = [];

      if ($items->total_results > 1 && !empty($param['page_size']) && $param['page_size'] > 1) {
        $itemsInfo = (array)$items->results;
        foreach ($itemsInfo['n_tbk_item'] as $key => $info) {
          $itemsArr[$key] = (array)$info;
        }
      } elseif ($items->total_results == 1 || (!empty($param['page_size']) && $param['page_size'] = 1)) {
        $itemsArr[0] = (array)$items->results->n_tbk_item;
      }

      return $itemsArr;
    }
}
