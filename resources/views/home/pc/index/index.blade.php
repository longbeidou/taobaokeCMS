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
  <!-- banner部分 -->
  @include('home.pc.index._banner')
  <!-- 品牌优惠券部分 -->
  @include('home.pc.index._brand')
  <!-- 优惠券推荐部分 -->
  @include('home.pc.index._recommend')
  <!-- 优惠券分类列表 -->
  <div class="container" id="home-goods-list">
    <div class="row">
      @inject('couponInfoPre', 'App\Presenters\CouponPresenter')

      <?php $allNum = count($allCouponsCategoryToCoupons); ?>
      <?php $select = [0,1,2,3,4,5]; ?>
      @foreach($allCouponsCategoryToCoupons as $key => $info)
        @if( ($allNum % 3 == 1 && $key < $allNum-1) || ($allNum % 3 == 2 && $key < $allNum-1-1) || ($allNum % 3 == 0) )
          <?php
            $select = array_values($select);
            $num = count($select);
            $opt_key = mt_rand(0, $num-1);
            $opt = $select[$opt_key];
            unset($select[$opt_key]);
            if (empty($select)) {
              $select = [0,1,2,3,4,5];
            }
          ?>
          @switch($opt)
            @case(0)
              <!-- 只有图片的样式 开始 -->
              @include('home.pc.index._coupon_only_image')
              @break

            @case(1)
              <!-- 图片轮播的样式 开始 -->
              @include('home.pc.index._coupon_image_carousel')
              @break

            @case(2)
              <!-- 九宫格样式 开始 -->
              @include('home.pc.index._coupon_grid')
              @break

            @case(3)
              <!-- 优惠券样式 开始 -->
              @include('home.pc.index._coupon_i_coupon')
              @break

            @case(4)
              <!-- 图文列表样式 开始 -->
              @include('home.pc.index._coupon_i_list')
              @break

            @case(5)
              <!-- 田字样式 开始 -->
              @include('home.pc.index._coupon_i_tian')
              @break
          @endswitch
        @endif

        @if($key == $allNum-1-2 && ($allNum % 3 == 1 || $allNum % 3 == 2) )
          <!-- 横屏静态样式 开始 -->
          @include('home.pc.index._coupon_full_image_static')
        @endif

        @if($key == $allNum-1-1 && $allNum % 3 == 2)
          <!-- 横屏动态样式 开始 -->
          @include('home.pc.index._coupon_full_image_move')
        @endif

      @endforeach
    </div>
  </div>
  <!-- 还没逛够 -->
  <div class="container" id="home-foot-recommend">
    <div class="row title">
      <div class="col-sm-12 text-center">
        <h2 style="margin-top:0px;">—— 还没逛够 ——</h2>
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
