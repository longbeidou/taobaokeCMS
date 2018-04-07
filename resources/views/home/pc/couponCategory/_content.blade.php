@inject('couponInfoPre', 'App\Presenters\CouponPresenter')
@foreach($coupons as $coupon)
<div class="col-sm-3 coupon-box">
  <a href="{{ route('home.couponInfo', $coupon->id) }}" target="_blank">
    <div class="coupon">
      <div class="image-box">
        <img class="lazy" data-original="{{ $coupon->image}}" alt="">
      </div>
      <h2 class="goods-name">{{ $coupon->goods_name }}</h2>
      <div class="row price">
        <div class="col-sm-7 i-left text-left">
          <span class="price-now">{{ $coupon->price_now }}</span>元<span class="i-des">券后价</span>
        </div>
        <div class="col-sm-5 i-right text-right">
          原价<span>{{ $coupon->price }}</span>元
        </div>
        <div class="col-sm-12 sales">
          @if($coupon->flat == '淘宝')
          <img src="https://www.kemaide.com/Public/static/tuiquanke/images/tmall.png" alt="">
          @else
          <img src="https://www.kemaide.com/Public/static/tuiquanke/images/taobao.png" alt="">
          @endif
          月销量 {{ $coupon->sales }}，优惠券<span>{{ $couponInfoPre->saveMoney($coupon->coupon_info, $coupon->price) }}</span>元
        </div>
      </div>
    </div>
  </a>
</div>
@endforeach
