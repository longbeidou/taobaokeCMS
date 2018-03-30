<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\MakeCouponShareImageService as MakeImage;

class MakeInfoToQrCodeController extends Controller
{
    public function index (Request $request, MakeImage $image) {
      $info = $request->info;
      $size = empty($request->size) ? 100 : $request->size;
      $img = $image->makeQrCodeImage($info, $size);
      return $img->response();
    }
}
