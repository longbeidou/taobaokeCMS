<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\MakeCouponShareImageService as MakeImage;

class MakeInfoToQrCodeController extends Controller
{
    public function index (Request $request, MakeImage $image) {
      $info = $request->info;
      $img = $image->makeQrCodeImage($info, 244);
      return $img->response();
    }
}
