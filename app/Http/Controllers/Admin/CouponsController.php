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
    static public $successInsertNum = 0;

    // 展示增加优惠券数据库的页面
    public function create ()
    {
      $title = '增加优惠券';

      return view('admin.coupon.create', compact('title'));
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
}
