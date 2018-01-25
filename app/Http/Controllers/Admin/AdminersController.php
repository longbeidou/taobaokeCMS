<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Adminer;
use App\Http\Requests\AdminerInfomationRequest;

class AdminersController extends Controller
{
    // 展示管理员信息
    public function show (Adminer $adminer) {
      $title = '管理员信息';

      return view('admin.adminer.show', compact('title', 'adminer'));
    }

    // 显示编辑管理员的窗口
    public function edit (Adminer $adminer) {
      $title = '编辑管理员信息';

      return view('admin.adminer.edit', compact('title', 'adminer'));
    }

    // 编辑用户的个人资料
    public function update (AdminerInfomationRequest $request) {
      return redirect()->route('adminers.edit', $request->id)->with('sucess', '更新管理员资料成功！');
    }
}
