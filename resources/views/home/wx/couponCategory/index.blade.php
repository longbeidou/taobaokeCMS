@extends('home.wx.layouts.index')
@section('head')
  <title>{{ $TDK['title'] }}</title>
  <meta name="keywords" content="{{ $TDK['keywords'] }}" />
  <meta name="description" content="{{ $TDK['description'] }}" />
@stop
@section('content')
  <!--底部选项卡-->
  @include('home.wx.layouts._foot_tab_index')

  <!-- 主界面不动、菜单移动 -->
  	<!-- 侧滑导航根容器 -->
  	<div class="mui-off-canvas-wrap mui-draggable mui-slide-in">
  	  <!-- 菜单容器 -->
      @include('home.wx.couponCategory._aside')

  	  <!-- 主页面容器 -->
  	  <div class="mui-inner-wrap">
  	    <!-- 主页面标题 -->
  	   @include('home.wx.couponCategory._header')

        <!--底部选项卡-->
        @include('home.wx.layouts._foot_tab_index')

  	    <div class="mui-content mui-scroll-wrapper">
  	       <div class="mui-scroll">
      	        <!-- 主界面具体展示内容 -->
      	        <div class="mui-row" style="padding: 10px; padding-bottom: 2px;">
      	        	<div class="mui-col-xs-4 mui-text-center">
      	        		<a href="" style="color: #000000;">综合排序<span class="mui-icon mui-icon-arrowdown"></span></a>
      	        	</div>
      	        	<div class="mui-col-xs-4 mui-text-center">
      	        		<a href="" style="color: #000000;">销量排序<span class="mui-icon mui-icon-arrowdown"></span></a>
      	        	</div>
      	        	<div class="mui-col-xs-4 mui-text-center">
      	        		<a href="" style="color: #ed2a7a;">优惠金额<span class="mui-icon mui-icon-arrowdown"></span></a>
      	        	</div>
      	        </div>
      	        <div><hr /></div>
      	        <!--商品的详细列表-->
      		    <ul class="mui-table-view mui-grid-view">
      		        @include('home.wx.couponCategory._coupon')
      		    </ul>

      		    <!--分页-->
      		    <div class="mui-row mui-text-center" style="background-color: #FFFFFF; padding-top: 5px;">
      		    	<ul class="mui-pagination">
      		    	    <li class="mui-disabled">
      		    	        <span> &laquo; </span>
      		    	    </li>
      		    	    <li class="mui-active">
      		    	        <a href="#">1</a>
      		    	    </li>
      		    	    <li>
      		    	        <a href="#">2</a>
      		    	    </li>
      		    	    <li>
      		    	        <a href="#">&raquo;</a>
      		    	    </li>
      		    	</ul>
      		    </div>

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
      		    @include('home.wx.layouts._foot_tab_index')
  	      </div>
  	    </div>
  	    <div class="mui-off-canvas-backdrop"></div>
  	  </div>
  	</div>
@stop
