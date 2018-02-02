<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BrandCategory;
use App\Models\Brand;
use App\Http\Requests\BrandCategorysStoreRequest;
use App\Http\Requests\BrandCategorysUpdateRequest;

class BrandCategorysController extends Controller
{
    public $pageSize = 10;

    // 显示所哟品牌分类列表的页面
    public function index( Request $request )
    {
      $title = '品牌分类列表';
      $oldRequest = $request->all();

      $pageSize = $this->pageSize;

      if ( !empty($request->page_size) ) {
        $pageSize = $request->page_size;
      }

      $brandCategorys = BrandCategory::orderBy('order', 'asc')->paginate($pageSize);

      return view('admin.brandCategory.index', compact('title', 'brandCategorys', 'oldRequest'));
    }

    // 显示品牌分类详情的页面
    public function show( BrandCategory $brandCategory )
    {
      $title = '品牌分类详情';

      return view('admin.brandCategory.show', compact('title', 'brandCategory'));
    }

    // 创建品牌分类的页面
    public function create()
    {
      $title = '创建品牌分类';

      return view('admin.brandCategory.create', compact('title'));
    }

    // 创建品牌分类
    public function store( BrandCategorysStoreRequest $request )
    {
      $brandCategory = BrandCategory::create([
        'name' => $request->name,
        'order' => $request->order,
        'font_icon' => $request->font_icon,
        'is_show' => $request->is_show
      ]);

      $this->updateTotalByIds($brandCategory->id);

      return back()->with('success', '成功添加品牌分类！');
    }

    // 编辑品牌分类的页面
    public function edit( BrandCategory $brandCategory )
    {
      $title = '便捷商品分类信息';

      return view('admin.brandCategory.edit', compact('title','brandCategory'));
    }

    // 更新品牌分类
    public function update( BrandCategory $brandCategory, BrandCategorysUpdateRequest $request)
    {
      $brandCategory->update([
        'name' => $request->name,
        'order' => $request->order,
        'font_icon' => $request->font_icon,
        'is_show' => $request->is_show,
        'total' => $this->getBrandsTotalByBrandCategoryId($brandCategory->id),
      ]);

      return redirect()->route('brandCategorys.index')->with('success', '成功更新品牌分类信息！');
    }

    // 删除品牌分类
    public function destroy()
    {
      //
    }

    // 设置展示
    public function isShow( Request $request )
    {
      $num = BrandCategory::where('id', $request->id)->update(['is_show'=> 1]);

      if ($num) {
        return back()->with('success', '成功更新设置品牌分类为显示状态！');
      } else {
        return redirect()->route('brandCategorys.index')->with('warning', '更新id为'.$request->id.'的品牌分类失败，请刷新页面后操作！');
      }
    }

    // 设置不展示
    public function notShow( Request $request )
    {
      $num = BrandCategory::where('id', $request->id)->update(['is_show'=> 0]);

      if ($num) {
        return back()->with('success', '成功更新设置品牌分类为不显示状态！');
      } else {
        return redirect()->route('brandCategorys.index')->with('warning', '更新id为'.$request->id.'的品牌分类失败，请刷新页面后操作！');
      }
    }

    // 根据id集合批量删除
    public function deleteMany( Request $request )
    {
      if ( $num = BrandCategory::destroy($request->ids) ) {

        return back()->with('success', '成功删除'.$num.'条品牌分类信息！');
      } else {

        return back()->with('warning', '请选择好要删除的品牌分类再提交删除请求！');
      }
    }

    // 根据id删除品牌分类
    public function delete( Request $request )
    {
      $num = BrandCategory::destroy($request->id);

      if ( $num ) {
        return back()->with('success', '成功删除id为'.$request->id.'的品牌分类信息！');
      } else {
        return redirect()->route('brandCategorys.index')->with('warning', '删除id为'.$request->id.'的品牌分类信息失败！');
      }
    }

    // 修改排序
    public function changeOrder( Request $request )
    {
      $idToOrderArr = $request->order;

      if ( count($idToOrderArr) == 0) {

        return redirect()->route('brandCategorys.index')->with('warning', '没有需要修改排序的品牌分类！');
      }

      $num = 0;

      foreach ($idToOrderArr as $id => $order) {
        $num += BrandCategory::where('id', $id)->update(['order'=>$order]);
      }

      if ( $num ) {

        return redirect()->route('brandCategorys.index')->with('success', '成功修改'.$num.'条品牌栏目的排序！');
      } else {

        return redirect()->route('brandCategorys.index')->with('warning', '没有品牌栏目信息，请添加品牌栏目信息后再提交修改排序的操作！');
      }
    }

    // 批量更新每个品牌分类下包含的品牌总数
    public function updateTotalMuti ( Request $request )
    {
      $num = $this->updateTotalByIds($request->ids);

      if ( $num ) {
        
        return redirect()->route('brandCategorys.index')->with('success', '成功更新本页所有品牌分类栏目下各栏目的品牌总数！');
      } else {

        return redirect()->route('brandCategorys.index')->with('warning', '更新失败，请添加品牌分类后重试！');
      }
    }

    // 根据品牌分类的id获取在改分类下所有的品牌的数量
    public function getBrandsTotalByBrandCategoryId ($id)
    {
      return Brand::where('brand_category_id', $id)->count();
    }

    // 根据品牌分类id或id集合批量更新total字段
    public function updateTotalByIds ( $ids )
    {
      $num = 0;

      if ( !is_array($ids) ) {
        $ids = [0=>$ids];
      }

      if ( count($ids) == 0 ) {
        return $num;
      }

      foreach ($ids as  $id) {
        $total = $this->getBrandsTotalByBrandCategoryId($id);
        $num += BrandCategory::where('id', $id)->update(['total' => $total]);
      }

      return $num;
    }
}
