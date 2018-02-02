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
            <h5>品牌分类详情</h5>
						<div class="ibox-tools">
							<a class="dropdown-toggle" href="{{ route('categorys.index') }}">
									<i class="fa fa-list"></i> 品牌分类列表
							</a>
						</div>
        </div>
        <div class="ibox-content">
          <div class="row form-body form-horizontal m-t">
              <div class="row">
                  <div class="col-sm-5 text-right">
                    <strong>品牌分类名称</strong>
                  </div>
                  <div class="col-sm-7">
                    <p>{{ $brandCategory->name }}</p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-5 text-right">
                    <strong>排序</strong>
                  </div>
                  <div class="col-sm-7">
                    <p>{{ $brandCategory->order }}</p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-5 text-right">
                    <strong>品牌分类包含的品牌总数</strong>
                  </div>
                  <div class="col-sm-7">
                    <p>{{ $brandCategory->total }}</p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-5 text-right">
                    <strong>显示状态</strong>
                  </div>
                  <div class="col-sm-7">
                    @if($brandCategory->is_show == 1) <p class="text-info">显示</p> @endif
                    @if($brandCategory->is_show == 0) <p class="text-danger">不显示</p> @endif
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-5 text-right">
                    <strong>字体图标</strong>
                  </div>
                  <div class="col-sm-7">
										@if(empty($brandCategory->font_icon))
										<p>&nbsp;</p>
										@else
                    <p>{!! $brandCategory->font_icon !!}</p>
										@endif
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-5 text-right">
                    <strong>栏目创建时间</strong>
                  </div>
                  <div class="col-sm-7">
                    <p>{{ $brandCategory->created_at }}</p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-5 text-right">
                    <strong>栏目更新时间</strong>
                  </div>
                  <div class="col-sm-7">
                    <p>{{ $brandCategory->updated_at }}</p>
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
