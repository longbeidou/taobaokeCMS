<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Excel;
use Hash;
use App\Models\Adminer;

class CouponsController extends Controller
{
    static public $successInsertNum = 0; // 成功修改或插入数据库的优惠券信息条数
    public $pageSize = 10; // 后台优惠券列表每页默认显示的优惠券条数

    // 优惠券信息的列表
    public function index (Request $request)
    {
      $title = "优惠券商品列表";
      $viewData = $request->all();
      $viewData['title'] = $title;

      $urlStr = $this->makeRequstToURLStr($request->all());
      $pageSize = $this->getPageSize($request->page_size);
      $coupons = $this->listWhere(new Coupon, $request);
      $coupons = $this->listOrderBy($coupons, $request);
      $coupons = $coupons->paginate($pageSize);

      $viewData['urlStr'] = $urlStr;
      $viewData['coupons'] = $coupons;
      $viewData['oldRequest'] = $request->all();

      return view('admin.coupon.index', $viewData);
    }

    // 展示增加优惠券数据库的页面
    public function create ()
    {
      $title = '增加优惠券';

      return view('admin.coupon.create', compact('title'));
    }

    // 根据优惠券的id批量删除
    public function deleteByIds (Request $request)
    {
      $ids = $request->ids;
      $num = Coupon::destroy($ids);

      if ($num) {

        return back()->with('success', '成功删除'.$num.'条商品信息！');
      } else {

        return back()->with('warning', '成功删除'.$num.'条商品信息！');
      }
    }

    // 更加优惠券的id批量推荐商品
    public function recommendByIds(Request $request)
    {
      $ids = $request->ids;

      if ( !count($ids) ) {
        return back()->with('warning', '您没有选择要推荐的商品！');
      }

      $num = Coupon::whereIn('id', $ids)->update(['is_recommend'=>1]);

      if ($num) {

        return back()->with('success', '成功推荐'.$num.'条商品信息！');
      } else {

        return back()->with('warning', '成功推荐'.$num.'条商品信息！');
      }
    }

    // 更加优惠券的id批量取消推荐商品
    public function notRecommendByIds(Request $request)
    {
      $ids = $request->ids;

      if ( !count($ids) ) {
        return back()->with('warning', '您没有选择要取消推荐的商品！');
      }

      $num = Coupon::whereIn('id', $ids)->update(['is_recommend'=>0]);

      if ($num) {

        return back()->with('success', '成功取消推荐'.$num.'条商品信息！');
      } else {

        return back()->with('warning', '成功取消推荐'.$num.'条商品信息！');
      }
    }

    // 更加优惠券的id批量推荐商品
    public function showByIds(Request $request)
    {
      $ids = $request->ids;

      if ( !count($ids) ) {
        return back()->with('warning', '您没有选择要显示的商品！');
      }

      $num = Coupon::whereIn('id', $ids)->update(['is_show'=>1]);

      if ($num) {

        return back()->with('success', '成功设置'.$num.'条商品信息为显示状态！');
      } else {

        return back()->with('warning', '成功设置'.$num.'条商品信息为显示状态！');
      }
    }

    // 更加优惠券的id批量取消推荐商品
    public function notShowByIds(Request $request)
    {
      $ids = $request->ids;

      if ( !count($ids) ) {
        return back()->with('warning', '您没有选择要取消显示的商品！');
      }

      $num = Coupon::whereIn('id', $ids)->update(['is_show'=>0]);

      if ($num) {

        return back()->with('success', '成功设置'.$num.'条商品信息为不显示状态！');
      } else {

        return back()->with('warning', '成功设置'.$num.'条商品信息为不显示状态！');
      }
    }

    // 根据优惠券的id批量删除
    public function deleteById (Request $request)
    {
      $id = $request->id;
      $num = Coupon::destroy($id);

      if ($num) {

        return back()->with('success', '成功删除id为'.$id.'的商品信息！');
      } else {

        return back()->with('warning', 'id为'.$id.'的商品信息不存在！');
      }
    }

