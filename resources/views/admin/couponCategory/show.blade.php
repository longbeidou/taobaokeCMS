@extends('admin.layouts.form.index')

@section('title', $title)
@section('headcss')

@stop
@section('content')
<div class="row">
	<div class="col-sm-8 col-sm-offset-2">
    @include('admin.layouts.form._errors')
    @include('admin.layouts.form._tips')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>优惠券分类详情</h5>
            <div class="ibox-tools">
                <a class="dropdown-toggle" href="{{ route('couponCategorys.index') }}">
                    <i class="fa fa-list"></i> 优惠券分类列表
                </a>
            </div>
        </div>
        <div class="ibox-content">
          <div class="row form-body form-horizontal m-t">
            <div class="col-md-12 droppable sortable ui-droppable ui-sortable">

              <div class="col-md-12">
                  <div class="form-group">
                      <label class="col-sm-3 control-label">分类名称：</label>
                      <div class="col-sm-9">
                          <p class="form-control-static">{{ $couponCategory->category_name }}</p>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label">排序：</label>
                      <div class="col-sm-9">
                          <p class="form-control-static">{{ $couponCategory->order }}</p>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label">图片：</label>
                      <div class="col-sm-9">
                          <p class="form-control-static">
                            <img src="{{ $couponCategory->imgage_small }}" style="max-height:50px;" alt="">
                          </p>
                      </div>
                  </div>
									<div class="form-group">
											<label class="col-sm-3 control-label">字体图标：</label>
											<div class="col-sm-9">
													<p class="form-control-static">{!! $couponCategory->font_icon !!}</p>
											</div>
									</div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label">是否显示：</label>
                      <div class="col-sm-9">
                          <p class="form-control-static">{{ $is_show }}</p>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label">商品组合条件：</label>
                      <div class="col-sm-9">
                        {!! $selfWhereView !!}
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label">创建日期：</label>
                      <div class="col-sm-9">
                          <p class="form-control-static">{{ $couponCategory->created_at}}</p>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label">修改日期：</label>
                      <div class="col-sm-9">
                          <p class="form-control-static">{{ $couponCategory->updated_at}}</p>
                      </div>
                  </div>
              </div>

              <div style="clear:both;"></div>
              <div class="hr-line-dashed"></div>

              <div class="form-group">
                  <label class="col-sm-3 control-label">关键词填写说明：</label>
                  <div class="col-sm-9">
                      <p class="form-control-static">
                        “%关键词%”表示关键词可以出现在任何位置；<br>
                        “关键词%”表示以”关键词“开头的句子；<br />
                        “%关键词”表示以”关键词“结尾的句子。<br />
                      </p>
                  </div>
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
