@extends('home.wx.layouts.index')
@section('head')
  <title>{{ $TDK['title'] }}</title>
  <meta name="keywords" content="{{ $TDK['keywords'] }}" />
  <meta name="description" content="{{ $TDK['description'] }}" />
@stop
@section('content')
<div class="mui-content">
		<!--导航-->
		<header class="mui-bar mui-bar-nav mui-bar-transparent" data-top='0' data-offset='150' data-duration='16' data-scrollby=".mui-scroll-wrapper">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title">优惠券商品详情</h1>
		    <a class="mui-badge mui-badge-warning mui-pull-right mui-text-center" style="line-height:30px; width: 36px; height: 36px;" onclick="share()">分享</a>
		</header>

        <!--商品轮播图-->
        @include('home.wx.couponInformation._coupon_image')

        <!-- 商品优惠券信息         -->
        @include('home.wx.couponInformation._couponInfo')

	    <!--猜你喜欢-->
	    <div class="mui-row"  style="margin-top: 12px;">
	    	<div class="mui-col-xs-4"><hr /></div>
	        <div class="mui-col-xs-4 mui-text-center">
	        	<span class="mui-icon mui-icon-weixin"></span>
	        	猜你喜欢
	        </div>
	        <div class="mui-col-xs-4"><hr /></div>
	    </div>
	    <div style="width: 100%; height: 5px;"></div>
	    <ul class="mui-table-view mui-grid-view">
	        @include('home.wx.couponCategory._guss_you_like')
	    </ul>

      <!--版权-->
      @include('home.wx.layouts._copy')

	    <!--底部导航-->
		  @include('home.wx.couponInformation._foot_coupon_nav')

		<!--商品详情页的底部显示导航格式控制-->
		<div style="width: 100%; height: 50px;"></div>
	</div>

	<!--遮罩层-->
	<div id="zheZhao" onclick="shareClose()" style="display: none; position: fixed; z-index: 998; top: 0px; right: 0px; left: 0px; bottom: 0px; background-color: rgba(0,0,0,.1); opacity: 1;"></div>
	<!--分享-->
	@include('home.wx.couponInformation._share')
	<!--淘口令领券-->
	@include('home.wx.couponInformation._taokouling')
	<!--客服-->
	@include('home.wx.couponInformation._kefu')
  <!-- 底部js -->
	@include('home.wx.couponInformation._js')
@stop
