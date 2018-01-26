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
              <h5>编辑管理员密码</h5>
          </div>
          <div class="ibox-content" style="display: block;">
              <form name="form" class="form-horizontal" method="post" action="{{ route('adminers.update.passwordaction', $adminer->id) }}" target="_self">
                  <div class="form-group">
                      <label class="col-sm-3 control-label">原始密码：</label>

                      <div class="col-sm-8">
                          <input type="password" name="password" placeholder="请输入原始密码" required  value="" class="form-control">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label">新密码：</label>

                      <div class="col-sm-8">
                          <input type="password" name="password_new" placeholder="请输入新密码" required  value="" class="form-control">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label">确认密码：</label>

                      <div class="col-sm-8">
                          <input type="password" name="password_re" onchange="checkpassword()" placeholder="请再次输入新密码" required  value="" class="form-control">
                          <span class="help-block m-b-none" id="msg"></span>
                      </div>
                  </div>
                  {{ csrf_field() }}
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
<script type="text/javascript">
   function checkpassword()
   {
     var password_new = document.form.password_new.value;
     var password_re = document.form.password_re.value;
     if (password_new != password_re) {
       document.getElementById('msg').innerHTML = '两次输入的密码不一致，请重新输入！';
       return false;
     } else {
       document.getElementById('msg').innerHTML = '';
       return true;
     }
   }
</script>
@stop
@section('footJs')

@stop
