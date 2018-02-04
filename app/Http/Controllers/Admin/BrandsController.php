<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\Coupon;
use App\Http\Requests\BrandsStoreRequest;
use App\Http\Requests\BrandsUpdateRequest;

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

      $pageSize = empty($request->page_size)?$this->pageSize:$request->page_size;

      $brandCategorys = BrandCategory::get(['id', 'name']);
      $brandCategorys = $brandCategorys->count()?$brandCategorys:[];

      $brands = new Brand;
      $brands = empty($request->category)?$brands:$brands->where('brand_category_id', $request->category);
      $brands = $brands->orderBy('order', 'asc')->paginate($pageSize);

      return view('admin.brand.index', compact('title', 'brands', 'brandCategorys', 'idToNameArr', 'oldRequest'));
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
    public function store( BrandsStoreRequest $request )
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
    public function edit ( Brand $brand )
    {
      $title = '编辑品牌信息';
      $option = $this->getOptionStr($brand->brand_category_id);

      return view('admin.brand.edit', compact('title', 'brand', 'option'));
    }

    // 更新用户
    public function update( Brand $brand, BrandsUpdateRequest $request )
    {
      $num = $brand->update([
        'name' => $request->name,
        'order' => $request->order,
        'brand_category_id' => $request->brand_category_id,
        'is_show' => $request->is_show,
        'keywords' => $request->keywords,
        'image' => $this->getImagesUpdatePath($request, $this->imagePath, 'image', $brand),
        'total' => $this->getCouponsTotalByBrandKeywords($request->keywords)
      ]);

      if ( $num ) {
        return redirect()->route('brands.index')->with('success', '成功更新id为'.$brand->id.'的品牌信息！');
      } else {
        return redirect()->route('brands.index')->with('warning', '更新id为'.$brand->id.'的品牌信息失败！');
      }
    }

    // 删除用户
    public function destroy()
    {
      //
    }

    // 设置展示
    public function isShow(Request $request)
    {
      $num = Brand::where('id', $request->id)->update(['is_show'=>'1']);

      if ($num) {
        return redirect()->route('brands.index')->with('success','成功设置id为'.$request->id.'的品牌信息为显示状态！');
      } else {
        return redirect()->route('brands.index')->with('warning', '要设置id为'.$request->id.'的品牌为显示状态的信息不存在！');
      }
    }

    // 设置不展示
    public function notShow(Request $request)
    {
      $num = Brand::where('id', $request->id)->update(['is_show'=>'0']);

      if ($num) {
        return redirect()->route('brands.index')->with('success','成功设置id为'.$request->id.'的品牌信息为不显示状态！');
      } else {
        return redirect()->route('brands.index')->with('warning', '要设置id为'.$request->id.'的品牌为不显示状态的信息不存在！');
      }
    }

    // 根据id删除
    public function delete(Request $request)
    {
      $brand = Brand::where('id', $request->id);

      if (!$brand->count()) {
        return redirect()->route('brands.index')->with('warning', '要删除的信息不存在！');
      }

      $this->unlinkFiles($brand->first()->image);

      if ($brand->delete()) {
        return redirect()->route('brands.index')->with('success','成功删除品牌信息！');
      } else {
        return redirect()->route('brands.index')->with('warning', '要删除的信息不存在！');
      }
    }

    // 根据id集合批量删除
    public function deleteMany(Request $request)
    {
      $ids = $request->ids;

      if (!count($ids)) {
        return redirect()->route('brands.index')->with('info', '没有删除任何品牌信息！');
      }

      $brands = Brand::whereIn('id', $ids)->get(['image']);

      foreach ($brands as $brand) {
        $this->unlinkFiles($brand->image);
      }

      if ($num = Brand::destroy($ids)) {
        return redirect()->route('brands.index')->with('success', '成功删除'.$num.'条品牌信息！');
      } else {
        return redirect()->route('brands.index')->with('info', '没有删除任何品牌信息！');
      }
    }

    // 修改排序
    public function changeOrder(Request $request)
    {
      $idToorderArrs = $request->order;
      $num = 0;

      if (!count($idToorderArrs)) {
        return redirect()->route('brands.index')->with('info', '目前没有品牌，修改排序前，请先添加品牌信息！');
      }

      foreach ($idToorderArrs as $id=>$order) {
        $num += Brand::where('id', $id)->update(['order'=>$order]);
      }

      if ($num) {
        return redirect()->route('brands.index')->with('success', '成功更新'.$num.'条商品信息的排序！');
      } else {
        return redirect()->route('brands.index')->with('info', '没有更新任何品牌的排序！');
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
