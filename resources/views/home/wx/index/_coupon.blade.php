<div class="mui-row">
  <div class="mui-col-xs-4"><hr /></div>
    <div class="mui-col-xs-4 mui-text-center">
      <span class="mui-icon mui-icon-weixin"></span>
      优惠券商品
    </div>
    <div class="mui-col-xs-4"><hr /></div>
</div>
<div style="width: 100%; height: 5px;"></div>
<ul class="mui-table-view mui-grid-view">
  @foreach($coupons as $coupon)
    <li class="mui-table-view-cell mui-media mui-col-xs-6">
        <a class="a-can-do" href="{{ route('home.couponInfo', $coupon->id) }}">
            @if(!empty($from) && in_array($from,['wechat','wx']))
            <img class="mui-media-object" src="{{ route('image.index', $coupon->image_encrypt) }}">
            @else
            <img class="mui-media-object" src="{{ $coupon->image }}">
            @endif
            <span class="mui-badge mui-badge-red" style="position:absolute; right: 0px; top: 20px; background-color: #ed2a7a;">
              @if(in_array($from, ['wechat']))
                @if($coupon->flat == '淘宝')
                <img src="/img/ta.png" height="12px" alt="">
                @else
                <img src="/img/tm.png" height="12px" alt="">
                @endif
              @else
              {{ $coupon->flat }}
              @endif
            </span>
            <div class="mui-media-body" style="height: 52px;">
              <p style="white-space: normal; max-height: 30px; overflow: hidden;">{{ $coupon->goods_name }}</p>
              <p class="mui-text-left" style="margin-top: 7px;">
                <span style="font-size: 1.5em; color: #ed2a7a;">￥{{ $coupon->price_now }}</span>
                <span style="text-decoration: line-through; color: #8f8d8d;">￥{{ $coupon->price }}</span>
              </p>
            </div>
            <div class="mui-media-body mui-row" style="height: 2.2em;">
              <div class="mui-col-xs-7" style="background: #fd9b00; color: #fff; padding:5px 0;">{{ $coupon->coupon_info }}</div>
              <div class="mui-col-xs-5" style="background: #ed2a7a; color:#fff; padding:5px 0;">马上领券</div>
            </div>
        </a>
    </li>
   @endforeach
    <li class="mui-text-center mui-col-xs-12">
      <a href="{{ route('home.coupon') }}" class="mui-btn mui-btn-outlined a-can-do">查看更多淘宝优惠券</a>
    </li>
</ul>
