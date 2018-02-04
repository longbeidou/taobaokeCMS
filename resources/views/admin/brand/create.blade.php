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
            <h5>创建品牌</h5>
        </div>
        <div class="ibox-content">
          <div class="row form-body form-horizontal m-t">
            <div class="col-md-12 droppable sortable ui-droppable ui-sortable">
              <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
              		{{ csrf_field() }}
                  <div class="col-md-12">
                      <div class="form-group">
                          <label class="col-sm-3 control-label">品牌名称：</label>
                          <div class="col-sm-9">
                              <input type="text" name="name" value="{{ old('name') }}" class="form-control" required placeholder="请输入要创建的品牌名称">
                              <span class="help-block m-b-none">品牌名称最多由10个汉字组成</span>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label">排序：</label>
                          <div class="col-sm-9">
                              <input type="number" required name="order" class="form-control" @if(old('order')) value="{{ old('order') }}" @endif @if(!old('order')) value="0" @endif placeholder="请输入排序数值">
                              <span class="help-block m-b-none">值越小，排名越靠前！</span>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label">所属品牌分类：</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="brand_category_id">
                                  {!! $option !!}
                              </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label">品牌关键词：</label>
                          <div class="col-sm-9">
                              <input type="text" name="keywords" value="{{ old('keywords') }}" class="form-control" required placeholder="请输入品牌关键词">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label">上传图片：</label>
                          <div class="col-sm-9">
                              <input type="file" required name="image" class="form-control">
                              <span class="help-block m-b-none text-warning"><strong>提示：</strong>上传图片的大小为：75px*45px</span>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label">是否显示：</label>
                          <div class="col-sm-9">
                              <label class="radio-inline">
                                  <input type="radio" @if(old('is_show') === '1' || empty(old('is_show'))) checked @endif  value="1" id="optionsRadios1" name="is_show">显示</label>
                              <label class="radio-inline">
                                  <input type="radio" @if(old('is_show') === '0') checked @endif value="0" id="optionsRadios2" name="is_show">不显示</label>
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
