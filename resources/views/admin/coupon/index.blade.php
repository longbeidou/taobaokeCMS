@extends('admin.layouts.table.index')

@section('title', $title)
@section('headcss')
<style type="text/css">
    .checkboxstyle {width: 30px; height: 20px;}
</style>
@stop
@section('content')
<!-- 搜索控制面板 -->
@include('admin.coupon._search_board')

<!-- 优惠券列表 -->
<form action="" method="post" id="couponList">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>商品图</th>
                                <th>商品名</th>
                                <th>商品一级类目</th>
                                <th>优惠条件</th>
                                <th class="text-center">原价
                                  <a title="升序排列" href="{{ route('admin.coupons.index') }}?{{ $urlStr }}order=price_up&page_size={{ $oldRequest['page_size'] or '' }}"  ><i class="fa fa-caret-up   @if(!empty($order) && $order == 'price_up'  ) text-danger @endif"></i></a>
                                  <a title="降序排列" href="{{ route('admin.coupons.index') }}?{{ $urlStr }}order=price_down&page_size={{ $oldRequest['page_size'] or '' }}"><i class="fa fa-caret-down @if(!empty($order) && $order == 'price_down') text-danger @endif"></i></a>
                                </th>
                                <th class="text-center">现价
                                  <a title="升序排列" href="{{ route('admin.coupons.index') }}?{{ $urlStr }}order=price_now_up&page_size={{ $oldRequest['page_size'] or '' }}"  ><i class="fa fa-caret-up   @if(!empty($order) && $order == 'price_now_up'  ) text-danger @endif"></i></a>
                                  <a title="降序排列" href="{{ route('admin.coupons.index') }}?{{ $urlStr }}order=price_now_down&page_size={{ $oldRequest['page_size'] or '' }}"><i class="fa fa-caret-down @if(!empty($order) && $order == 'price_now_down') text-danger @endif"></i></a>
                                </th>
                                <th class="text-center">优惠比
                                  <a title="升序排列" href="{{ route('admin.coupons.index') }}?{{ $urlStr }}order=rate_sales_up&page_size={{ $oldRequest['page_size'] or '' }}"  ><i class="fa fa-caret-up   @if(!empty($order) && $order == 'rate_sales_up'  ) text-danger @endif"></i></a>
                                  <a title="降序排列" href="{{ route('admin.coupons.index') }}?{{ $urlStr }}order=rate_sales_down&page_size={{ $oldRequest['page_size'] or '' }}"><i class="fa fa-caret-down @if(!empty($order) && $order == 'rate_sales_down') text-danger @endif"></i></a>
                                </th>
                                <th class="text-center">佣金
                                  <a title="升序排列" href="{{ route('admin.coupons.index') }}?{{ $urlStr }}order=money_up&page_size={{ $oldRequest['page_size'] or '' }}"  ><i class="fa fa-caret-up   @if(!empty($order) && $order == 'money_up'  ) text-danger @endif"></i></a>
                                  <a title="降序排列" href="{{ route('admin.coupons.index') }}?{{ $urlStr }}order=money_down&page_size={{ $oldRequest['page_size'] or '' }}"><i class="fa fa-caret-down @if(!empty($order) && $order == 'money_down') text-danger @endif"></i></a>
                                </th>
                                <th class="text-center">月销量
                                  <a title="升序排列" href="{{ route('admin.coupons.index') }}?{{ $urlStr }}order=sales_up&page_size={{ $oldRequest['page_size'] or '' }}"  ><i class="fa fa-caret-up   @if(!empty($order) && $order == 'sales_up'  ) text-danger @endif"></i></a>
                                  <a title="降序排列" href="{{ route('admin.coupons.index') }}?{{ $urlStr }}order=sales_down&page_size={{ $oldRequest['page_size'] or '' }}"><i class="fa fa-caret-down @if(!empty($order) && $order == 'sales_down') text-danger @endif"></i></a>
                                </th>
                                <th class="text-center">平台</th>
                                <th class="text-center">操作</th>
                            </tr>
                        </thead>
                        <tbody id="chk">
                            @include('admin.coupon._coupons_info')
                        </tbody>
                    </table>
                    @if(!count($coupons))
                    <h3>暂时没有查询到对应的商品</h3>
                    @endif
                    <table class="table table-striped">
                        <tbody>
                            <tr class="info">
                                <td>
                                <span type="" class="btn btn-xs btn-info"    onclick="chk(1)">全选  </span>
                                <span type="" class="btn btn-xs btn-primary" onclick="chk(2)">反选  </span>
                                <span type="" class="btn btn-xs btn-success" onclick="chk(3)">全不选</span>
                                <span>|</span>
                                <button type="submit" class="btn btn-xs btn-warning"    onclick="submitChoice(1)"><i class="fa fa-close text-navy" style="color:#fff;"></i> 删除选中</button>
                                <button type="submit" class="btn btn-xs btn-primary" onclick="submitChoice(2)"><i class="fa fa-hand-o-up text-navy" style="color:#fff;"></i> 推荐选中</button>
                                <button type="submit" class="btn btn-xs btn-danger" onclick="submitChoice(3)"><i class="fa fa-hand-o-down text-navy" style="color:#fff;"></i> 取消推荐</button>
                                <button type="submit" class="btn btn-xs btn-primary" onclick="submitChoice(4)"><i class="fa fa-hand-o-down text-navy" style="color:#fff;"></i> 显示选中</button>
                                <button type="submit" class="btn btn-xs btn-danger" onclick="submitChoice(5)"><i class="fa fa-hand-o-down text-navy" style="color:#fff;"></i> 取消显示</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row text-center">
                    <nav aria-label="Page navigation">
                        {!! $coupons->appends($oldRequest)->render() !!}
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
</form>


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

    // 删除选中
		if (value == 1) {
			form.action = 'https://www.52010000.cn/admin/coupon/list/delmany';
			$("#couponList").attr('action', form.action);
			form.submit();
		}
    // 推荐选中
		if (value == 2) {
			form.action = "https://www.52010000.cn/admin/coupon/list/recommendmany";
			$("#couponList").attr('action', form.action);
			form.submit();
		}
    // 取消推荐
		if (value == 3) {
			form.action = "https://www.52010000.cn/admin/coupon/list/cancelrecommendmany";
			$("#couponList").attr('action', form.action);
			form.submit();
		}
    // 显示
		if (value == 4) {
			form.action = "https://www.52010000.cn/admin/coupon/list/cancelrecommendmany";
			$("#couponList").attr('action', form.action);
			form.submit();
		}
    // 取消显示
		if (value == 5) {
			form.action = "https://www.52010000.cn/admin/coupon/list/cancelrecommendmany";
			$("#couponList").attr('action', form.action);
			form.submit();
		}
	}

</script>
@stop
