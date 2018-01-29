<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CouponCategory;
use App\Http\Requests\CouponCategorysStoreRequest;

class CouponCategorysController extends Controller
{
    // 显示所有优惠券分类的页面
    public function index()
    {
      $title = '优惠券分类列表';

      return view('admin.couponCategory.index', compact('title'));
    }

    // 显示优惠券分类详情的页面
    public function show()
    {

    }

    // 创建优惠券分类的页面
    public function create()
    {
      $title = '编辑优惠券分类';
      return view('admin.couponCategory.create', compact('title'));
    }

    // 创建优惠券分类
    public function store(CouponCategorysStoreRequest $request)
    {
      $couponCategory['self_where'] = $this->makeCategoryString($request->group1, $request->group2);
      $couponCategory['imgage_small'] = $this->getImagesSmallPath($request);
      $couponCategory['category_name'] = $request->category_name;
      $couponCategory['order'] = $request->order;
      $couponCategory['is_show'] = $request->is_show;

      $num = CouponCategory::create($couponCategory);

      if (!$num) {
        return back()->with('danger', '增加信息失败，请重新增加信息！');
      }

      return back()->with('success', '成功插入一条信息！');
    }

    // 编辑优惠券分类的页面
    public function edit()
    {

    }

    // 更新优惠券分类信息
    public function update()
    {

    }

    // 删除优惠券分类信息
    public function destroy()
    {

    }

    // 组合分类条件字符串
    public function makeCategoryString (Array $group1, Array $group2)
    {
      $group1Str = $this->getWhereStr($group1);
      $group2Str = $this->getWhereStr($group2);

      if (!empty($group1Str) && !empty($group2Str)) {
        return $group1Str.'+or+'.$group2Str;
      }

      if (empty($group2Str) || empty($group2Str)) {
        return $group1Str.$group2Str;
      }
    }

    // 将数组的各元素组合成为搜索条件的字符串
    public function getWhereStr (Array $group) {
      $array = [];
      foreach ($group as $value) {
        if (!empty($value['cate']) && !empty($value['word'])) {
          $array[] = $value['cate'].'+=+'.$value['word'];
        }
      }

      if (!empty($array)) {
        return implode('+and+', $array);
      }

      return '';
    }

    // 处理上传的图片
    public function getImagesSmallPath (Request $request) {
      $fileDir = 'img/couponCategory/imageSmall/'.date('Y-m-d').'/';
      $file = $request->file('imgage_small');
      $extension = $file->getClientOriginalExtension();
      $newName = md5(time().str_random(25)).'.'.$extension;
      $file->move($fileDir, $newName);

      return $fileDir.$newName;
    }
}
