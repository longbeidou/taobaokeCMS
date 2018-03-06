<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\BaseController;

class AboutUsController extends BaseController
{
    // 关于我们
    public function index ()
    {
      $TDK = ['title'=>'网站首页',
              'keywords'=>'',
              'description'=>''];

      if ( self::$from == 'pc' ) {
        //
      } else {
        return view('home.wx.aboutUs.index', compact('TDK'));
      }
    }
}
