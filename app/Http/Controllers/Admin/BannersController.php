<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannerStoreRequest;
use App\Http\Requests\BannerUpdateRequest;
use App\Models\Banner;

class BannersController extends Controller
{
    public $imagePath = 'img/banners/';

    // 显示列表
    public function index (Request $request)
    {
      $title = 'banner列表';
      $oldRequst = $request->all();

      $banners = new Banner;

      if ($request->flat == 'pc') {
        $banners = $banners->where('flat', 'pc');
      }

      if ($request->flat == 'wx') {
        $banners = $banners->where('flat', 'wx');
      }

      $banners = $banners->orderBy('order', 'asc')->get();

      return view('admin.banner.index', compact('title', 'banners', 'oldRequst'));
    }

    // 显示用户个人信息的页面
    public function show (Banner $banner)
    {
      $title = 'banner的详情';

      return view('admin.banner.show', compact('title', 'banner'));
    }

    // 创建banner的页面
    public function create ()
    {
      $title = '创建banner';

      return view('admin.banner.create', compact('title'));
    }

    // 创建banner
    public function store (BannerStoreRequest $request)
    {
       Banner::create([
         'name' => $request->name,
         'link' => $request->link,
         'order' => $request->order,
         'is_show' => $request->is_show,
         'flat' => $request->flat,
         'image' => $this->getImagesSavePath($request, $this->imagePath, 'image')
       ]);

       return back()->with('success', '成功添加banner信息！');
    }

    // 修改banner的页面
    public function edit (Banner $banner)
    {
      $title = '编辑banner';

      return view('admin.banner.edit', compact('banner', 'title'));
    }

    // 更新用户
    public function update (Banner $banner, BannerUpdateRequest $request)
    {
      $banner->update([
        'name' => $request->name,
        'link' => $request->link,
        'order' => $request->order,
        'is_show' => $request->is_show,
        'flat' => $request->flat,
        'image' => $this->getImagesUpdatePath($request, $this->imagePath, 'image', $banner)
      ]);

      return redirect()->route('banners.index')->with('success', '成功更新banner');
    }

    // 删除用户
    public function delete ( Request $request )
    {
      $banner = Banner::where('id', $request->id);

      if ( $banner->count() ) {
        $this->unlinkFiles($banner->first(['image'])->image);
        Banner::destroy($request->id);
        return redirect()->route('banners.index')->with('success', '成功删除id为'.$request->id.'的banner信息！');
      } else {
        return redirect()->route('banners.index')->with('warning', '删除id为'.$request->id.'的bannee信息失败！');
      }
    }

    // 根据id来设置banner为显示状态
    public function isShow ( Request $request )
    {
      $num = Banner::where('id', $request->id)->update(['is_show'=>1]);

      if ($num) {
        return redirect()->route('banners.index')->with('success', '成功设置id为'.$request->id.'的banner为显示状态');
      } else {
        return redirect()->route('banners.index')->with('info', '要设置id为'.$request->id.'的banner不存在');
      }
    }

    // 根据id来设置banner为不显示状态
    public function notShow ( Request $request )
    {
      $num = Banner::where('id', $request->id)->update(['is_show'=>0]);

      if ($num) {
        return redirect()->route('banners.index')->with('success', '成功设置id为'.$request->id.'的banner为不显示状态');
      } else {
        return redirect()->route('banners.index')->with('info', '要设置id为'.$request->id.'的banner不存在');
      }
    }

    // 根据id集合批量删除信息
    public function deleteMany ( Request $request )
    {
      $ids = $request->ids;

      if ( $ids === null ) {
        return redirect()->route('banners.index')->with('info', '请选择要删除的banner信息再提交！');
      }

      $banners = Banner::whereIn('id', $ids)->get(['image']);

      if ( $num = Banner::destroy($ids) ) {
        foreach ($banners as $banner) {
          $this->unlinkFiles($banner->image);
        }

        return redirect()->route('banners.index')->with('success', '成功删除'.$num.'条banner信息！');
      }

      return redirect()->route('banners.index')->with('info', '要删除的信息不存在，没有删除任何信息！');
    }

    // 批量修改排序
    public function changeOrder ( Request $request )
    {
      $idToOrderArr = $request->order;

      if ( $idToOrderArr == null )
          return redirect()->route('banners.index')->with('info', '没有修改任何banner的排序');

      $num = 0;

      foreach ($idToOrderArr  as $id => $order) {
        $num += Banner::where('id', $id)->update(['order'=>$order]);
      }

      if ($num)
          return redirect()->route('banners.index')->with('success', '成功修改'.$num.'条banner的信息！');

      return redirect()->route('banners.index')->with('warning', '没有修改任何banner信息，请刷新页面重新！');
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
    public function getImagesUpdatePath (Request $request, String $path, String $field, $banner)
    {
      $path = $this->getImagesSavePath($request, $path, $field);

      if ( empty($path) ) {

        return $banner->$field;
      }

      $this->unlinkFiles($banner->$field);

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
}
