<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
      // 
    }
}
