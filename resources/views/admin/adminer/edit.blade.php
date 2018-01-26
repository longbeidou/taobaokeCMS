@extends('admin.layouts.form.index')

@section('title', $title)
@section('headcss')

@stop
@section('content')
<div class="row">
  <div class="col-sm-6 col-sm-offset-3">
      <div class="ibox float-e-margins">
          @include('admin.layouts.form._errors')
          @include('admin.layouts.form._tips')
          <div class="ibox-title">
              <h5>编辑个人信息</h5>
          </div>
          <div class="ibox-content" style="display: block;">
              <form class="form-horizontal" method="post" action="{{ route('adminers.update', $adminer->id) }}" target="_self">
                  <p>欢迎登录本站(⊙o⊙)</p>
                  <div class="form-group">
                      <label class="col-sm-3 control-label">用户名：</label>

                      <div class="col-sm-8">
                          <input type="text" name="name" placeholder="用户名" required  value="{{ $adminer->name }}" class="form-control">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label">邮箱：</label>

                      <div class="col-sm-8">
                          <input type="email" placeholder="邮箱" name="email" required  value="{{ $adminer->email }}" class="form-control">
                      </div>
                  </div>
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                  <input type="hidden" name="id" value="{{ $adminer->id }}">
                  <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-8">
                          <button class="btn btn-sm btn-white" type="submit">提 交</button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
@stop
@section('footJs')

@stop
