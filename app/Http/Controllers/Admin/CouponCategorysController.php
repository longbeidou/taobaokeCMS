<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CouponCategory;
use App\Models\Coupon;
use App\Http\Requests\CouponCategorysStoreRequest;
use App\Http\Requests\CouponCategorysUpdateRequest;
use App\Traits\CouponCategorySelfWhere;

class CouponCategorysController extends Controller
{
    use CouponCategorySelfWhere;

    public $pageSize = 10; // 每页显示的信息数

    // 显示所有优惠券分类的页面
    public function index(Request $request)
    {
      $title = '优惠券分类列表';

      $oldRequest = $request->all();
      $pageSize = $this->getPageSize($request->page_size);
      $couponCategorys = CouponCategory::orderBy('order', 'asc')->paginate($pageSize);
      $goodsTotal = $this->getCateToCouponsTotalNumArr ($couponCategorys, new Coupon);

      return view('admin.couponCategory.index', compact('title', 'couponCategorys', 'oldRequest', 'goodsTotal'));
    }

    // 显示优惠券分类详情的页面
    public function show(CouponCategory $couponCategory)
    {
      $title = '优惠券分类详情';

      if ($couponCategory->is_show == 1) {
        $is_show = '显示';
      } else {
        $is_show = '不显示';
      }

      $selfWhereArray = $this->makeSelfWhereToArray($couponCategory->self_where);
      $selfWhereView = $this->makeSelfWhereArrToView($selfWhereArray);

      return view('admin.couponCategory.show', compact('title', 'couponCategory', 'is_show', 'selfWhereView'));
    }

    // 创建优惠券分类的页面
    public function create()
    {
      $title = '增加优惠券分类';

      return view('admin.couponCategory.create', compact('title'));
    }

    // 创建优惠券分类
    public function store(CouponCategorysStoreRequest $request)
    {
      $couponCategory['self_where'] = $this->makeCategoryString($request->group1, $request->group2);
      $couponCategory['image_small'] = $this->getImagesSmallPath($request);
      $couponCategory['category_name'] = $request->category_name;
      $couponCategory['order'] = $request->order;
      $couponCategory['is_show'] = $request->is_show;
      $couponCategory['font_icon'] = $request->font_icon;

      $num = CouponCategory::create($couponCategory);

      if (!$num) {
        return back()->with('danger', '增加信息失败，请重新增加信息！');
      }

      return back()->with('success', '成功插入一条信息！');
    }

    // 编辑优惠券分类的页面
    public function edit(CouponCategory $couponCategory)
    {
      $title = '编辑优惠券分类';

      $selfWhereArray = $this->makeSelfWhereToArray($couponCategory->self_where);
      $selfWhereView = $this->makeSelfWhereArrToView($selfWhereArray);

      return view('admin.couponCategory.edit', compact('title', 'couponCategory', 'selfWhereView'));
    }

    // 更新优惠券分类信息
    public function update(CouponCategory $couponCategory, CouponCategorysUpdateRequest $request)
    {
      $updateInfo['category_name'] = $request->category_name;
      $updateInfo['is_show'] = $request->is_show;
      $updateInfo['order'] = $request->order;
      $updateInfo['font_icon'] = $request->font_icon;

      if ($request->hasFile('image_small')) {
        $updateInfo['image_small'] = $this->getImagesSmallPath($request);
        $this->unlinkFiles($couponCategory->image_small);
      }

      $selfWhere = $this->makeCategoryString($request->group1, $request->group2);
      if ( $selfWhere != '' ) {
        $updateInfo['self_where'] = $this->makeCategoryString($request->group1, $request->group2);
      }
      $couponCategory->update($updateInfo);

      return redirect()->route('couponCategorys.show', $couponCategory->id)->with('success', '成功更新优惠券分类详情信息！');
    }

    // 根据id删除优惠券分类信息
    public function delete (Request $request)
    {
      $couponCategory = CouponCategory::where('id', $request->id);

      if ( !$couponCategory->count() ) {

        return back()->with('danger', '要删除的信息不存在！');
      }

      $imageSmall = $couponCategory->first(['image_small'])->image_small;
      $this->unlinkFiles($imageSmall);
      $couponCategory->delete();

      return back()->with('success', '成功删除优惠券分类信息！');
    }

