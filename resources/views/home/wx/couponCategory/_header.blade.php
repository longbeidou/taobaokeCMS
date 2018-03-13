<header class="mui-bar mui-bar-nav">
  <div class="mui-row">
    <div class="mui-col-xs-1">
      <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
    </div>
    <div class="mui-col-xs-10">
      @if(!empty($brand->id))
      <h1 class="mui-title">{{ $brand->name }}</h1>
      @elseif(!empty($couponCategory->category_name))
      <h1 class="mui-title">{{ $couponCategory->category_name }}</h1>
      @elseif(!empty($oldRequest['search']))
          <div class="mui-row" style="color:#fff;" id="search-coupon-category">
            @include('home.wx.layouts._search_input')
          </div>
      @else
      <h1 class="mui-title">全部商品</h1>
      @endif
      <!-- @  include('home.wx.layouts._search_input') -->
    </div>
    <div class="mui-col-xs-1">
      <a class="mui-icon mui-action-menu mui-icon-bars mui-pull-right" href="#offCanvasSide"></a>
    </div>
  </div>
</header>
