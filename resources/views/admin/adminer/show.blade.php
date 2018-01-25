@extends('admin.layouts.form.index')

@section('title', $title)
@section('headcss')

@stop
@section('content')
<div class="row">
  <div class="col-sm-6 col-sm-offset-3">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
              <h5>管理员个人信息</h5>
          </div>
          <div class="ibox-content" style="display: block;">
              <form class="form-horizontal">
                  <p>欢迎登录本站(⊙o⊙)</p>
                  <div class="form-group">
                      <label class="col-sm-3 control-label">用户名：</label>

                      <div class="col-sm-8">
                          <input type="email" placeholder="用户名" disabled value="{{ $adminer->name }}" class="form-control">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label">邮箱：</label>

                      <div class="col-sm-8">
                          <input type="email" placeholder="邮箱" disabled value="{{ $adminer->email }}" class="form-control">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label">创建时间：</label>

                      <div class="col-sm-8">
                          <input type="datetime" placeholder="创建时间" disabled value="{{ $adminer->created_at }}" class="form-control">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label">更新时间：</label>

                      <div class="col-sm-8">
                          <input type="datetime" placeholder="创建时间" disabled value="{{ $adminer->updated_at }}" class="form-control">
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
