@extends('admin.layouts.form.index')

@section('title', $title)
@section('headcss')

@stop
@section('content')
<div class="row">
	<div class="col-sm-6 col-sm-offset-3">
    @include('admin.layouts.form._errors')
    @include('admin.layouts.form._tips')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>banner详情</h5>
						<div class="ibox-tools">
							<a class="dropdown-toggle" href="{{ route('banners.index') }}">
									<i class="fa fa-list"></i> banner列表
							</a>
						</div>
        </div>
        <div class="ibox-content">
          <div class="row form-body form-horizontal m-t">
              <div class="row">
                  <div class="col-sm-3 text-right">
                    <strong>banner简介</strong>
                  </div>
                  <div class="col-sm-9">
                    <p>{{ $banner->name }}</p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-3 text-right">
                    <strong>排序</strong>
                  </div>
                  <div class="col-sm-9">
                    <p>{{ $banner->order }}</p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-3 text-right">
                    <strong>网址链接</strong>
                  </div>
                  <div class="col-sm-9">
                    <p>
                      <a href="{{ $banner->link }}" target="_blank" class="btn btn-info btn-xs">查看</a>
                    </p>
                    <p>{{ $banner->link }}</p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-3 text-right">
                    <strong>显示状态</strong>
                  </div>
                  <div class="col-sm-9">
                    @if($banner->is_show == 1) <p class="text-info">显示</p> @endif
                    @if($banner->is_show == 0) <p class="text-danger">不显示</p> @endif
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-3 text-right">
                    <strong>展示位置</strong>
                  </div>
                  <div class="col-sm-9">
										@if($banner->flat == 'wx')
										<p>移动端展示</p>
										@else
                    <p>PC端展示</p>
										@endif
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-3 text-right">
                    <strong>栏目创建时间</strong>
                  </div>
                  <div class="col-sm-9">
                    <p>{{ $banner->created_at }}</p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-3 text-right">
                    <strong>栏目更新时间</strong>
                  </div>
                  <div class="col-sm-9">
                    <p>{{ $banner->updated_at }}</p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-3 text-right">
                    <strong>图片</strong>
                  </div>
                  <div class="col-sm-9">
                    <p><img class="img-thumbnail"  style="max-width:400px; max-height:300px;" src="{{ $banner->image }}" /></p>
                  </div>
              </div>

              <div style="clear:both;"></div>
              <div class="hr-line-dashed"></div>

          </div>
        </div><!-- ibox-content -->
    </div>
  </div>
</div>
@stop
@section('footJs')

@stop
