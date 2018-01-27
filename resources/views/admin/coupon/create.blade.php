@extends('admin.layouts.form.index')

@section('title', $title)
@section('headcss')

@stop
@section('content')
<div class="row">
  <div class="col-sm-8 col-sm-offset-2">
    <div class="ibox float-e-margins">
        @include('admin.layouts.form._errors')        
        @include('admin.layouts.form._tips')
        <div class="ibox-title">
            <h5>将Excel优惠券文件的信息导入数据库</h5>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal" method="post" action="{{ route('admin.coupons.storeExcel') }}" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-sm-3 control-label">请选择Excel文件：</label>
                    <div class="col-sm-9">
                        <input type="file" name="excel" class="form-control">
                        <p>请从本地选择优惠券的Excel文件...</p>
                        <p></p>
                    </div>
                </div>
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset-3">
                        <button class="btn btn-primary" type="submit">提交</button>
                    </div>
                </div>
            </form>
            <p class="text-danger">1.上传文件前，请务必将优惠券Excel文件的第一行进行修改，改成从1开始，逐步加1，到22结束！<br/>2.上传文件需要一定的时间，需要等待几分钟，请不要刷新页面！</p>
        </div>
    </div>
</div>
</div>
@stop
@section('footJs')

@stop
