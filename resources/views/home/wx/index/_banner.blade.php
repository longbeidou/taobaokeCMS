<div id="slider" class="mui-slider" >
  <div class="mui-slider-group mui-slider-loop">
    <!-- 额外增加的一个节点(循环轮播：第一个节点是最后一张轮播) -->
    @if($banners->count())
    <div class="mui-slider-item mui-slider-item-duplicate">
      <a class="a-can-do" href="{{ $banners->last()->link }}">
        <img src="{{ $banners->last()->image }}">
      </a>
    </div>
    @endif
    @foreach($banners as $banner)
    <div class="mui-slider-item">
      <a class="a-can-do" href="{{ $banner->link }}">
        <img src="{{ $banner->image }}">
      </a>
    </div>
    @endforeach
    <!-- 额外增加的一个节点(循环轮播：最后一个节点是第一张轮播) -->
    @if($banners->count())
    <div class="mui-slider-item mui-slider-item-duplicate">
      <a class="a-can-do" href="{{ $banners[0]->link }}">
        <img src="{{ $banners[0]->image }}">
      </a>
    </div>
    @endif
  </div>
  <div class="mui-slider-indicator">
    @foreach($banners as $key => $banner)
      @if($key == 0)
      <div class="mui-indicator mui-active"></div>
      @else
      <div class="mui-indicator"></div>
      @endif
    @endforeach
  </div>
</div>
<div style="width: 100%; height: 0px;"></div>
