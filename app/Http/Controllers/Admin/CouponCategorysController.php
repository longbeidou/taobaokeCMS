<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CouponCategory;
use App\Http\Requests\CouponCategorysStoreRequest;

class CouponCategorysController extends Controller
{
    public $groupAdd = '+or+'; // 连接商品组的符号
    public $cateAndWord = '+=+'; // 连接分类和商品的符号
    public $cateWordToCateWord = '+and+'; // 分类和商品组合之间的链接符号
    public $pageSize = 10; // 每页显示的信息数

    // 显示所有优惠券分类的页面
    public function index(Request $request)
    {
      $title = '优惠券分类列表';

      $oldRequest = $request->all();
      $pageSize = $this->getPageSize($request->page_size);
      $couponCategorys = CouponCategory::orderBy('order', 'asc')->paginate($pageSize);
      $goodsTotal = $this->getCateToCouponsTotalNumArr($couponCategorys);

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

    // 获取请求的pageSize的数据
    public function getPageSize ($pageSize) {
      if (empty($pageSize)) {
        return $this->pageSize;
      }

      return $pageSize;
    }

    // 获取id对应的优惠券总数
    public function getCateToCouponsTotalNumArr ($couponCategorys)
    {
      $ids = [];
      foreach ($couponCategorys as $couponCategory) {
        $ids[$couponCategory->id] = $couponCategory->self_where;

        ///////////////////////////
      }
    }

    // 根据self_where来确定优惠券商品总数
    public function getGoodsTotalBySelfWhere ($self_where) {
      $cateToWordArr = $this->makeSelfWhereToArray($self_where);
      ////////////////////////////////////
    }

    // 根据self_where来进行的查询条件
    public function selfWhere($self_where, $coupon)
    {
      $cateWordGroup = $this->makeSelfWhereToArray($self_where);

      if (empty($cateWordGroup)) {
        return $coupon;
      }

      foreach ($cateWordGroup as $num => $cateToWordArr) {
        if ($num == 0) {
          foreach ($cateToWordArr as $cateToWord) {
            foreach ($cateToWord as $cate => $word) {
              $coupon = $coupon->where($cate, 'like', $word);
            }
          }
        } elseif ($num == 1) {
          $coupon = $coupon->orWhere(function ($query) {
            foreach ($cateToWordArr as $cateToWord) {
              foreach ($cateToWord as $cate => $word) {
                $query = $query->where($cate, 'like', $word);
              }
            }
          });
        }
      }

      return $coupon;
    }

    // 组合分类条件字符串
    public function makeCategoryString (Array $group1, Array $group2)
    {
      $group1Str = $this->getWhereStr($group1);
      $group2Str = $this->getWhereStr($group2);

      if (!empty($group1Str) && !empty($group2Str)) {
        return $group1Str.$this->groupAdd.$group2Str;
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
          $array[] = $value['cate'].$this->cateAndWord.$value['word'];
        }
      }

      if (!empty($array)) {
        return implode($this->cateWordToCateWord, $array);
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

      return '/'.$fileDir.$newName;
    }

    // 将查询字符串转变成数组
    public function makeSelfWhereToArray(string $self_where)
    {
      if (empty($self_where)) {
        return [];
      }

      $cateToWordArr = [];
      $selfWhereArray = explode($this->groupAdd, $self_where);

      foreach ($selfWhereArray as $i => $cateWordGroup) {
        $cateWordArr = explode($this->cateWordToCateWord, $cateWordGroup);
        foreach ($cateWordArr as $j => $cateWord) {
          $cateAndWordArr = explode($this->cateAndWord, $cateWord);
          $cateToWordArr[$i][$j][$cateAndWordArr[0]] = $cateAndWordArr[1];
        }
      }

      return $cateToWordArr;
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
