<div id="slider" class="mui-slider" style="background-color: #FFFFFF;">
  <div class="mui-slider-group mui-slider-loop">
    <!-- 额外增加的一个节点(循环轮播：第一个节点是最后一张轮播) -->
    <div class="mui-slider-item mui-slider-item-duplicate">
      <img src="http://placehold.it/400x300">
    </div>
    <!-- 第一张 -->
    <div class="mui-slider-item">
      <img src="{{ $couponInfo->image }}">
    </div>
    <!-- 第二张 -->
    <div class="mui-slider-item">
      <img src="http://placehold.it/400x300">
    </div>
    <!-- 第三张 -->
    <div class="mui-slider-item">
      <img src="http://placehold.it/400x300">
    </div>
    <!-- 第四张 -->
    <div class="mui-slider-item">
      <img src="http://placehold.it/400x300">
    </div>
    <!-- 额外增加的一个节点(循环轮播：最后一个节点是第一张轮播) -->
    <div class="mui-slider-item mui-slider-item-duplicate">
      <img src="http://placehold.it/400x300">
    </div>
  </div>
  <div class="mui-slider-indicator">
    <div class="mui-indicator mui-active"></div>
    <div class="mui-indicator"></div>
    <div class="mui-indicator"></div>
    <div class="mui-indicator"></div>
  </div>
</div>
