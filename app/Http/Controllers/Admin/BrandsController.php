<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;

class BrandsController extends Controller
{
    public $pageSize = 10;

    // 显示所有品牌列表的页面
    public function index ( Request $request )
    {
      $title = '品牌列表';
      $oldRequest = $request->all();

      if ( !empty($request->pageSize) ) {
        $pageSize = $request->pageSize;
      }

      $pageSize = $this->pageSize;
      $brands = Brand::orderBy('order', 'asc')->paginate($pageSize);

      return view('admin.brand.index', compact('title', 'brands', 'oldRequest'));
    }

    // 创建品牌的页面
    public function create ()
    {
      $title = '创建品牌';

      return view('admin.brand.create', compact('title'));
    }

    // 显示品牌详情的页面
    public function show ()
    {
      //
    }

    // 创建品牌
    public function store()
    {
      //
    }

    // 编辑品牌的页面
    public function edit()
    {
      //
    }

    // 更新用户
    public function update()
    {
      //
    }

    // 删除用户
    public function destroy()
    {
      //
    }

    // 设置展示
    public function isShow()
    {
      //
    }

    // 设置不展示
    public function notShow()
    {
      //
    }

    // 根据id集合批量删除
    public function deleteMany()
    {
      //
    }

    // 修改排序
    public function changeOrder()
    {
      // 
    }
}
