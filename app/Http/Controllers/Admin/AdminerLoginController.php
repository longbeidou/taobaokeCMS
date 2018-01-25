<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Adminer;
use Hash;

class AdminerLoginController extends Controller
{
    // 管理员控制面板
    public function dashboard (Request $request) {
      $adminer = Adminer::where('id', $request->session()->get('adminer_id'))->first();
      $name = $adminer->name;

      return view('admin.dashboard', compact('name'));
    }

    // 管理的登录页面
    public function create (Request $request) {
      if ( $request->session()->has('adminer_id') ) {
        return redirect()->route('admin.dashboard');
      }

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

        return redirect()->route('admin.login')->withErrors('用户名或密码错误！');
      }
    }

    // 控制板首页显示的具体内容页面
    public function index () {
      echo 1;
    }

    // 处理管理员退出的操作
    public function logout (Request $request) {
      $request->session()->pull('adminer_id');

      return redirect()->route('admin.login');
    }
}
