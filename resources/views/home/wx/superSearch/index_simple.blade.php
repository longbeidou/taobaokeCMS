@extends('home.wx.layouts.index')
@section('head')
  <title>{{ $TDK['title'] }}</title>
  <meta name="keywords" content="{{ $TDK['keywords'] }}" />
  <meta name="description" content="{{ $TDK['description'] }}" />
@stop
@section('content')
  <!--底部搜索-->
  @include('home.wx.superSearch._foot_search')

  <!-- 顶部 -->
  <div class="mui-row" >
    <div class="col-xs-12" style="height:44px;"></div>
  </div>
  @include('home.wx.superSearch._header_simple')

  <!-- 主界面不动、菜单移动 -->
  	<!-- 侧滑导航根容器 -->
  	<div class="mui-off-canvas-wrap mui-draggable mui-slide-in">
      @if (count($errors) > 0)
        @include('home.wx.superSearch._errors')
      @endif

      @if(empty($has_search))
    	  <!-- 超级搜索说明 -->
        @include('home.wx.superSearch._info')
      @endif

      <!-- 搜索的结果 -->
      @if(!empty($has_search))
        @include('home.wx.superSearch._result')
      @endif

      <!--猜你喜欢-->
      <div class="mui-row"  style="margin-top: 12px;">
        <div class="mui-col-xs-4"><hr /></div>
          <div class="mui-col-xs-4 mui-text-center">
            <span class="icon iconfont icon-wei-" style="font-size: 20px; color: #ed2a7a;"></span>
            猜你喜欢
          </div>
          <div class="mui-col-xs-4"><hr /></div>
      </div>
      <div style="width: 100%; height: 5px;"></div>
      <ul class="mui-table-view mui-grid-view">
          @include('home.wx.couponCategory._guss_you_like_block')
      </ul>

      <!--版权-->
      @include('home.wx.layouts._copy')
  	</div>
    <div class="mui-row" >
      <div class="col-xs-12" style="height:80px;"></div>
    </div>
@stop
