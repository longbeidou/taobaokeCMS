<div class="col-sm-8">
  <div class="" style="padding-left: 15px; padding-right: 15px;">
    <div class="row coupon-info">
      @foreach($itemCouponsArr as $key => $coupon)
      <div class="col-sm-12" style="background-color: #fff; margin-bottom: 15px;">
        <div class="row" style="padding-top: 15px; padding-bottom: 15px; height: 240px;">
          <div class="col-sm-4 image-box">
            <a href="{{ $coupon['coupon_click_url'] }}" target="_blank" class="goods-name">
              <img data-src="{{ $coupon['pict_url'] }}" src="/img/loading.gif" alt="{{ $coupon['title'] }}">
            </a>
          </div>
          <div class="col-sm-8">
            <div class="row">
              <div class="col-sm-12" style="height: 45px;">
                <a href="{{ $coupon['coupon_click_url'] }}" target="_blank" class="goods-name">
                  <h2 style="line-height: 20px;">{{ $coupon['title'] }}</h2>
                </a>
              </div>
              <div class="col-sm-8 price" style="padding-right: 0px;">
                券后价￥<strong>{{ $couponInfoPre->finalPrice($coupon['coupon_info'], $coupon['zk_final_price']) }}</strong>元 在售价￥<del>{{ $coupon['zk_final_price'] }}</del>元
              </div>
              <div class="col-sm-4 text-right" style="padding-left: 0px;">
                已有<span>{{ $coupon['volume'] }}</span>人抢购
              </div>
              <div class="col-sm-7">
                <p style="margin-bottom: 0px;">店铺：{{ $coupon['shop_title'] }}</p>
              </div>
              <div class="col-sm-5 text-right">
                <span style="color: #ed2a7a;">
                  @if($coupon['user_type'] == 1)
                  天猫
                  @else
                  淘宝
                  @endif
                </span>在售
              </div>
              <div class="col-sm-8 text-center">
                <div class="row" style="padding-top: 20px;">
                  <div class="col-sm-1 text-center i-coupon-title">
                    优惠券
                  </div>
                  <div class="col-sm-8 text-center i-coupon-info">
                    <h6>{{ $couponInfoPre->saveMoney($coupon['coupon_info'], $coupon['zk_final_price']) }}元券</h6>
                    <p class="text-center">{{ $coupon['coupon_start_time'] }} - {{ $coupon['coupon_end_time'] }}</p>
                  </div>
                  <div class="col-sm-3 text-center i-take">
                    <a class="btn btn-lg" href="{{ $coupon['coupon_click_url'] }}" target="_blank">
                      马上<br>领券
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 text-center qrcode">
                <h6>手机淘宝扫码领券购买</h6>
                <img data-src="http://api.qrserver.com/v1/create-qr-code/?size=90x90&data={{ $coupon['coupon_click_url'] }}" src="/img/loading.gif" width="90px" alt="">
                <!-- <img data-src="http://pan.baidu.com/share/qrcode?w=150&h=150&url= route('home.couponInfo.QrCode', $coupon->id) }}" src="/img/loading.gif" width="90px" alt=""> -->
                <!-- <img data-src=" route('image.QrCode.index') }}?info= route('home.couponInfo.QrCode', $coupon->id) }}&size=104" src="/img/loading.gif" width="90px" alt=""> -->
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="row text-center page">
      @include('home.pc.superSearch._pagination')
    </div>
  </div>
</div>
