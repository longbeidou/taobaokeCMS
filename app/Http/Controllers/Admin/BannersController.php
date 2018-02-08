<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannersController extends Controller
{
    // 显示列表
    public function index ()
    {
      return view('admin.banner.index');
    }

    // 显示用户个人信息的页面
    public function show ()
    {
      return view('admin.banner.show');
    }

    // 创建banner的页面
    public function create ()
    {
      return view('admin.banner.create');
    }

    // 创建banner
    public function store ()
    {
      // retur
    }

    // 修改banner的页面
    public function edit ()
    {
      return view('admin.banner.update');
    }

    // 更新用户
    public function update ()
    {
      //
    }

    // 删除用户
    public function delete ()
    {
      //
    }
}
