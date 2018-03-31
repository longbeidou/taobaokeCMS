@extends('home.pc.layouts.index')
@section('head')
  <title>{{ $TDK['title'] }}</title>
  <meta name="keywords" content="{{ $TDK['keywords'] }}" />
  <meta name="description" content="{{ $TDK['description'] }}" />
@stop

@section('content')
<div class="container-fluid" id="search-info">
  @include('home.pc.superSearch._top')
  <!-- 导航 -->
  @include('home.pc.superSearch._nav_tab')
  <!-- 主题内容 -->
  <div class="row i-content">
    <div class="col-sm-10 col-sm-offset-1">
      <div class="row">
        <!-- 显示搜索的总结果数量 -->
        <div class="col-sm-12" style="padding: 15px 5px 15px 0px; margin-left: 15px;">
          <div class="" style="background-color: #fff; border-left: 3px solid #ed2a7a; padding: 1px 12px;">
            <h6 style="color: #333;"><strong style="font-size: 14px; color: #ed2a7a;">站内搜索的结果</strong> &nbsp;&nbsp;&nbsp;&nbsp;在 <strong>本网站服务器</strong> 中为您找到相关结果约 <strong>{{ $couponsCount }}</strong> 个。 如果对结果不满意，可以尝试进行 <strong title="搜索淘宝服务器中的优惠券信息" style="color: #ed2a7a;">超级搜索</strong>。</h6>
          </div>
        </div>
        @inject('couponInfoPre', 'App\Presenters\CouponPresenter')
        <!-- 搜索的结果显示页面 -->
        @include('home.pc.superSearch._local_content')
        <!-- 商品的推荐页面 -->
        <div class="col-sm-4 i-recommend">
          <div class="row">
            <div class="col-sm-12" style="padding-left: 20px; padding-right: 20px;">
              <div class="row" style="background-color: #fff; margin-bottom: 5px; border-left: 5px solid #ed2a7a;">
                <div class="col-sm-12">
                  <h5>猜你喜欢</h5>
                </div>
              </div>
            </div>
            @include('home.pc.superSearch._local_recommend')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- 底部宣传语 -->
@include('home.pc.index._foot_say')
<!-- 网址底部 -->
@include('home.pc.layouts._footer')
<!-- 采用lazyload加载图片 -->
@include('home.pc.layouts._lazyload_js')
<!-- 确定超级搜索提交地址的js -->
@include('home.pc.layouts._submit_choice_js')
@stop
