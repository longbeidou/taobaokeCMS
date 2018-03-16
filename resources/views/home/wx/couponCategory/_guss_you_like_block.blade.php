@inject('image', 'App\Presenters\ImageSrcShowFrom')
@foreach($couponsGussYouLike as $coupon)
<li class="mui-table-view-cell mui-media mui-col-xs-6">
    <a class="a-can-do" href="{{ route('home.couponInfo', $coupon->id) }}">
        <img class="mui-media-object" src="{{ $image->imageSrc($coupon, $show_from) }}">
        <span class="mui-badge mui-badge-red" style="position:absolute; right: 0px; top: 20px; background-color: #ed2a7a;">{{ $coupon->flat }}</span>
        <div class="mui-media-body" style="height: 52px;">
          <p style="white-space: normal; color:#000; max-height: 30px; overflow: hidden; text-align:left;">{{ $coupon->goods_name}}</p>
          <p class="mui-text-left" style="margin-top: 5px;">
            <span style="font-size: 18px; color: #ed2a7a;">￥{{ $coupon->price_now }}</span>
            <span style="text-decoration: line-through; color: #929292;">￥{{ $coupon->price }}</span>
          </p>
        </div>
        <div class="mui-media-body mui-row" style="height: 2.2em;">
          <div class="mui-col-xs-7 coupon-info">{{ $coupon->coupon_info }}</div>
          <div class="mui-col-xs-5 coupon-take">马上领券</div>
        </div>
    </a>
</li>
@endforeach
