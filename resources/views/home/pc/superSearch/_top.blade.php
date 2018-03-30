<div class="row search-form" style="position: fixed; z-index: 100; width: 100%; padding-top: 15px; padding-bottom: 15px;">
  <div class="col-sm-1" style="padding-left: 0px; padding-right: 0px;">
    <a href="/" target="_blank">
      <img src="http://52010000.net/home/style/img/logolist.png" alt="">
    </a>
  </div>
  <div class="col-sm-6">
    <form action="{{ route('home.coupon.search') }}" method="get">
      <div class="col-sm-10" style="padding-left: 0px; padding-right: 0px;">
        <input class="form-control" type="text" name="search" value="{{ $oldRequest['search'] }}">
      </div>
      <div class="col-sm-2" style="padding-left: 0px; padding-right: 0px;">
        <button class="form-control" type="submit">提交</button>
      </div>
    </form>
  </div>
  <div class="col-sm-5 text-right contact">
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
          <img src="{{ route('image.QrCode.index') }}?info={{ $currentUrl }}?search={{ urlencode($oldRequest['search']) }}&size=203" alt="">
        </div>
      </li>
    </ul>
  </div>
</div>
