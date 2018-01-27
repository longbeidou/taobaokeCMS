<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models;

class CouponsController extends Controller
{
    // 展示增加优惠券数据库的页面
    public function create () {
      $title = '增加优惠券';

      return view('admin.coupon.create', compact('title'));
    }

    // 展示删除优惠券数据的页面
    public function deleteShow () {
      $title = '删除优惠券';

      return view('admin.coupon.delete_show', compact('title'));
    }
}
