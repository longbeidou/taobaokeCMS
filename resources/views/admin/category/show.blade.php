@extends('admin.layouts.form.index')

@section('title', $title)
@section('headcss')

@stop
@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
    @include('admin.layouts.form._errors')
    @include('admin.layouts.form._tips')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>编辑栏目分类</h5>
						<div class="ibox-tools">
							<a class="dropdown-toggle" href="{{ route('categorys.index') }}">
									<i class="fa fa-list"></i> 栏目分类列表
							</a>
						</div>
        </div>
        <div class="ibox-content">
          <div class="row form-body form-horizontal m-t">
              <div class="row">
                  <div class="col-sm-3 text-right">
                    <strong>栏目名称</strong>
                  </div>
                  <div class="col-sm-9">
                    <p>{{ $category->name }}</p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-3 text-right">
                    <strong>显示状态</strong>
                  </div>
                  <div class="col-sm-9">
                    @if($category->is_show == 1) <p class="text-info">显示</p> @endif
                    @if($category->is_show == 0) <p class="text-danger">不显示</p> @endif
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-3 text-right">
                    <strong>字体图标</strong>
                  </div>
                  <div class="col-sm-9">
                    <p>{!! $category->font_icon !!}</p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-3 text-right">
                    <strong>导航小图片</strong>
                  </div>
                  <div class="col-sm-9">
                    <p>
                      <img class="img-thumbnail" src="{{ $category->image_small }}" style="width:41px; height:41px;" alt="">
                    </p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-3 text-right">
                    <strong>栏目创建时间</strong>
                  </div>
                  <div class="col-sm-9">
                    <p>{{ $category->created_at }}</p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-3 text-right">
                    <strong>栏目更新时间</strong>
                  </div>
                  <div class="col-sm-9">
                    <p>{{ $category->updated_at }}</p>
                  </div>
              </div>

              <div style="clear:both;"></div>
              <div class="hr-line-dashed"></div>

              <div class="row text-center">
                  <h4>栏目的链接详情</h4>
              </div>
              <div class="row">
                  <div class="col-sm-3 text-right">
                      <strong>PC端链接</strong>
                  </div>
                  <div class="col-sm-1">
                      @if($category->link_pc == 1) <span class="text-info">显示</span> @endif
                      @if($category->link_pc == 0) <span class="text-danger">不显示</span> @endif
                  </div>
                  <div class="col-sm-1">
                     <a href="{{ $category->link_pc}}">查看</a>
                  </div>
                  <div class="col-sm-7">
                     <p>{{ $category->link_pc}}</p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-3 text-right">
                      <strong>移动端链接</strong>
                  </div>
                  <div class="col-sm-1">
                      @if($category->link_wx == 1) <span class="text-info">显示</span> @endif
                      @if($category->link_wx == 0) <span class="text-danger">不显示</span> @endif
                  </div>
                  <div class="col-sm-1">
                     <a href="{{ $category->link_wx}}">查看</a>
                  </div>
                  <div class="col-sm-7">
                     <p>{{ $category->link_wx}}</p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-3 text-right">
                      <strong>微信端链接</strong>
                  </div>
                  <div class="col-sm-1">
                      @if($category->link_wechat == 1) <span class="text-info">显示</span> @endif
                      @if($category->link_wechat == 0) <span class="text-danger">不显示</span> @endif
                  </div>
                  <div class="col-sm-1">
                     <a href="{{ $category->link_wechat}}">查看</a>
                  </div>
                  <div class="col-sm-7">
                     <p>{{ $category->link_wechat}}</p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-3 text-right">
                      <strong>QQ端链接</strong>
                  </div>
                  <div class="col-sm-1">
                      @if($category->link_qq == 1) <span class="text-info">显示</span> @endif
                      @if($category->link_qq == 0) <span class="text-danger">不显示</span> @endif
                  </div>
                  <div class="col-sm-1">
                     <a href="{{ $category->link_qq}}">查看</a>
                  </div>
                  <div class="col-sm-7">
                     <p>{{ $category->link_qq}}</p>
                  </div>
              </div>

              <div style="clear:both;"></div>
              <div class="hr-line-dashed"></div>

              <div class="row text-center">
                  <h4>魔方图片</h4>
              </div>
              <div class="row">
                <div class="text-center col-sm-4 text-center">
                    <img class="img-thumbnail" src="{{ $category->image_magic_left}}" style="width:320px; height:320px" alt="">
                    <p>魔方左侧大正方形图片</p>
                </div>
                <div class="text-center col-sm-4 text-center">
                    <img class="img-thumbnail" src="{{ $category->image_magic_buttom}}" style="width:320px; height:160px" alt="">
                    <p>魔方右侧长方形图片</p>
                </div>
                <div class="text-center col-sm-4 text-center">
                    <img class="img-thumbnail" src="{{ $category->image_magic_top}}" style="width:160px; height:160px" alt="">
                    <p>魔方右侧小正方形图片</p>
                </div>
              </div>
          </div>
        </div><!-- ibox-content -->
    </div>
  </div>
</div>
@stop
@section('footJs')

@stop
