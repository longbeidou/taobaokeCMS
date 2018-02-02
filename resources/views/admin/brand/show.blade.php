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
            <h5>品牌详情</h5>
						<div class="ibox-tools">
							<a class="dropdown-toggle" href="{{ route('brands.index') }}">
									<i class="fa fa-list"></i> 品牌列表
							</a>
						</div>
        </div>
        <div class="ibox-content">
          <div class="row form-body form-horizontal m-t">
              <div class="row">
                  <div class="col-sm-5 text-right">
                    <strong>品牌名称</strong>
                  </div>
                  <div class="col-sm-7">
                    <p>{{ $brand->name }}</p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-5 text-right">
                    <strong>排序</strong>
                  </div>
                  <div class="col-sm-7">
                    <p>{{ $brand->order }}</p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-5 text-right">
                    <strong>品牌包含的优惠券总数</strong>
                  </div>
                  <div class="col-sm-7">
                    <p>{{ $brand->total }}</p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-5 text-right">
                    <strong>所属品牌分类</strong>
                  </div>
                  <div class="col-sm-7">
                    <p>{{ $idToNameArr[$brand->brand_category_id] }}</p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-5 text-right">
                    <strong>关键词</strong>
                  </div>
                  <div class="col-sm-7">
                    <p>{{ $brand->keywords }}</p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-5 text-right">
                    <strong>显示状态</strong>
                  </div>
                  <div class="col-sm-7">
                    @if($brand->is_show == 1) <p class="text-info">显示</p> @endif
                    @if($brand->is_show == 0) <p class="text-danger">不显示</p> @endif
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-5 text-right">
                    <strong>图片</strong>
                  </div>
                  <div class="col-sm-7">
                    <p>
                      @if(empty($brand->image))
                      <img class="img-thumbnail" src="/adminstyle/img/nopicture.jpg" style="max-height:45px;" alt="">
                      @else
                      <img  class="img-thumbnail"  src="{{ $brand->image }}" style="max-width:75px; max-height:45px;" />
                      @endif
                    </p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-5 text-right">
                    <strong>栏目创建时间</strong>
                  </div>
                  <div class="col-sm-7">
                    <p>{{ $brand->created_at }}</p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-5 text-right">
                    <strong>栏目更新时间</strong>
                  </div>
                  <div class="col-sm-7">
                    <p>{{ $brand->updated_at }}</p>
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