    // 根据优惠券的id批量推荐商品
    public function recommendById(Request $request)
    {
      $id = $request->id;

      $num = Coupon::where('id', $id)->update(['is_recommend'=>1]);

      if ($num) {

        return back()->with('success', '成功推荐id为'.$id.'的商品信息！');
      } else {

        return back()->with('warning', '成功推荐id为'.$id.'的商品信息！');
      }
    }

    // 根据优惠券的id批量取消推荐商品
    public function notRecommendById(Request $request)
    {
      $id = $request->id;

      $num = Coupon::where('id', $id)->update(['is_recommend'=>0]);

      if ($num) {

        return back()->with('success', '成功取消推荐id为'.$id.'的商品信息！');
      } else {

        return back()->with('warning', '成功取消推荐id为'.$id.'的商品信息！');
      }
    }

    // 根据优惠券的id批量推荐商品
    public function showById(Request $request)
    {
      $id = $request->id;

      $num = Coupon::where('id', $id)->update(['is_show'=>1]);

      if ($num) {

        return back()->with('success', '成功设置id为'.$id.'的商品信息为显示状态！');
      } else {

        return back()->with('warning', '成功设置id为'.$id.'的商品信息为显示状态！');
      }
    }

    // 根据优惠券的id批量取消推荐商品
    public function notShowById(Request $request)
    {
      $id = $request->id;

      $num = Coupon::where('id', $id)->update(['is_show'=>0]);

      if ($num) {

        return back()->with('success', '成功设置id为'.$id.'的商品信息为不显示状态！');
      } else {

        return back()->with('warning', '成功设置id为'.$id.'的商品信息为不显示状态！');
      }
    }

    // 将Excel文件的内容入库
    public function storeExcel (Request $request)
    {
      $filePath = $this->getExcelFileFullPath($request);
      Excel::filter('chunk')->load($filePath)->chunk(250, function ( $result ) {
        $result = $result->toArray();
        foreach ($result as $coupon) {
          $this->insertOrUpdateCoupons($coupon);
        }
      });

      return redirect()->route('admin.coupons.create')->with('success', '成功增加'.self::$successInsertNum.'条优惠券信息！');
    }

    // 展示删除优惠券数据的页面
    public function deleteShow ()
    {
      $title = '删除优惠券';

      return view('admin.coupon.delete_show', compact('title'));
    }

    // 情况优惠券的数据库
    public function deleteAll (Request $request)
    {
      if ( $this->isAdminerPassword($request->password, $request->adminer_id) ) {
        Coupon::truncate();

        return redirect()->route('admin.coupons.delete.show')->with('success', '成功清空数据库！');
      } else {

        return redirect()->route('admin.coupons.delete.show')->withErrors('请输入正确的管理员密码！');
      }
    }

    // 删除特定创建日期的优惠券信息
    public function deleteFromDateToDate (Request $request)
    {
      $dateBegin = $this->getDateTimeBegin($request->date_begin);
      $dateEnd = $this->getDateTimeEnd($request->date_end);
      $num = Coupon::whereBetween('created_at',[$dateBegin, $dateEnd])->delete();
      if ($num) {
        return redirect()->route('admin.coupons.delete.show')->with('success', '成功删除创建日期在'.$dateBegin.'至'.$dateEnd.'的'.$num.'条优惠券信息！');
      } else {
        return redirect()->route('admin.coupons.delete.show')->with('warning', '所选择的日期'.$dateBegin.'至'.$dateEnd.'没有对应的优惠券信息！');
      }
    }

    // 获取优惠券Excel文件的完整路径
    public function getExcelFileFullPath (Request $request)
    {
      $fileExtension = $request->file('excel')->getClientOriginalExtension();
      $destinationPath = storage_path().'/alimama/';
      $fileName = 'coupons.'.$fileExtension;

      return $filePath = $destinationPath.$fileName;
    }

