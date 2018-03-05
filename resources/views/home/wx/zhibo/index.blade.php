@extends('home.wx.layouts.index')
@section('head')
  <title>{{ $TDK['title'] }}</title>
  <meta name="keywords" content="{{ $TDK['keywords'] }}" />
  <meta name="description" content="{{ $TDK['description'] }}" />
@stop
@section('content')
  <!--底部搜索-->
  @include('home.wx.layouts._foot_tab_index')

  @include('home.wx.zhibo._header')

  <!-- 主界面不动、菜单移动 -->
  	<!-- 侧滑导航根容器 -->
  	<div id="content" class="mui-content">
      @include('home.wx.zhibo._content')
    </div>
    @include('home.wx.zhibo._zhiBoContent')
@stop
