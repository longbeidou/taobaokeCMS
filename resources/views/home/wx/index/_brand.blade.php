<div class="mui-row">
  <div class="mui-col-xs-4"><hr /></div>
    <div class="mui-col-xs-4 mui-text-center">
      <span class="mui-icon mui-icon-weixin"></span>
      品牌券
    </div>
    <div class="mui-col-xs-4"><hr /></div>
</div>
<div class="mui-slider">
    <div class="mui-slider-indicator mui-segmented-control mui-segmented-control-inverted">
        <a class="mui-control-item mui-active" href="#item0">全部</a>
        @foreach($brandCategorys as $key=>$brandCategory)
        <a class="mui-control-item" href="#item{{ $key+1 }}">{{ $brandCategory->name }}</a>
        @endforeach
    </div>
    <div id="sliderProgressBar" class="mui-slider-progress-bar mui-col-xs-2"></div>
    <div class="mui-slider-group">
      @foreach($brands as $key=>$brandArr)
      <?php
        if($key == 0) {
          $active = 'mui-active';
        } else {
          $active = '';
        }
      ?>
        <div id="item{{ $key }}" class="mui-slider-item mui-control-content {{ $active }}">
          <div class="mui-slider">
            <div class="mui-slider-group">
              <!--第一个内容区容器-->
              <div class="mui-slider-item">
                <!-- 具体内容 -->
                <ul class="mui-table-view mui-grid-view">
                  @foreach($brandArr as $brand)
                    <li class="mui-table-view-cell mui-media mui-col-xs-4">
                        <a href="#?{{$brand->keywords}}">
                            <img class="mui-media-object" src="{{ $brand->image }}">
                            <div class="mui-media-body">{{ $brand->name }}</div>
                        </a>
                    </li>
                   @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
        @endforeach
    </div>
</div>
<div style="width: 100%; height: 10px;"></div>
