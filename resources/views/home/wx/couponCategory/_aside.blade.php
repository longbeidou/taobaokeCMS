<aside class="mui-off-canvas-left" id="offCanvasSide">
  <div class="mui-scroll-wrapper">
    <div class="mui-scroll" style="padding: 10px;">
      <!-- 菜单具体展示内容 -->

      <!-- 搜索框 -->
      <div class="mui-row" style="color:#fff;" id="aside-search">
        @include('home.wx.layouts._search_input')
      </div>

      <!--商品分类-->
      <div class="mui-row">
        <div class="mui-col-xs-12">
          <span class="nav-title" >
            <i class="icon iconfont icon-shangpinfenlei2" style="font-size: 14px;"></i>
            商品分类
          </span>
        </div>
      </div>
        <!-- btn按钮样式 开始 -->
        <!-- <div class="mui-col-xs-4" style="padding: 2px;">
          <a href="#" class="mui-btn a-can-do" style="width: 100%; padding: 4px;">全部商品</a>
        </div>
        <div class="mui-col-xs-4" style="padding: 2px;">
          <a href="#" class="mui-btn a-can-do" style="width: 100%; padding: 4px;">###</a>
        </div> -->
        <!-- btn按钮样式 结束 -->
      <div class="mui-row aside-nav-box">
        <div class="mui-col-xs-4 aside-nav-cell">
          <a href="{{ route('home.coupon') }}" class="a-can-do">
            <div class="mui-row" style="text-align:center;">
              <div class="mui-col-xs-12" style="font-size: 20px;">
                <span class="category-font-icon iconfont icon-shangpin1"></span>
              </div>
              <div class="mui-col-xs-12" style="font-size:12px; color: #000;">
                全部商品
              </div>
            </div>
          </a>
        </div>
        @foreach($couponCategorys as $couponCategory)
        <div class="mui-col-xs-4 aside-nav-cell">
          <a href="{{ route('home.coupon', $couponCategory->id) }}" class="a-can-do">
            <div class="mui-row" style="text-align:center;">
              <div class="mui-col-xs-12" style="font-size: 20px;">
                {!! $couponCategory->font_icon !!}
              </div>
              <div class="mui-col-xs-12" style="font-size:12px; color: #000;">
                {{ $couponCategory->category_name }}
              </div>
            </div>
          </a>
        </div>
        @endforeach
      </div>

      <!-- <div style="width:100%; height: 25px; padding-top: 5px;"><hr style="border: 1px dotted #ed2a7a;" /></div> -->

      <!--导航-->
      <div class="mui-row">
        <div class="mui-col-xs-12">
          @if(count($categorys) > 0)
          <span class="nav-title" >
            <i class="icon iconfont icon-daohang" style="font-size: 18px;"></i>
            导航
          </span>
          @endif
        </div>
      </div>
      <div class="mui-row aside-nav-box">
        @foreach($categorys as $category)
        <div class="mui-col-xs-4 aside-nav-cell">
          <a href="{{ $category['link'] }}" class="a-can-do">
            <div class="mui-row" style="text-align:center;">
              <div class="mui-col-xs-12" style="font-size: 20px;">
                {!! $category['font_icon'] !!}
              </div>
              <div class="mui-col-xs-12" style="font-size:12px; color: #000;">
                {{ $category['name'] }}
              </div>
            </div>
          </a>
        </div>
        @endforeach
      </div>

      <div class="mui-row">
          <div class="mui-col-xs-12">
            <div style="width:100%; height:50px;"></div>
          </div>
      </div>
    </div>
  </div>
</aside>
