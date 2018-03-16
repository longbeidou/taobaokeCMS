@inject('image', 'App\Presenters\ImageSrcShowFrom')
<div id="slider" class="mui-slider" style="background-color: #FFFFFF;">
  <div class="mui-slider-group mui-slider-loop">
    <!-- 额外增加的一个节点(循环轮播：第一个节点是最后一张轮播) -->
    <div class="mui-slider-item mui-slider-item-duplicate">
      @if (empty($smallImages))
      <img src="{{ $image->imageSrc($couponInfo, $show_from) }}">
      @else
      <img src="{{ $image->imageSmallSrc(end($smallImages), $show_from) }}">
      @endif
    </div>
    <!-- 第一张 -->
    <div class="mui-slider-item">
      <img src="{{ $image->imageSrc($couponInfo, $show_from) }}">
    </div>
    @foreach($smallImages as $smallImage)
    <div class="mui-slider-item">
      <img src="{{ $image->imageSmallSrc($smallImage, $show_from) }}">
    </div>
    @endforeach
    <!-- 额外增加的一个节点(循环轮播：最后一个节点是第一张轮播) -->
    <div class="mui-slider-item mui-slider-item-duplicate">
      <img src="{{ $image->imageSrc($couponInfo, $show_from) }}">
    </div>
  </div>
  <div class="mui-slider-indicator">
    <div class="mui-indicator mui-active"></div>
    @foreach($smallImages as $smallImage)
    <div class="mui-indicator"></div>
    @endforeach
  </div>
</div>
<script type="text/javascript">
//获得slider插件对象
var gallery = mui('#slider');
gallery.slider({
interval:1500//自动轮播周期，若为0则不自动播放，默认为0；
});
</script>
