<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategorysController extends Controller
{
    // 显示所有分类列表的页面
    public function index ()
    {
      //
    }

    // 显示分类信息的页面
    public function show ( Category $category )
    {
      return view('admin.category.show');
    }

    // 创建分类的页面
    public function create ()
    {
      $title = "增加栏目分类";
      return view('admin.category.create', compact('title'));
    }

    // 创建分类
    public function store ( Request $request )
    {
      //
    }

    // 编辑分类信息的页面
    public function edit ( Category $category )
    {
      return view('admin.category.edit');
    }

    // 更新分类信息
    public function update ( Category $category, Request $request )
    {
      //
    }

    // 删除用户
    public function destroy ( Category $category )
    {
      //
    }
}
