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
            <h5>修改banner</h5>
        </div>
        <div class="ibox-content">
          <div class="row form-body form-horizontal m-t">
            <div class="col-md-12 droppable sortable ui-droppable ui-sortable">
              <form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
              		{{ csrf_field() }}
                  {{ method_field('PATCH') }}
                  <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">banner简介：</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" value="{{ $banner->name }}" required class="form-control" placeholder="请输入banner介绍">
                            <span class="help-block m-b-none">banner简介最多由30个文字组成</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">网址链接：</label>
                        <div class="col-sm-9">
                            <input type="text" name="link" value="{{ $banner->link }}" required class="form-control" placeholder="请输入网址链接">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">排列顺序：</label>
                        <div class="col-sm-9">
                            <input type="number" value="{{ $banner->order }}" min='0' required max='99' name="order" class="form-control" placeholder="请输入排列顺序">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">banner展示的平台：</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="flat" required>
                              <option @if($banner->flat === 'wx') selected @endif value="wx">移动端</option>
                              <option @if($banner->flat === 'pc') selected @endif value="pc">PC端</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">banner图片：</label>
                        <div class="col-sm-9">
                            <img class="img-thumbnail" style="max-width:400px; max-height:300px;" src="{{ $banner->image }}" alt="">
                            <input type="file" name="image"  class="form-control">
                            <span class="help-block m-b-none text-warning">PC端的图片大小为585px*300px<br>移动端的图片大小为400px*200px</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">是否显示：</label>
                        <div class="col-sm-9">
                            <label class="radio-inline">
                                <input type="radio" @if($banner->is_show == '1') checked @endif value="1" id="optionsRadios1" name="is_show">是</label>
                            <label class="radio-inline">
                                <input type="radio" @if($banner->is_show == '0') checked @endif value="0" id="optionsRadios2" name="is_show">否</label>
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
