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
    <div class="panel-body grid">
      <div class="row">
        @foreach($info['coupons'] as $key => $coupon)
          @if($key > 8)
          <?php break; ?>
          @endif
          <a href="{{ route('home.couponInfo', $coupon->id) }}" target="_blank">
            <div class="col-sm-4 i-info">
              <div class="image">
                <img class="lazy" data-original="{{ $coupon->image }}"  alt="{{ $coupon->goods_name }}">
              </div>
              <div class="title">
                <h6>{{ $coupon->goods_name }}</h6>
              </div>
              <div class="text-center price">
                <strong>￥{{ $coupon->price_now }}</strong> <small><del>￥{{ $coupon->price }}</del></small>
              </div>
            </div>
          </a>
        @endforeach

      </div>
    </div>
  </div>
</div>
