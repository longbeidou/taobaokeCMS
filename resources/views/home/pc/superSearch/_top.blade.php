<div class="row search-form" style="position: fixed; z-index: 100; width: 100%; padding-top: 15px; padding-bottom: 15px;">
  <div class="col-sm-1" style="padding-left: 0px; padding-right: 0px;">
    <a href="/" target="_blank">
      <img src="http://52010000.net/home/style/img/logolist.png" alt="">
    </a>
  </div>
  <div class="col-sm-7">
    <?php
      // 超级搜索
      if ($currentUrl == route('home.superSearch.resultPC')) {
        $superSelected = 'selected';
        $innerSelected = '';
        $onclick = 'submitChoice(2)';
      }
      // 站内搜索
      if ($currentUrl == route('home.coupon.search')) {
        $superSelected = '';
        $innerSelected = 'selected';
        $onclick = 'submitChoice(1)';
      }
    ?>
    <form id="superSearchForm" action="" method="get">
      <div class="col-sm-2 select">
        <select class="form-control searchSelect" onchange="changeSubmit()" name="">
          <option {{ $superSelected }} value="super" title="搜索 淘宝服务器 中的优惠券信息">超级搜索</option>
          <option {{ $innerSelected }} value="inner" title="搜索 本网站服务器 中的优惠券信息">站内搜索</option>
        </select>
      </div>
      <div class="col-sm-8" style="padding-left: 0px; padding-right: 0px;">
        <input class="form-control" type="text" name="search" value="{{ $oldRequest['search'] }}">
      </div>
      <div class="col-sm-2" style="padding-left: 0px; padding-right: 0px;">
        <button onclick="{{ $onclick }}" class="form-control local submit-button" type="submit">搜索</button>
      </div>
      <!-- <div class="col-sm-2" style="padding-left: 0px; padding-right: 0px;">
        <button onclick="submitChoice(2)" class="form-control local" type="submit">超级搜索</button>
      </div> -->
      <!-- <div class="col-sm-2" style="padding-left: 0px; padding-right: 0px;">
        <button onclick="submitChoice(1)" class="form-control taobao" type="submit" style="background-color: #fef490; color: #ed2a7a;">站内搜索</button>
      </div> -->
    </form>
  </div>
  <div class="col-sm-4 text-right contact">
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
