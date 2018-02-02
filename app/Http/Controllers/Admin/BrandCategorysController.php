<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BrandCategory;

class BrandCategorysController extends Controller
{
    public $pageSize = 10;

    // 显示所哟品牌分类列表的页面
    public function index( Request $request )
    {
      $title = '品牌分类列表';
      $oldRequest = $request->all();

      if ( !empty($request->pageSize) ) {
        $pageSize = $request->pageSize;
      }

      $pageSize = $this->pageSize;
      $brandCategorys = BrandCategory::orderBy('order', 'asc')->paginate($pageSize);

      return view('admin.brandCategory.index', compact('title', 'brandCategorys', 'oldRequest'));
    }

    // 显示品牌分类详情的页面
    public function show()
    {
      //
    }

    // 创建品牌分类的页面
    public function create()
    {
      $title = '创建品牌分类';

      return view('admin.brandCategory.create', compact('title'));
    }

    // 创建品牌分类
    public function store()
    {
      //
    }

    // 编辑品牌分类的页面
    public function edit()
    {
      //
    }

    // 更新品牌分类
    public function update()
    {
      //
    }

    // 删除品牌分类
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
