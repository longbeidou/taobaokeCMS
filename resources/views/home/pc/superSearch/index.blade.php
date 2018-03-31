@extends('home.pc.layouts.index')
@section('head')
  <title>{{ $TDK['title'] }}</title>
  <meta name="keywords" content="{{ $TDK['keywords'] }}" />
  <meta name="description" content="{{ $TDK['description'] }}" />
@stop

@section('content')
  <!-- 头部 -->
  @include('home.pc.superSearch._header')

  <div class="container" id="search-content">
    <div class="row i-title">
      <div class="col-sm-12 text-center">
        <span><img src="http://52010000.net/home/style/img/logo.png" /></span>
        <span><h1>淘宝天猫优惠券查询</h1></span>
      </div>
    </div>
    <div class="row i-form">
      <div class="col-sm-6 col-sm-offset-3 search-box">
        <ul id="myTabs" class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#search-inner" id="search-inner-tab" role="tab" data-toggle="tab" aria-controls="search-inner" aria-expanded="true">站内搜索</a></li>
          <li role="presentation" class=""><a href="#search-all" role="tab" id="search-all-tab" data-toggle="tab" aria-controls="search-all" aria-expanded="false">超级搜索</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
          <!-- 站内搜索 -->
          <div role="tabpanel" class="tab-pane fade active in" id="search-inner" aria-labelledby="search-inner-tab">
            <div class="row" style="padding-top: 15px;">
              <form action="{{ route('home.coupon.search') }}" method="get">
                <div class="col-sm-10">
                  <input class="form-control" type="text" name="search" placeholder="请输入要搜索的商品关键词，多条件用空格隔开" value="">
                </div>
                <div class="col-sm-2">
                  <button type="submit" class="form-control">搜索</button>
                </div>
              </form>
            </div>
            <div class="row" style="padding-left: 15px;">
              <p style="margin-bottom: 0px; margin-top: 15px; color: #777;">提示：搜索范围为 <strong>本站服务器</strong> 的优惠券商品</p>
            </div>
            <div class="row recommend-word" style="padding: 15px 15px 0px;;">
              <ul class="list-inline" style="margin-bottom: 0px;">
                <li><strong>热门搜索:</strong></li>
                @include('home.pc.layouts._search_keywords')
              </ul>
            </div>
            <div class="row desc" style="padding: 15px;">
              <div class="col-sm-12 text-left" style="background-color: #fff; border: 1px solid #e6e6e6;">
                <h5><strong>站内搜索使用说明</strong></h5>
                <p>多个关键词有空格隔开，例如：T恤 白色<br />优惠券的有效期一般比较短，请及时查询，即时使用。</p>
              </div>
            </div>
          </div>
          <!-- 全站搜索开始 -->
          <div role="tabpanel" class="tab-pane fade" id="search-all" aria-labelledby="search-all-tab">
            <div class="row" style="padding-top: 15px;">
              <form action="{{ route('home.coupon.search') }}" method="get">
                <div class="col-sm-10">
                  <input class="form-control" type="text" name="search" placeholder="请输入要搜索的商品名称或者淘宝口令" value="">
                </div>
                <div class="col-sm-2">
                  <button type="submit" class="form-control">搜索</button>
                </div>
              </form>
            </div>
            <div class="row" style="padding-left: 15px;">
              <p style="margin-bottom: 0px; margin-top: 15px; color: #777;">提示：搜索范围为 <strong>淘宝服务器</strong> 的优惠券信息</p>
            </div>
            <div class="row desc" style="padding: 15px;">
              <div class="col-sm-12 text-left" style="background-color: #fff; border: 1px solid #e6e6e6;">
                <h5><strong>超级搜索使用说明</strong></h5>
                <p>
                  多个关键词有空格隔开，例如：T恤 白色；<br />
                  优惠券的有效期一般比较短，请及时查询，即时使用；<br />
                </p>
                <p>
                  粘贴含有优惠口令的文字可以搜索特定商品，含优惠口令的文字：“复制这条信息，￥dDLw0qBQoiS￥ ，打开【手机淘宝】即可查看”；
                </p>
                <p>
                  什么是优惠口令？<br />
                  以“￥”开头和结尾的字符串，例如：￥dDLw0qBQoiS￥
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- 网站底部 -->
  @include('home.pc.superSearch._footer_fixed')
@stop
