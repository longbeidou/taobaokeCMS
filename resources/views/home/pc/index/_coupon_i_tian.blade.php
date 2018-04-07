<div class="col-sm-4 goods-box">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="row">
        <div class="col-sm-6"><h3>{{ $info['category_name'] }}</h3></div>
        <div class="col-sm-6 text-right">
          <a href="{{ route('home.coupon', $info['id']) }}" target="_blank"><i class="iconfont icon-jiantou2"></i>更多</a>
        </div>
      </div>
    </div>
    <div class="panel-body i-tian">
      <div class="row">
        @foreach($info['coupons'] as $key => $coupon)
          @if($key>3)
          <?php break; ?>
          @endif
        <div class="col-sm-6 coupon-box">
          <a href="{{ route('home.couponInfo', $coupon->id) }}" target="_blank">
            <div class="row coupon">
              <div class="col-sm-12 text-center image-box">
                <img class="lazy" data-original="{{ $coupon->image }}"   alt="{{ $coupon->goods_name }}">
              </div>
              <div class="col-sm-12 text-center">
                <h3 class="goods-name">{{ $coupon->goods_name }}</h3>
                <h4 class="price"><span>￥{{ $coupon->price_now }}</span><small><del>￥{{ $coupon->price }}</del></small></h4>
              </div>
            </div>
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
