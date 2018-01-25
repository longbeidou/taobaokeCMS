<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Adminer;
use Hash;

class AdminerLoginController extends Controller
{
    // 管理员控制面板
    public function dashboard () {
      return view('admin.dashboard');
    }

    // 管理的登录页面
    public function create () {
      return view('admin.login.login');
    }

    // 处理管理员的登录请求
    public function checkAdminer ( Request $request ) {
      $adminer = Adminer::where('email', $request->email)->first();
      if ( $adminer && Hash::check($request->password, $adminer->password) ) {
        session(['adminer_email'=>$adminer->email]);
        session(['adminer_id'=>$adminer->id]);
        return redirect()->route('admin.dashboard');
      } else {
        return redirect()->route('admin.create')->withErrors('用户名或密码错误！');
      }
    }
}
