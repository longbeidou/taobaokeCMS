@foreach($couponsGussYouLike as $coupon)
<li class="mui-table-view-cell mui-media mui-col-xs-6">
    <a href="{{ $coupon->id }} ">
        <img class="mui-media-object" src="{{ route('image.index', $coupon->image_encrypt) }}">
        <span class="mui-badge mui-badge-red" style="position:absolute; right: 0px; top: 20px; background-color: #ed2a7a;">{{ $coupon->flat }}</span>
        <div class="mui-media-body" style="height: 52px;">
          <p style="white-space: normal; max-height: 30px; overflow: hidden;">{{ $coupon->goods_name}}</p>
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