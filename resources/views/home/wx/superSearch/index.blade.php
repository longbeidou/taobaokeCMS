@extends('home.wx.layouts.index')
@section('head')
  <title>{{ $TDK['title'] }}</title>
  <meta name="keywords" content="{{ $TDK['keywords'] }}" />
  <meta name="description" content="{{ $TDK['description'] }}" />
@stop
@section('content')
  <!-- 主界面不动、菜单移动 -->
  	<!-- 侧滑导航根容器 -->
  	<div class="mui-off-canvas-wrap mui-draggable mui-slide-in">
  	  <!-- 菜单容器 -->
      @include('home.wx.couponCategory._aside')

  	  <!-- 主页面容器 -->
  	  <div class="mui-inner-wrap">
  	    <!-- 主页面标题 -->
  	   @include('home.wx.superSearch._header')

       <!--底部搜索-->
       @include('home.wx.superSearch._foot_search')

  	    <div class="mui-content mui-scroll-wrapper">
  	       <div class="mui-scroll" id="brand-tab-list">

             <div class="mui-segmented-control" style="background-color: #fff;" id="superSearchTab">
         		    <a data="super" class="mui-control-item mui-active" href="#item1">超级搜索</a>
         		    <a data="inner" class="mui-control-item" href="#item2">站内搜索</a>
             </div>
             <!-- <div id="sliderProgressBar" class="mui-slider-progress-bar mui-col-xs-6"></div> -->
             <div class="mui-row">
                 <div class="mui-slider-group">
                    <div id="item1" class="mui-slider-item mui-control-content mui-active">

                      <!-- 搜索的结果 -->
                      @if(!empty($has_search))
                        @include('home.wx.superSearch._result_list')
                      @endif

                      @if (empty($has_search))
                      <div class="mui-row">
                        <div class="mui-col-xs-12">
                          <img src="/img/supersearch/search_surper_bg.png" width="100%" alt="">
                        </div>
                      </div>
                      @endif

                      @if (count($errors) > 0)
                        @include('home.wx.superSearch._errors')
                      @endif

                      @if(empty($has_search))
                       <!-- 超级搜索说明 -->
                        @include('home.wx.superSearch._info')
                      @endif
                   	</div>
                    <div id="item2" class="mui-slider-item mui-control-content">
                        @include('home.wx.superSearch._search_inner')
                    </div>
                 </div>
             </div>

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
             <div class="mui-row" id="footSpace">
               <div class="col-xs-12" style="height:80px;"></div>
             </div>

  	      </div>
  	    </div>
  	    <div class="mui-off-canvas-backdrop"></div>
  	  </div>
  	</div>

    <script type="text/javascript">
        mui('#superSearchTab').on('tap', 'a', function(){
          data = this.getAttribute("data");
          if (data == 'inner') {
            document.getElementById('superSearchForm').classList.add('self-display-none');
            document.getElementById('footSpace').classList.add('self-display-none');
            document.getElementById('superSearchForm').classList.remove('self-display-block');
            document.getElementById('footSpace').classList.remove('self-display-block');
          } else {
            document.getElementById('superSearchForm').classList.add('self-display-block');
            document.getElementById('footSpace').classList.add('self-display-block');
            document.getElementById('superSearchForm').classList.remove('self-display-none');
            document.getElementById('footSpace').classList.remove('self-display-none');
          }
        });
    </script>
@stop
