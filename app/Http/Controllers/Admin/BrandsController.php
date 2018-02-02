<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\Coupon;

class BrandsController extends Controller
{
    public $pageSize = 10;
    public $imagePath = 'img/brand/image/';

    // 显示所有品牌列表的页面
    public function index ( Request $request )
    {
      $title = '品牌列表';
      $oldRequest = $request->all();
      $idToNameArr = $this->getBrandIdToNameArr();

      if ( !empty($request->pageSize) ) {
        $pageSize = $request->pageSize;
      }

      $pageSize = $this->pageSize;
      $brands = Brand::orderBy('order', 'asc')->paginate($pageSize);

      return view('admin.brand.index', compact('title', 'brands', 'idToNameArr', 'oldRequest'));
    }

    // 创建品牌的页面
    public function create ()
    {
      $title = '创建品牌';
      $option = $this->getOptionStr();

      return view('admin.brand.create', compact('title', 'option'));
    }

    // 显示品牌详情的页面
    public function show ( Brand $brand )
    {
      $title = '品牌详情';
      $idToNameArr = $this->getBrandIdToNameArr();

      return view('admin.brand.show', compact('brand', 'title', 'idToNameArr'));
    }

    // 创建品牌
    public function store( Request $request )
    {
      $brand = Brand::create([
        'name' => $request->name,
        'order' => $request->order,
        'brand_category_id' => $request->brand_category_id,
        'is_show' => $request->is_show,
        'keywords' => $request->keywords,
        'image' => $this->getImagesSavePath($request, $this->imagePath, 'image'),
      ]);

      Brand::where('id', $brand->id)->update([
        'total' => $this->getCouponsTotalByBrandKeywords($request->keywords)
      ]);

      return back()->with('success', '成功创建品牌！');
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

    // 根据品牌的id获取在该品牌下所有的优惠券的数量
    public function getCouponsTotalByBrandKeywords ($keywords)
    {
      return Coupon::where('goods_name', 'like', $keywords)->count();
    }

    // 根据品牌id与keywords的集合批量更新total字段
    public function updateTotalByIdToKeywordsArr ( Array $idToKeywordArr )
    {
      $num = 0;

      if ( count($ids) == 0 ) {
        return $num;
      }

      foreach ($idToKeywordArr as  $id=>$keywords) {
        $total = $this->getCouponsTotalByBrandKeywords($keywords);
        $num += Brand::where('id', $id)->update(['total' => $total]);
      }

      return $num;
    }

    // 获取option标签的字符串
    public function getOptionStr ($brandCategoryId = 0)
    {
      $option = '';
      $idToNameArr = $this->getBrandIdToNameArr();

      if ( count($idToNameArr) ) {
        foreach ($idToNameArr as $id => $name) {
          $selected = $id == $brandCategoryId ? 'selected':'';
          $selectClass = $id == $brandCategoryId ? 'class="text-danger"':'';
          $option .= '<option '.$selectClass.' '.$selected.' value="'.$id.'">'.$name.'</option>';
        }
      } else {
        $option = '<option value="false">---请先添加品牌分类---</option>';
      }

      return $option;
    }

    public function getBrandIdToNameArr()
    {
      $idToNameArr = [];
      $brandCategoryArr = BrandCategory::get(['name','id']);

      if ( $brandCategoryArr->count() ) {
        foreach ($brandCategoryArr as $brandCategory) {
          $idToNameArr[$brandCategory->id] = $brandCategory->name;
        }
      }

      return $idToNameArr;
    }
}