    // 根据id集合来删除数据
    public function deleteMany (Request $request)
    {
      $ids = $request->ids;

      if ( empty($ids) ) {
        return back()->with('info', '请选择好要删除的分类再提交删除请求！');
      }

      $this->unlinkFilesByIds($ids);
      $num = CouponCategory::destroy($ids);

      if ( $num ) {
        return back()->with('success', '成功删除'.$num.'条优惠券分类信息！');
      } else {
        return back()->with('danger', '删除失败，请重新操作！');
      }
    }

    // 批量修改优惠券分类的排序
    public function changeOrder (Request $request)
    {
      $idToOrderArr = $request->order;
      $num = 0;

      if ( empty($idToOrderArr) ) {
        return back()->with('danger', '没有可以排序的优惠券分类，请刷新页面重试或者添加优惠券分类后重试！');
      }

      foreach ($idToOrderArr as $id => $order) {
        $num += CouponCategory::where('id', $id)->update(['order'=>$order]);
      }

      if ( $num ) {
        return back()->with('success', '成功修改'.$num.'条优惠券分类信息！');
      } else {
        return back()->with('danger', '修改排序失败，请重新操作！');
      }
    }

    // 设置优惠券分类为显示状态
    public function isShow(Request $request)
    {
      $num = CouponCategory::where('id', $request->id)->update(['is_show'=>1]);

      if ( $num ) {
        return back()->with('success', '成功设置优惠券分类为显示状态。');
      } else {
        return back()->with('danger', '设置优惠券分类为显示状态，失败！');
      }
    }

    // 设置优惠券分类为不显示状态
    public function notShow(Request $request)
    {
      $num = CouponCategory::where('id', $request->id)->update(['is_show'=>0]);

      if ( $num ) {
        return back()->with('success', '成功设置优惠券分类为不显示状态。');
      } else {
        return back()->with('danger', '设置优惠券分类为不显示状态，失败！');
      }
    }

    // 获取请求的pageSize的数据
    public function getPageSize ($pageSize) {
      if (empty($pageSize)) {
        return $this->pageSize;
      }

      return $pageSize;
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

    // 根据id集合删除文件
    public function unlinkFilesByIds ($ids)
    {
      $couponCategorys = CouponCategory::whereIn('id', $ids)->get(['image_small'])->toArray();
      foreach ($couponCategorys as $couponCategory) {
        $this->unlinkFiles($couponCategory['image_small']);
      }
    }

    // 获取id对应的优惠券总数
    public function getCateToCouponsTotalNumArr ($couponCategorys, $coupon)
    {
      $ids = [];

      foreach ($couponCategorys as $couponCategory) {
        $ids[$couponCategory->id] = $this->getGoodsTotalBySelfWhere($couponCategory->self_where, $coupon);
      }

      return $ids;
    }

    // 根据self_where来确定优惠券商品总数
    public function getGoodsTotalBySelfWhere ($self_where, $coupon) {

      return $this->selfWhere($self_where, $coupon)->count();
    }

    // 处理上传的图片
    public function getImagesSmallPath (Request $request) {
      $fileDir = 'img/couponCategory/imageSmall/'.date('Y-m-d').'/';
      $file = $request->file('image_small');
      $extension = $file->getClientOriginalExtension();
      $newName = md5(time().str_random(25)).'.'.$extension;
      $file->move($fileDir, $newName);

      return '/'.$fileDir.$newName;
    }

    // 将self_where组成的数组，显示成视图需要的格式
    public function makeSelfWhereArrToView ($selfWhereArray) {
      if ($selfWhereArray == []) {
        return '';
      }

      $strView = '';

      foreach ($selfWhereArray as $num => $cateWordArr) {
        $i = $num+1;
        $strView .= '<dl class="dl-horizontal"><dt>第'.$i.'组商品组合：</dt>';
        foreach ($cateWordArr as $cateToWordArr) {
          foreach ($cateToWordArr as $cate => $word) {
            $strView .= '<dd><span style="width:120px; display:inline-block;">字段：'.$cate.'</span>';
            $strView .= '<span style="max-width:300px; display:inline-block;">关键词：'.$word.'</span></dd>';
          }
        }
        $strView .= '</dl>';
      }

      return $strView;
    }
}
