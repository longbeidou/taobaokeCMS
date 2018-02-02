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
            <h5>编辑品牌分类</h5>
        </div>
        <div class="ibox-content">
          <div class="row form-body form-horizontal m-t">
            <div class="col-md-12 droppable sortable ui-droppable ui-sortable">
              <form action="{{ route('brandCategorys.update', $brandCategory->id) }}" method="POST" enctype="multipart/form-data">
              		{{ csrf_field() }}
                  {{ method_field('PATCH') }}
                  <div class="col-md-12">
                      <div class="form-group">
                          <label class="col-sm-3 control-label">品牌分类名称：</label>
                          <div class="col-sm-9">
                              <input type="text" name="name" value="{{ $brandCategory->name }}" class="form-control" required placeholder="请输入要创建的品牌分类名称">
                              <span class="help-block m-b-none">品牌分类名称最多由10个汉字组成</span>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label">排序：</label>
                          <div class="col-sm-9">
                              <input type="number" required name="order" value="{{ $brandCategory->order }}" class="form-control" value="0" placeholder="请输入排序数值">
                              <span class="help-block m-b-none">值越小，排名越靠前！</span>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label">字体图标：</label>
                          <div class="col-sm-9">
                              <input type="text" name="font_icon" value="{{ $brandCategory->font_icon }}" class="form-control"  placeholder="请输入字体图标">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label">是否显示：</label>
                          <div class="col-sm-9">
                              <label class="radio-inline">
                                  <input type="radio" @if($brandCategory->is_show == 1) checked @endif value="1" id="optionsRadios1" name="is_show">显示</label>
                              <label class="radio-inline">
                                  <input type="radio" @if($brandCategory->is_show == 0) checked @endif value="0" id="optionsRadios2" name="is_show">不显示</label>
                          </div>
                      </div>
                  </div>

                  <div style="clear:both;"></div>
                  <div class="hr-line-dashed"></div>

                  <div class="col-md-12">
                      <div class="form-group">
                          <div class="col-sm-12 col-sm-offset-5">
                              <button class="btn btn-primary" type="submit">保存内容</button>
                          </div>
                      </div>
                  </div>
              </form>

            </div>
          </div>
        </div><!-- ibox-content -->
    </div>
  </div>
</div>
@stop
@section('footJs')

@stop
