<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategorysStoreRequest;

class CategorysController extends Controller
{
    public $pageSize = 10;
    public $imageSmallPath       = 'img/category/imageSmall/';
    public $imageMagicLeftPath   = 'img/category/imageMagicLeft/';
    public $imageMagicTopPath    = 'img/category/imageMagicTop/';
    public $imageMagicButtomPath = 'img/category/imageMagicButtom/';

    // 显示所有分类列表的页面
    public function index (Request $request)
    {
      $title = '分类列表';

      if ( !empty($request->pageSize) ) {
        $this->pageSize = $request->pageSize;
      }

      $pageSize = $this->pageSize;

      $categorys = Category::orderBy('order', 'asc')->get();

      return view('admin.category.index', compact('title', 'categorys', 'pageSize'));
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
        'image_small'        => $this->getImagesSavePath($request, $this->imageSmallPath,       'image_small'),
        'image_magic_left'   => $this->getImagesSavePath($request, $this->imageMagicLeftPath,   'image_magic_left'),
        'image_magic_top'    => $this->getImagesSavePath($request, $this->imageMagicTopPath,    'image_magic_top'),
        'image_magic_buttom' => $this->getImagesSavePath($request, $this->imageMagicButtomPath, 'image_magic_buttom'),
      ]);

      return back()->with('success', '添加栏目分类成功！');
    }

    // 编辑分类信息的页面
    public function edit ( Category $category )
    {
      $title = '编辑栏目分类';

      return view('admin.category.edit', compact('title', 'category'));
    }

    // 更新分类信息
    public function update ( Category $category, Request $request )
    {
      $num = Category::where('id', $category->id)->update([
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
        'image_small'        => $this->getImagesUpdatePath($request, $this->imageSmallPath,       'image_small',        $category),
        'image_magic_left'   => $this->getImagesUpdatePath($request, $this->imageMagicLeftPath,   'image_magic_left',   $category),
        'image_magic_top'    => $this->getImagesUpdatePath($request, $this->imageMagicTopPath,    'image_magic_top',    $category),
        'image_magic_buttom' => $this->getImagesUpdatePath($request, $this->imageMagicButtomPath, 'image_magic_buttom', $category),
      ]);

      if ( $num ) {
        return redirect()->route('categorys.index')->with('success', '成功更新id为'.$category->id.'的栏目分类。');
      } else {
        return redirect()->route('categorys.index')->with('danger', '更新栏目分类失败，请刷新页面后再操作！');
      }
    }

    // 删除用户
    public function destroy ( Category $category )
    {
      //
    }

    // 根据用户的id删除用户
    public function deleteById (Request $request)
    {
      $category = Category::where('id', $request->id);

      if ( !$category->count() ) {
        return redirect()->route('categorys.index')->with('warning', '删除的栏目信息不存在，请刷新页面后操作！');
      }

      $category = $category->first();
      $this->unlinkCategoryFiles($category);

      $num = Category::destroy($request->id);

      if ( $num ) {
        return redirect()->route('categorys.index')->with('success', '成功删除id为'.$request->id.'的栏目分类信息！');
      } else {
        return redirect()->route('categorys.index')->with('danger', '删除栏目分类信息失败，请刷新页面后再操作！');
      }
    }

    // 批量修改栏目分类的排序
    public function changeOrder ( Request $request)
    {
      $idToOrdersArr = $request->order;

      if ( empty($idToOrdersArr) ) {
        return back()->with('danger', '没有收到提交的数据，请添加栏目分类或者刷新页面后操作！');
      }

      foreach ($idToOrdersArr as $id=>$order) {
        Category::where('id', $id)->update(['order'=>$order]);
      }

      return back()->with('success', '成功更新栏目分类排序！');
    }

    // 根据id集合批量删除
    public function deleteMany ( Request $request)
    {
      $ids = $request->ids;

      if ( empty($ids) ) {

        return redirect()->route('categorys.index')->with('warning', '没有选择要删除的栏目，请选中后再提交删除！');
      }

      $categorys = Category::whereIn('id', $ids);

      if ($categorys->count() == 0) {

        return redirect()->route('categorys.index')->with('danger', '批量删除栏目分类失败，请刷新页面后重新操作！');
      }

      foreach ($categorys->get() as $category) {
        $this->unlinkCategoryFiles($category);
      }

      if ( $num = $category->destroy($ids) ) {

        return redirect()->route('categorys.index')->with('success', '成功删除'.$num.'条栏目分类信息！');
      } else {

        return redirect()->routes('categorys.index')->with('danger', '批量删除栏目分类失败，请刷新页面后重新操作！');
      }
    }

    // 处理上传的图片
    public function getImagesSavePath (Request $request, String $path, String $field)
    {
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

    // 根据上传图片的情况更新图片
    public function getImagesUpdatePath (Request $request, String $path, String $field, $category)
    {
      $path = $this->getImagesSavePath($request, $path, $field);

      if ( empty($path) ) {

        return $category->$field;
      }

      $this->unlinkFiles($category->$field);

      return $path;
    }

    // 根据文件路径删除文件
    public function unlinkFiles (String $path)
    {
      if ( !empty($path) ) {
        $fullPath = public_path().$path;
        if ( is_file($fullPath) ) {
          unlink($fullPath);
        }
      }
    }

    // 删除给定栏目分类模型的所有图片资源
    public function unlinkCategoryFiles ($category)
    {
      $this->unlinkFiles($category->image_small);
      $this->unlinkFiles($category->image_magic_top);
      $this->unlinkFiles($category->image_magic_left);
      $this->unlinkFiles($category->image_magic_buttom);
    }
}
