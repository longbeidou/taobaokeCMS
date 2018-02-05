@extends('admin.layouts.form.index')

@section('title', $title)
@section('headcss')

@stop
@section('content')
<div class="row">
  <div class="col-sm-10 col-sm-offset-1">
      @include('admin.layouts.form._errors')
      @include('admin.layouts.form._tips')
  </div>
  <div class="col-sm-6 col-sm-offset-1">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>将Excel优惠券文件的信息导入数据库</h5>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal" method="post" action="{{ route('admin.coupons.storeExcel') }}" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-sm-4 control-label">请选择Excel文件：</label>
                    <div class="col-sm-8">
                        <input type="file" name="excel" class="form-control">
                        <p>请从本地选择优惠券的Excel文件...</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">是否同步更新品牌券：</label>
                    <div class="col-sm-8">
                        <label class="radio-inline">
                            <input type="radio"  value="1" id="optionsRadios1" name="brand">是</label>
                        <label class="radio-inline">
                            <input type="radio" checked value="0" id="optionsRadios2" name="brand">否</label>
                    </div>
                </div>
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset-3">
                        <button class="btn btn-primary" type="submit">提交</button>
                    </div>
                </div>
            </form>
            <p class="text-danger">
              1.上传文件前，请务必将优惠券Excel文件的第一行进行修改，改成从1开始，逐步加1，到22结束！<br/>
              2.上传文件需要一定的时间，需要等待几分钟，请不要刷新页面！<br/>
              3.选择同步更新品牌券会增加服务器压力，请根据实际情况选择！
            </p>
        </div>
    </div>
  </div>

  <div class="col-sm-4 col-sm-offset-0">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>一键更新品牌券相关信息</h5>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal" method="post" action="{{ route('coupons.updateBrandsTotalOneTime') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset-4">
                        <button class="btn btn-primary" type="submit">一键更新</button>
                    </div>
                </div>
            </form>
            <p class="text-danger">
              1.如果在上传Excel文件的时候没有选择更新品牌券，请手动选择提交【一键更新】<br />
              2.此更新的效果是更新brands数据表的total字段
            </p>
        </div>
    </div>
  </div>
</div>
@stop
@section('footJs')

@stop
