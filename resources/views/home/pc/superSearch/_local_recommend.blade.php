@foreach($couponsRecommend as $coupon)
<div class="col-sm-6 coupon-box" style="padding-left: 0px; padding-right: 0px;">
  <div class="i-coupon">
    <a href="{{ route('home.couponInfo', $coupon->id) }}" target="_blank" title="{{ $coupon->goods_name }}">
      <div class="image-box">
        <img class="lazy" data-original="{{ $coupon->image }}"  alt="">
      </div>
      <div class="text-center">
        <h6 class="goods-name">{{ $coupon->goods_name }}</h6>
      </div>
      <div class="text-center">
        <h6>￥{{ $coupon->price_now }}<small>￥<del>{{ $coupon->price }}</del></small></h6>
      </div>
      <div class="text-center save">
        领券省<br /> <strong>{{ $couponInfoPre->saveMoney($coupon->coupon_info, $coupon->price) }}</strong>元
      </div>
    </a>
  </div>
</div>
@endforeach