    // 将Excel中获取的行数据整理成想要的数组
    public function makeStandardArray ( $couponOriginInfo ) {
      $coupon['goods_id']            = $couponOriginInfo['1'];
      $coupon['goods_name']          = $couponOriginInfo['2'];
      $coupon['image']               = $couponOriginInfo['3'];
      $coupon['goods_info_link']     = $couponOriginInfo['4'];
      $coupon['category']            = $couponOriginInfo['5'];
      $coupon['taobaoke_click_link'] = $couponOriginInfo['6'];
      $coupon['price']               = $couponOriginInfo['7'];
      $coupon['sales']               = $couponOriginInfo['8'];
      $coupon['rate']                = $couponOriginInfo['9'];
      $coupon['money']               = $couponOriginInfo['10'];
      $coupon['seller_wangwang']     = $couponOriginInfo['11'];
      $coupon['seller_id']           = $couponOriginInfo['12'];
      $coupon['shop_name']           = $couponOriginInfo['13'];
      $coupon['flat']                = $couponOriginInfo['14'];
      $coupon['coupon_id']           = $couponOriginInfo['15'];
      $coupon['coupon_total']        = $couponOriginInfo['16'];
      $coupon['coupon_last']         = $couponOriginInfo['17'];
      $coupon['coupon_info']         = $couponOriginInfo['18'];
      $coupon['coupon_begin_date']   = $couponOriginInfo['19'];
      $coupon['coupon_end_date']     = $couponOriginInfo['20'];
      $coupon['coupon_link']         = $couponOriginInfo['21'];
      $coupon['coupon_promote_link'] = $couponOriginInfo['22'];
      $coupon['price_now']           = $this->getPriceNow($coupon['coupon_info'], $coupon['price']);
      $coupon['rate_sales']          = $this->getRateSales($coupon['price_now'], $coupon['price']);

      return $coupon;
    }

    // 获取使用优惠券后的现价
    public function getPriceNow ( $couponInfo, $price)
    {
      $couponInfoArr = $this->makeCouponInfoToArray($couponInfo);
      $buyNum = $this->buyNum($price, $couponInfoArr[0]);

      return $price-$couponInfoArr[1]/$buyNum;
    }

    // 获取商品的优惠幅度
    public function getRateSales ($priceNow, $priceOri)
    {
      return (1-$priceNow/$priceOri)*100;
    }

    // 将优惠券的面额处理成数组
    public function makeCouponInfoToArray ($couponInfo)
    {
      $couponInfoToSameStr = str_replace(['满', '元', '减', '无条件券'], ['', '', '-', '-'], $couponInfo);
      $couponInfoArray = explode('-', $couponInfoToSameStr);
      if ($couponInfoArray[1] == 0) {
        return [0, $couponInfoArray[0]];
      } else {
        return $couponInfoArray;
      }
    }

    // 判断需要购买几件才能满足 满xx元减yy元 的条件
    public function buyNum ($price, $taget)
    {
      $m = 1;
      while ( $price < $taget ) {
        $m++;
        $price  = $price*$m;
      }

      return $m;
    }

    // 插入或更新数据库的优惠券信息
    public function insertOrUpdateCoupons (Array $coupon)
    {
      $couponStandardArray = $this->makeStandardArray( $coupon );
      $goodsId = array_shift($couponStandardArray);
      Coupon::updateOrCreate(
        ['goods_id'=>$goodsId], $couponStandardArray
      );
      self::$successInsertNum+=1;
    }

    // 检验提交的密码是否是管理员的密码
    public function isAdminerPassword ($password, $adminerId) {
      $adminerPassword = Adminer::where('id', $adminerId)->first(['password'])->password;

      return Hash::check($password, $adminerPassword);
    }

    // 获取查询的开始日期
    public function getDateTimeBegin ($date)
    {
      return date('Y-m-d H:i:s', strtotime($date));
    }

    // 获取查询的结束日期
    public function getDateTimeEnd ($date)
    {
      return date('Y-m-d H:i:s', strtotime($date)+60*60*24-1);
    }

    // 将请求的参数制成url字符串参数形式
    public function makeRequstToURLStr (Array $array)
    {
      $urlStr = '';

      foreach ($array as $key => $value) {
        if ( $key != 'page_size' && $key != 'order') {
          $urlStr .= $key.'='.$value.'&';
        }
      }

      return $urlStr;
    }

