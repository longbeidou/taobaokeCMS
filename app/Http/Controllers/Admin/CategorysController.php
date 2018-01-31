<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategorysStoreRequest;

class CategorysController extends Controller
{
    // 显示所有分类列表的页面
    public function index ()
    {
      $title = '分类列表';
      return view('admin.category.index', compact('title'));
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
    public function store ( CategorysStoreRequest $request )
    {
      $category = Category::create([
        'name' => $request->name,
        'order' => $request->order,
        'is_show' => $request->is_show,
        'font_icon' => $request->font_icon,
        'link_pc' => $request->link_pc,
        'link_wx' => $request->link_wx,
        'link_wechat' => $request->link_wechat,
        'link_qq' => $request->link_qq,
        'is_show_pc' => $request->is_show_pc,
        'is_show_wx' => $request->is_show_wx,
        'is_show_qq' => $request->is_show_qq,
        'is_show_wechat' =>$request->is_show_wechat,
        'image_small'        => $this->getImagesSavePath($request, 'img/category/imageSmall/',       'image_small'),
        'image_magic_left'   => $this->getImagesSavePath($request, 'img/category/imageMagicLeft/',   'image_magic_left'),
        'image_magic_top'    => $this->getImagesSavePath($request, 'img/category/imageMagicTop/',    'image_magic_top'),
        'image_magic_buttom' => $this->getImagesSavePath($request, 'img/category/imageMagicButtom/', 'image_magic_buttom'),
      ]);

      return redirect()->route('categorys.show', compact('category'));
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

    // 处理上传的图片
    public function getImagesSavePath (Request $request, String $path, String $field) {
      if ( $request->hasFile($field) ) {
        $fileDir = $path.date('Y-m-d').'/';
        $file = $request->file($field);
        $extension = $file->getClientOriginalExtension();
        $newName = md5(time().str_random(25)).'.'.$extension;
        $file->move($fileDir, $newName);

        return '/'.$fileDir.$newName;
      }

      return '';
    }
}
