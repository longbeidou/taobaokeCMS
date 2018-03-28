@inject('couponinfo', 'App\Presenters\CouponPresenter')
<div class="container" id="home-recommend">
  <div class="row">
    <div class="panel panel-warning">
      <div class="panel-heading">
        <div class="row">
          <div class="col-sm-6 r-title">
            <h4>精品优惠券推荐 <small>/ 实时更新 / 独享优惠券</small></h4>
          </div>
          <div class="col-sm-6 text-right r-content">
            <h4><small>/ 将优选、性价比做到极致 /</small></h4>
          </div>
        </div>
      </div>
      <!-- panner-body begin -->
      <div class="panel-body">
        <div class="row">

          @foreach($coupons as $key => $coupon)
          <div class="col-sm-6 r-coupon">
            <div class="row r-coupon-box">
              <div class="col-sm-5 r-left">
                <a href="{{ route('home.couponInfo', $coupon->id) }}" target="_blank">
                  <img src="{{ $coupon->image }}" alt="">
                </a>
              </div>
              <div class="col-sm-7 r-right">
                <div class="goods-name"><a href="{{ route('home.couponInfo', $coupon->id) }}" target="_blank">{{ $coupon->goods_name}}</a></div>
                <h5>店铺名称：{{ $coupon->shop_name }}</h5>
                <p class="coupon text-center">￥{{ $couponinfo->saveMoney($coupon->coupon_info, $coupon->price) }}元券</p>
                <p>优惠券剩余：{{ $coupon->coupon_last }}张</p>
                <div class="row buy">
                  <div class="buy-box">
                    <div class="col-sm-8 buy-left">
                      <h5>￥{{ $coupon->price_now }}元<small>券后价</small></h5>
                    </div>
                    <div class="col-sm-4 text-center buy-right">
                      <a href="{{ route('home.couponInfo', $coupon->id) }}" target="_blank">去抢购</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach

        </div>
      </div>
      <!-- panner-body end -->
    </div>
  </div>
</div>
