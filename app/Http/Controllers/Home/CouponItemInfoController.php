<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\OutConponInfoService;

class CouponItemInfoController extends Controller
{
    // 获取外部的商品详情信息
    public function index($id, OutConponInfoService $itemInfo)
    {
      return $itemInfo->getTargetInfo($id);
    }
}
