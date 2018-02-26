@extends('home.wx.layouts.index')
@section('head')
  <title>通过浏览器打开获取优惠券</title>
@stop
@section('content')
<div class="mui-content">
    <div class="mui-row">
      <div class="mui-col-xs-12">
        <img src="/coupon/img/wechat.jpg" width="100%" alt="">
      </div>
    </div>
    <!--版权-->
    @include('home.wx.layouts._copy')
</div>
@stop