    // Coupon 模型的where条件
    public function listWhere ($coupon, Request $request)
    {
        if ( !empty($request->price_min) ) {
          $coupon = $coupon->where('price', '>=', $request->price_min);
        }
        if ( !empty($request->price_max) ) {
          $coupon = $coupon->where('price', '<=', $request->price_max);
        }
        if ( !empty($request->price_now_min) ) {
          $coupon = $coupon->where('price_now', '>=', $request->price_now_min);
        }
        if ( !empty($request->price_now_max) ) {
          $coupon = $coupon->where('price_now', '<=', $request->price_now_max);
        }
        if ( !empty($request->money_min) ) {
          $coupon = $coupon->where('money', '>=', $request->money_min);
        }
        if ( !empty($request->money_max) ) {
          $coupon = $coupon->where('money', '<=', $request->money_max);
        }
        if ( !empty($request->sales_min) ) {
          $coupon = $coupon->where('sales', '>=', $request->sales_min);
        }
        if ( !empty($request->sales_max) ) {
          $coupon = $coupon->where('sales', '<=', $request->sales_max);
        }
        if ( !empty($request->rate_sales_min) ) {
          $coupon = $coupon->where('rate_sales', '>=', $request->rate_sales_min*100);
        }
        if ( !empty($request->rate_sales_max) ) {
          $coupon = $coupon->where('rate_sales', '<=', $request->rate_sales_max*100);
        }
        if ( !empty($request->flat) ) {
          switch ($request->flat) {
            case 'taobao':
              $coupon = $coupon->where('flat', '淘宝');
              break;

            case 'tmall':
              $coupon = $coupon->where('flat', '天猫');
              break;

            case 'all':
            default:
              break;
          }
        }
        if ( !empty($request->is_recommend) ) {
          switch ($request->is_recommend) {
            case 'yes':
              $coupon = $coupon->where('is_recommend', '1');
              break;

            case 'no':
              $coupon = $coupon->where('is_recommend', '0');
              break;

            case 'all':
            default:
              break;
          }
        }
        if ( !empty($request->is_show) ) {
          switch ($request->is_show) {
            case 'yes':
              $coupon = $coupon->where('is_show', '1');
              break;

            case 'no':
              $coupon = $coupon->where('is_show', '0');
              break;

            case 'all':
            default:
              break;
          }
        }
        if ( !empty($request->goods_name) ) {
          $coupon = $this->goodsNameWhere($coupon, $request->goods_name);
        }

        return $coupon;
    }

    // 根据关键词处理搜索条件
    public function goodsNameWhere ($coupon, $goodsName)
    {
      $goodsNameArr = explode(' ', $goodsName);
      $goodsNameArr = array_filter($goodsNameArr);
      foreach ($goodsNameArr as $goods_name) {
        $coupon = $coupon->where('goods_name', 'like', '%'.$goods_name.'%');
      }

      return $coupon;
    }

    // Coupon 模型的orderby条件
    public function listOrderBy ($coupon, Request $request)
    {
      if ( !empty($request->order) ) {
        switch ($request->order) {
          case 'price_up':
            $coupon = $coupon->orderBy('price', 'asc');
            break;

          case 'price_down':
            $coupon = $coupon->orderBy('price', 'desc');
            break;

          case 'price_now_up':
            $coupon = $coupon->orderBy('price_now', 'asc');
            break;

          case 'price_now_down':
            $coupon = $coupon->orderBy('price_now', 'desc');
            break;

          case 'rate_sales_up':
            $coupon = $coupon->orderBy('rate_sales', 'asc');
            break;

          case 'rate_sales_down':
            $coupon = $coupon->orderBy('rate_sales', 'desc');
            break;

          case 'money_up':
            $coupon = $coupon->orderBy('money', 'asc');
            break;

          case 'money_down':
            $coupon = $coupon->orderBy('money', 'desc');
            break;

          case 'sales_up':
            $coupon = $coupon->orderBy('sales', 'asc');
            break;

          case 'sales_down':
            $coupon = $coupon->orderBy('sales', 'desc');
            break;

          default:
            return $coupon;
            break;
        }
      }
      return $coupon;
    }

    // 获取每页显示的条数
    public function getPageSize($pageSize)
    {
      if ( !empty($pageSize) ) {
        return $pageSize;
      }

      return $this->pageSize;
    }
}
