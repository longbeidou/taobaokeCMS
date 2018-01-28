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
            <h5>批量删除优惠券信息</h5>
        </div>
        <div class="ibox-content">
           <p><strong>删除数据库全部优惠券</strong></p>
            <form class="form-horizontal" method="post" action="{{ route('admin.coupons.delete.all') }}">
              <div class="col-md-12">
                  <div class="form-group">
                      <label class="col-sm-3 control-label">密码：</label>
                      <div class="col-sm-9">
                          <input type="password" class="form-control" required name="password" placeholder="请输入管理员登录密码">
                      </div>
                  </div>
                  {{ csrf_field() }}
                  <input type="hidden" name="adminer_id" value="{{ session('adminer_id') }}">
                  <div class="form-group">
                      <div class="col-sm-12 col-sm-offset-3">
                          <button class="btn btn-warning" type="submit">删除</button>
                      </div>
                  </div>
              </div>
            </form>
            <p class="text-danger"><strong>Tips:</strong> 请慎重操作，此操作不可恢复...</p>
        </div>
        <div class="ibox-content">
            <p><strong>删除数据库指定日期的商品优惠券</strong></p>
            <form class="form-horizontal" action="{{ route('admin.coupons.delete.fromdatetodate') }}" method="post">
              <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">起始日期：</label>
                        <div class="col-sm-9">
                            <input type="date" name="date_begin" value="{{ old('date_begin') }}" required class="form-control" placeholder="请输入起始日期"> <span class="help-block m-b-none">起始日期的时间按照 00:00:00 算</span>

                        </div>
                    </div>
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-sm-3 control-label">截止日期：</label>
                        <div class="col-sm-9">
                            <input type="date" name="date_end" value="{{ old('date_end') }}" required class="form-control" placeholder="请输入截止日期"> <span class="help-block m-b-none">截止日期的时间按照 23:59:59 算</span>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 col-sm-offset-3">
                            <button class="btn btn-warning" type="submit">删除</button>
                        </div>
                    </div>
                </div>
                <p class="text-danger"><strong>Tips:</strong> 请慎重操作，此操作不可恢复...</p>
            </form>
        </div>
    </div>
</div>
</div>
@stop
@section('footJs')

@stop
