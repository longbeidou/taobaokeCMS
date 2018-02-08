@extends('admin.layouts.table.index')

@section('title', $title)
@section('headcss')

@stop
@section('content')

  @include('admin.layouts.table._tips')
<div class="row">
  <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>banner列表</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <ul class="list-inline">
                  <li><a class="btn @if(empty($oldRequst['flat'])) btn-danger @else btn-info @endif" href="{{ route('banners.index') }}">全部</a></li>
                  <li><a class="btn @if($oldRequst != [] && !empty($oldRequst['flat']) && $oldRequst['flat'] == 'pc') btn-danger @else btn-info @endif"  href="{{ route('banners.index') }}?flat=pc">PC端</a></li>
                  <li><a class="btn @if($oldRequst != [] && !empty($oldRequst['flat']) && $oldRequst['flat'] == 'wx') btn-danger @else btn-info @endif"  href="{{ route('banners.index')}}?flat=wx">移动端</a></li>
                </ul>
            </div>
        </div>
  </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>品牌列表</h5>
            </div>
            <form action="" method="post" id="couponList">
            	{{ csrf_field() }}
              <div class="ibox-content" style="display: block;">
                  <div class="table-responsive">
                      <table class="table table-striped table-hover table-condensed">
                          <thead>
                              <tr>
                                  <th></th>
                                  <th>排序</th>
                                  <th style="min-width:75px;">banner简介</th>
                                  <th class="text-center">网址链接</th>
                                  <th class="text-center">图片</th>
                                  <th class="text-center">展示位置</th>
                                  <th class="text-center">显示状态</th>
                                  <th class="text-center">操作</th>
                              </tr>
                          </thead>
                          <tbody id="chk">
                              @include('admin.banner._banner_info')
                          </tbody>
                      </table>
                      <table class="table table-striped">
                      	<tbody>
                      		<tr class="info">
                      			<td>
                      				<span type="" class="btn btn-xs btn-info"    onclick="chk(1)">全选  </span>
                      				<span type="" class="btn btn-xs btn-primary" onclick="chk(2)">反选  </span>
                      				<span type="" class="btn btn-xs btn-success" onclick="chk(3)">全不选</span>
                      				<span>|</span>
                      				<button type="submit" class="btn btn-xs btn-info"    onclick="submitChoice(1)"><i class="fa fa-close text-navy" style="color:#fff;"></i> 删除选中</button>
                      				<button type="submit" class="btn btn-xs btn-primary" onclick="submitChoice(2)"><i class="fa fa-hand-o-up text-navy" style="color:#fff;"></i> 修改排序</button>
                      			</td>
                      		</tr>
                      	</tbody>
                      </table>
                  </div>
              </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('footJs')
<!-- 实现全选、反选、全不选 -->
<script type="text/javascript">
  function chk(value) {
    var chktotal = $("#chk");

    if (value == 1) { //全选
      $("input:checkbox").each(function () {
      this.checked = true;
      })
    }
    if (value == 2) { //反选
          $("input:checkbox").each(function () {
            this.checked = !this.checked;
         })
    }
    if (value == 3) { //全不选
      $("input:checkbox").removeAttr("checked");
    }
  }

</script>
<!-- 确定提交地址的js -->
<script type="text/javascript">
  function submitChoice(value) {
    var form = $("#couponList");

    if (value == 1) {
      form.action = '{{ route('banners.deleteMany') }}';
      $("#couponList").attr('action', form.action);
      form.submit();
    }
    if (value == 2) {
      form.action = "{{route('banners.changeOrder')}}";
      $("#couponList").attr('action', form.action);
      form.submit();
    }
  }

</script>
@stop
