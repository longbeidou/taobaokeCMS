<div class="mui-row">
  <div class="mui-col-xs-4"><hr /></div>
    <div class="mui-col-xs-4 mui-text-center">
      <span class="icon iconfont icon-shangpinfenlei1" style="font-size: 21px; color: #ed2a7a;"></span>
      商品分类
    </div>
    <div class="mui-col-xs-4"><hr /></div>
</div>
<div class="mui-row">
  <div id="coupon-category-index" class="mui-slider" style="margin:5px 0px 8px;">
    <div class="mui-slider-group">
      <!-- 分类内容开始 -->
      <div class="mui-slider-item">
        <ul class="mui-table-view mui-grid-view mui-grid-9">
      <?php
          $count = count($couponCategorys);
          $max = 12 - ($count % 12);
      ?>
      @foreach($couponCategorys as $key=>$couponCategory)
            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3" style="padding: 0px;">
              <a class="a-can-do" href="{{ route('home.coupon', $couponCategory->id) }}">
                <!-- <span class="mui-icon mui-icon-home"></span> -->
                {!! $couponCategory->font_icon !!}
                <div class="mui-media-body" style="font-size:12px;">{{ $couponCategory->category_name }}</div>
              </a>
            </li>
        @if ($key % 12 == 11 && $count != $key+1)
          </ul>
        </div>
        <div class="mui-slider-item">
          <ul class="mui-table-view mui-grid-view mui-grid-9">
        @endif
      @endforeach
      @for($i = 1; $i <= $max; $i ++)
        <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3" style="padding: 0px;">
          <div style="height:83px;"></div>
        </li>
      @endfor
      <?php
        unset($count);
        unset($max);
       ?>
          </ul>
        </div>
      <!-- 分类内容结束 -->
    </div>
    <div class="mui-slider-indicator">
      @foreach($couponCategorys as $key=>$couponCategory)
        @if($key == 0)
        <div class="mui-indicator mui-active"></div>
        @endif
        @if($key % 12 == 1 && $key > 11)
        <div class="mui-indicator"></div>
        @endif
      @endforeach
    </div>
  </div>
</div>
<script type="text/javascript">
    mui.ready(function() {
        var slider = document.getElementById('coupon-category-index');
        var group = slider.querySelector('.mui-slider-group');
        var items = mui('.mui-slider-item', group);
        //克隆第一个节点
        var first = items[0].cloneNode(true);
        first.classList.add('mui-slider-item-duplicate');
        //克隆最后一个节点
        var last = items[items.length - 1].cloneNode(true);
        last.classList.add('mui-slider-item-duplicate');
        //处理是否循环逻辑，若支持循环，需支持两点：
        //1、在.mui-slider-group节点上增加.mui-slider-loop类
        //2、重复增加2个循环节点，图片顺序变为：N、1、2...N、1
        var sliderApi = mui(slider).slider();

        function toggleLoop(loop) {
            if (loop) {
              group.classList.add('mui-slider-loop');
              group.insertBefore(last, group.firstChild);
              group.appendChild(first);
              sliderApi.refresh();
              sliderApi.gotoItem(0);
            } else {
              group.classList.remove('mui-slider-loop');
              group.removeChild(first);
              group.removeChild(last);
              sliderApi.refresh();
              sliderApi.gotoItem(0);
            }
          }
        toggleLoop(true);
    });
</script>
