<aside class="mui-off-canvas-left" id="offCanvasSide">
  <div class="mui-scroll-wrapper">
    <div class="mui-scroll" style="padding: 10px;">
      <!-- 菜单具体展示内容 -->
      <div class="mui-row">
        <!--商品分类-->
        <div class="mui-col-xs-12">
          <span class="nav-title" >
            <i class="icon iconfont icon-shangpin1" style="font-size: 24px;"></i>
            商品分类
          </span>
        </div>
        <div class="mui-col-xs-4" style="padding: 2px;">
          <a href="{{ route('home.coupon') }}" class="mui-btn a-can-do" style="width: 100%;">全部商品</a>
        </div>
        @foreach($couponCategorys as $couponCategory)
        <div class="mui-col-xs-4" style="padding: 2px;">
          <a href="{{ route('home.coupon', $couponCategory->id) }}" class="mui-btn a-can-do" style="width: 100%;">{{ $couponCategory->category_name }}</a>
        </div>
        @endforeach
      </div>
      <div style="width:100%; height: 25px; padding-top: 5px;"><hr style="border: 1px dotted #ed2a7a;" /></div>
      <!--导航-->
      <div class="mui-row">
        <div class="mui-col-xs-12">
          <span class="nav-title" >
            <i class="icon iconfont icon-daohang" style="font-size: 24px;"></i>
            导航
          </span>
        </div>
        @foreach($categorys as $category)
        <div class="mui-col-xs-4" style="padding: 2px;">
          <a href="{{ $category['link'] }}" class="mui-btn a-can-do" style="width: 100%;">{{ $category['name'] }}</a>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</aside>
