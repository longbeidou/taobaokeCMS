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
            <h5>增加优惠券分类</h5>
        </div>
        <div class="ibox-content">
          <div class="row form-body form-horizontal m-t">
            <div class="col-md-12 droppable sortable ui-droppable ui-sortable">
              <form action="{{ route('couponCategorys.store') }}" method="POST" enctype="multipart/form-data">
              		{{ csrf_field() }}
                  <div class="col-md-12">
                      <div class="form-group">
                          <label class="col-sm-3 control-label">栏目名称<span class="text-warning">*</span></label>
                          <div class="col-sm-9">
                              <input type="text" name="name" class="form-control" required placeholder="请输入栏目的分类名称">
                              <span class="help-block m-b-none">栏目分类名称最多由10个汉字组成</span>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label">排序<span class="text-warning">*</span></label>
                          <div class="col-sm-9">
                              <input type="number" required name="order" class="form-control" value="0" placeholder="请输入排序数值">
                              <span class="help-block m-b-none">值越小，排名越靠前！</span>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label">显示状态</label>
                          <div class="col-sm-9">
                              <label class="radio-inline">
                                  <input type="radio" checked value="1" id="optionsRadios1" name="is_show">显示</label>
                              <label class="radio-inline">
                                  <input type="radio" value="0" id="optionsRadios2" name="is_show">不显示</label>
                          </div>
                      </div>
											<div class="form-group">
													<label class="col-sm-3 control-label">字体图标</label>
													<div class="col-sm-9">
															<input type="text" name="font_icon" class="form-control"  placeholder="请输入字体图标的标签">
															<span class="help-block m-b-none">字体图标由完成的i标签组成</span>
													</div>
											</div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label">导航小图片</label>
                          <div class="col-sm-9">
                              <input type="file" name="imgage_small" class="form-control">
                              <span class="help-block m-b-none text-warning"><strong>提示：</strong>上传图片的大小为：41px*41px</span>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label">魔方左侧大图片</label>
                          <div class="col-sm-9">
                              <input type="file" name="imgage_small" class="form-control">
                              <span class="help-block m-b-none text-warning"><strong>提示：</strong>上传图片的大小为：320px*320px</span>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label">魔方右侧正方形图片</label>
                          <div class="col-sm-9">
                              <input type="file" name="imgage_small" class="form-control">
                              <span class="help-block m-b-none text-warning"><strong>提示：</strong>上传图片的大小为：160px*160px</span>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label">魔方右侧长方形图片</label>
                          <div class="col-sm-9">
                              <input type="file" name="imgage_small" class="form-control">
                              <span class="help-block m-b-none text-warning"><strong>提示：</strong>上传图片的大小为：320px*160px</span>
                          </div>
                      </div>
                  </div>

                  <div style="clear:both;"></div>
                  <div class="hr-line-dashed"></div>

                  <h3 class="text-center"><strong>PC端</strong></h3>
                  <div class="col-md-12">
                      <div class="form-group">
                          <label class="col-sm-3 control-label">链接</label>
                          <div class="col-sm-9">
                              <input type="text" name="link_pc" class="form-control" placeholder="请输入网址链接">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label">显示状态</label>
                          <div class="col-sm-9">
                              <label class="radio-inline">
                                  <input type="radio" checked value="1" id="optionsRadios1" name="is_show_pc">显示</label>
                              <label class="radio-inline">
                                  <input type="radio" value="2" id="optionsRadios2" name="is_show_pc">不显示</label>
                          </div>
                      </div>
                  </div>

                  <div style="clear:both;"></div>
                  <div class="hr-line-dashed"></div>

                  <h3 class="text-center"><strong>移动端</strong></h3>
                  <div class="col-md-12">
                      <div class="form-group">
                          <label class="col-sm-3 control-label">链接</label>
                          <div class="col-sm-9">
                              <input type="text" name="link_wx" class="form-control" placeholder="请输入网址链接">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label">显示状态</label>
                          <div class="col-sm-9">
                              <label class="radio-inline">
                                  <input type="radio" checked value="1" id="optionsRadios1" name="is_show_wx">显示</label>
                              <label class="radio-inline">
                                  <input type="radio" value="2" id="optionsRadios2" name="is_show_wx">不显示</label>
                          </div>
                      </div>
                  </div>

                  <div style="clear:both;"></div>
                  <div class="hr-line-dashed"></div>

                  <h3 class="text-center"><strong>微信端</strong></h3>
                  <div class="col-md-12">
                      <div class="form-group">
                          <label class="col-sm-3 control-label">链接</label>
                          <div class="col-sm-9">
                              <input type="text" name="link_wechat" class="form-control" placeholder="请输入网址链接">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label">显示状态</label>
                          <div class="col-sm-9">
                              <label class="radio-inline">
                                  <input type="radio" checked value="1" id="optionsRadios1" name="is_show_wechat">显示</label>
                              <label class="radio-inline">
                                  <input type="radio" value="2" id="optionsRadios2" name="is_show_wechat">不显示</label>
                          </div>
                      </div>
                  </div>

                  <div style="clear:both;"></div>
                  <div class="hr-line-dashed"></div>

                  <h3 class="text-center"><strong>QQ端</strong></h3>
                  <div class="col-md-12">
                      <div class="form-group">
                          <label class="col-sm-3 control-label">链接</label>
                          <div class="col-sm-9">
                              <input type="text" name="link_qq" class="form-control" placeholder="请输入网址链接">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label">显示状态</label>
                          <div class="col-sm-9">
                              <label class="radio-inline">
                                  <input type="radio" checked value="1" id="optionsRadios1" name="is_show_qq">显示</label>
                              <label class="radio-inline">
                                  <input type="radio" value="2" id="optionsRadios2" name="is_show_qq">不显示</label>
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
                  <label class="col-sm-3 control-label">关于网址链接的说明</label>
                  <div class="col-sm-9">
                      <p class="form-control-static">系统会根据不同的访问终端来返回对应的链接，以此实现不通过的终端访问不同的内容。</p>
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
