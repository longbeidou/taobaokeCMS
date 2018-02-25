<div id="slider" class="mui-slider" style="background-color: #FFFFFF;">
  <div class="mui-slider-group mui-slider-loop">
    <!-- 额外增加的一个节点(循环轮播：第一个节点是最后一张轮播) -->
    <div class="mui-slider-item mui-slider-item-duplicate">
      @if (empty($smallImages))
      <img src="{{ $couponInfo->image }}">
      @else
      <img src="{{ route('image.index', end($smallImages)) }}">
      @endif
    </div>
    <!-- 第一张 -->
    <div class="mui-slider-item">
      <img src="{{ route('image.index', $couponInfo->image_encrypt) }}">
    </div>
    @foreach($smallImages as $smallImage)
    <div class="mui-slider-item">
      <img src="{{ route('image.index', $smallImage) }}">
    </div>
    @endforeach
    <!-- 额外增加的一个节点(循环轮播：最后一个节点是第一张轮播) -->
    <div class="mui-slider-item mui-slider-item-duplicate">
      <img src="{{ route('image.index', $couponInfo->image_encrypt) }}">
    </div>
  </div>
  <div class="mui-slider-indicator">
    <div class="mui-indicator mui-active"></div>
    @foreach($smallImages as $smallImage)
    <div class="mui-indicator"></div>
    @endforeach
  </div>
</div>
