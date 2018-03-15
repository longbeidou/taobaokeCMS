<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\BaseController;
use App\Libraries\Alimama\Contracts\AlimamaInterface;
use App\Traits\TpwdParameter;
use App\Traits\EncryptOrDecryptImage;
use App\Models\CouponCategory;
use App\Models\Coupon;
use App\Models\Category;

class SuperSearchController extends BaseController
{
    use TpwdParameter;
    use EncryptOrDecryptImage;

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
      $couponsGussYouLike = Coupon::couponsRecommendRandom(self::$from, 5, 4);

      if (self::$from == 'pc') {
        //
      } else {
        if ($show_from) {
          return view('home.wx.superSearch.index_simple', compact('TDK', 'show_from', 'couponsGussYouLike'));
        } else {
          $categorys = Category::categorys(self::$from);
          $couponCategorys = CouponCategory::couponCategorys(self::$from);
          return view('home.wx.superSearch.index', compact('TDK', 'show_from', 'couponsGussYouLike', 'categorys', 'couponCategorys'));
        }
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

      $couponsGussYouLike = Coupon::couponsRecommendRandom(self::$from, 5, 4);

      if ($this->hasTwpd($request->q)) {
        $goodsInfoJson = $this->getCouponInfoFromTpwd($request->q);

        if ((bool)$goodsInfoJson->suc && !empty($goodsInfoJson->content)) {
          $keyword = $this->getQueryKeyWordFromTwpdInfo($goodsInfoJson);
        } else {
          $keyword = $this->guessGoodsNameFromStr($request->q);
        }
      }

      empty($keyword) ? $keyword = $request->q : '';
      $itemCoupons = $this->taobao->tbkDgItemCouponGet(['q'=>$keyword, 'page_size'=>config('alimama.superSearchPageSize')]);
      $itemCouponsArr = $this->getItemCoupons($itemCoupons->results);

      if (count($itemCouponsArr) == 0) {
        return back()->withErrors(['使出了吃奶的力气也没有找到要相关的宝贝，建议搜索其他的宝贝试试或者联系客服进行内部专属渠道人工查询~~~']);
      }

      if (self::$from == 'pc') {
        //
      } else {
          $itemCouponsArr = $this->addTaoKouLing($itemCouponsArr);
          if ($show_from) {
            $itemCouponsArr = $this->addImageEncrypt($itemCouponsArr);
            return view('home.wx.superSearch.index_simple', compact('TDK', 'show_from', 'itemCouponsArr', 'has_search', 'couponsGussYouLike'));
          } else {
            $categorys = Category::categorys(self::$from);
            $couponCategorys = CouponCategory::couponCategorys(self::$from);
            return view('home.wx.superSearch.index', compact('TDK', 'show_from', 'itemCouponsArr', 'has_search', 'couponsGussYouLike', 'categorys', 'couponCategorys'));
          }
      }
    }

    // 处理好券清单的查询词
    public function getQueryKeyWordFromTwpdInfo ($goodsInfoJson)
    {
      $goodsInfo = ((array)$goodsInfoJson);
      $str = str_replace(PHP_EOL, '', $goodsInfo['content']);
      $q = $this->removeTextPrefix($str);
      $q = $this->filterTBApp($q);
      $q = $this->filterTBLMApp($q);
      unset($str);
      unset($goodsInfo);
      unset($goodsInfoJson);
      return $q;
    }

    // 过滤淘宝APP分享的字符串中（）字符来获取商品名称
    public function filterTBApp ($str)
    {
      $q = explode('买的宝贝（', $str);
      if (count($q) == 2) {
        $q = explode('），快来', $q[1]);
      }
      return $q[0];
    }

    // 过滤淘宝联盟APP默认信息的算法获取商品名称
    public function filterTBLMApp ($str) {
      $q = explode('【包邮】', $str);
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
      $strArr = $this->makeTwpdStrToArray($str);

      if (count($strArr) == 3 && strlen($strArr[1]) == 11) {
        return true;
      } else {
        return false;
      }
    }

    // 获取含有淘口令字符串中可能的商品名称
    public function guessGoodsNameFromStr ($str)
    {
      $strArr = $this->makeTwpdStrToArray($str);

      $firstLen = strlen($strArr[0]);
      if ($firstLen > 75 && $firstLen <= 90) {
        return $strArr[0];
      }

      $secondLen = strlen($strArr[0]);
      if ($secondLen > 75 && $secondLen <= 90) {
        return $strArr[2];
      }

      return null;
    }

    // 将含有淘口令的字符串变成数组
    public function makeTwpdStrToArray ($str) {
      $codes = config('alimama.tpwdCode');

      foreach ($codes as  $code) {
        $strArr = explode($code, $str);
        if (count($strArr) == 3) {
          return $strArr;
        }
      }

      return [];
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

    // 给数组的每个商品信息加入加密的图片地址
    public function addImageEncrypt($itemCoupons)
    {
      if ($itemCoupons == []) {
        return [];
      }

      foreach ($itemCoupons as $key => $value) {
        $imageEncryptPath = $this->encryptImage($value['pict_url']);
        $itemCoupons[$key]['image_encrpty'] = $imageEncryptPath;
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
