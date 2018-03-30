<header class="container-fluid" id="search-top" style="z-index: 10000;">
  <div class="col-sm-8 text-left i-category">
    <ul class="list-inline">
      <li><a href="/" target="_blank">首页</a></li>
      @foreach($categorys as $key => $category)
        @if($key < 8)
        <li><a href="{{ $category['link'] }}" target="_blank">{{ $category['name'] }}</a></li>
        @elseif($key == 8)
        <li class="i-more">
          更多 <i class="iconfont icon-msnui-triangle-down" style="font-size: 2px;"></i>
          <ul class="list-unstyled i-more-category">
            <li><a href="{{ $category['link'] }}" target="_blank">{{ $category['name'] }}</a></li>
        @else
        <li><a href="{{ $category['link'] }}" target="_blank">{{ $category['name'] }}</a></li>
        @endif
        @if($key == count($categorys)-1 && $key >= 8)
          </ul>
        </li>
        @endif
      @endforeach
    </ul>
  </div>
  <div class="col-sm-4 text-right i-other">
    <ul class="list-inline">
      <li>微信公众号 <i class="iconfont icon-msnui-triangle-down" style="font-size: 2px;"></i>
        <div class="img">
          <img src="/img/about/qcode_public_239_239.png" alt="">
        </div>
      </li>
      <li>微信客服 <i class="iconfont icon-msnui-triangle-down" style="font-size: 2px;"></i>
        <div class="img">
          <img src="/img/about/qcode_person_239_239.png" alt="">
        </div>
      </li>
      <li>手机访问 <i class="iconfont icon-msnui-triangle-down" style="font-size: 2px;"></i>
        <div class="img">
          <img src="{{ route('image.QrCode.index') }}?info={{ $currentUrl }}&size=203" alt="">
        </div>
      </li>
    </ul>
  </div>
</header>
