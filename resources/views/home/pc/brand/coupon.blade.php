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
  @include('home.pc.brand._brand_category_list')
  <!-- include('home.pc.brand._brand_category') -->

  <!-- 商品的排序 开始 -->
  <div class="container" id="category-order">
    <ul class="list-inline">
      @include('home.pc.couponCategory._order')
    </ul>
  </div>
  <!-- 商品的排序 结束 -->

  <!-- 商品优惠券列表 开始 -->
  <div class="container" id="category-goods-list">
    <div class="row">
      @include('home.pc.couponCategory._content')
    </div>
    <div class="row text-center">
      {!! $coupons->appends($oldRequest)->render() !!}
    </div>
  </div>
  <!-- 商品优惠券列表 结束 -->

  <!-- 还没逛够 开始 -->
  <div class="container" id="home-foot-recommend">
    <div class="row title">
      <div class="col-sm-12 text-center">
        <h2 style="margin-top:0px;">—— 精品推荐 ——</h2>
      </div>
    </div>
    <div class="row">
      @include('home.pc.layouts._recommend_col_2')
    </div>
  </div>
  <!-- 还没逛够 结束 -->

  <!-- 底部宣传语 -->
  @include('home.pc.index._foot_say')
  <!-- 网址底部 -->
  @include('home.pc.layouts._footer')
  <!-- 采用lazyload加载图片 -->
  @include('home.pc.layouts._lazyload_js')
@stop
