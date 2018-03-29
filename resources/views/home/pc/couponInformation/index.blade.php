@extends('home.pc.layouts.index')
@section('head')
  <title>{{ $TDK['title'] }}</title>
  <meta name="keywords" content="{{ $TDK['keywords'] }}" />
  <meta name="description" content="{{ $TDK['description'] }}" />
@stop

@section('content')
  <!-- 提示收藏网址 -->
  @include('home.pc.index._top_search')
  <!-- 导航 -->
  @include('home.pc.layouts._nav')
  <!-- 商品分类列表部分开始 -->
  @include('home.pc.couponInformation._couponCategory')

  <!-- 商品的详情 -->
  @include('home.pc.couponInformation._coupon_info')

  <!-- 没有优惠券的时候弹出警告框 -->
  @include('home.pc.couponInformation._no_coupon')

  <!-- 精品推荐 -->
  <div class="container" id="home-foot-recommend">
    <div class="row title">
      <div class="col-sm-12 text-center">
        <h2 style="margin-top:0px;">—— 精品推荐 ——</h2>
      </div>
    </div>
    <div class="row">
      @include('home.pc.layouts._recommend_col_3')
    </div>
  </div>
  <!-- 底部宣传语 -->
  @include('home.pc.index._foot_say')
  <!-- 网址底部 -->
  @include('home.pc.layouts._footer')
@stop
