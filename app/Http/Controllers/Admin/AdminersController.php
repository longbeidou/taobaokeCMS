<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Adminer;
use App\Http\Requests\AdminerInfomationRequest;
use Hash;

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
      Adminer::where('id', $request->id)->update(['name'=>$request->name, 'email'=>$request->email]);

      return redirect()->route('adminers.edit', $request->id)->with('success', '更新管理员资料成功！');
    }

    // 显示修改用户密码的页面
    public function updatePassword (Adminer $adminer) {
      $title = '编辑管理员密码';

      return view('admin.adminer.change_password', compact('title', 'adminer'));
    }

    // 修改用户的密码
    public function updatePasswordaction(\App\Http\Requests\AdminerChangePasswordRequest $request) {
      $password_ori = Adminer::where('id', $request->id)->first()->password;

      if (Hash::check($request->password, $password_ori)) {
        Adminer::where('id', $request->id)->update(['password'=>Hash::make($request->password_new)]);

        return redirect()->route('adminers.update.password', $request->id)->with('success', '成功修改管理员登录密码！');
      } else {

        return redirect()->route('adminers.update.password', $request->id)->with('danger', '请输入正确的管理员密码！');
      }
    }
}
