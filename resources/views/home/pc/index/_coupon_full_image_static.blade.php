<div class="col-sm-12 goods-box full-image-static">
  <div class="row title">
    <div class="col-sm-12 text-center">
      <h2>—— {{ $info['category_name'] }} ——</h2>
    </div>
  </div>
  <div class="row coupon">

    <div class="col-sm-4 i-left">
      <div class="row image-box-left">
        @foreach($info['coupons'] as $key => $coupon)
          @if($key < 4)
          <div class="col-sm-6 small-image-box">
            <a href="{{ route('home.couponInfo', $coupon->id) }}" target="_blank">
              <img data-src="{{ $coupon->image }}" src="/img/loading.gif" alt="{{ $coupon->goods_name }}">
              <div class="text-center i-text">
                <h6>{{ $coupon->goods_name }}</h6>
                <h6 class="price">￥{{ $coupon->price_now }} <del>{{ $coupon->price }}</del></h6>
              </div>
            </a>
          </div>
          @else
          <?php break; ?>
          @endif
        @endforeach
      </div>
    </div>

    <div class="col-sm-4 i-center">
      <div class="row image-box-center">
        @foreach($info['coupons'] as $key => $coupon)
          @if($key == 4)
          <div class="col-sm-12">
            <a href="{{ route('home.couponInfo', $coupon->id) }}" target="_blank">
              <img data-src="{{ $coupon->image }}" src="/img/loading.gif" alt="{{ $coupon->goods_name }}">
              <div class="text-center i-text">
                <h6>{{ $coupon->goods_name }}</h6>
                <h6 class="price">￥{{ $coupon->price_now }} <del>{{ $coupon->price }}</del></h6>
              </div>
            </a>
          </div>
          @endif
        @endforeach
      </div>
    </div>

    <div class="col-sm-4 i-right">
      <div class="row image-box-right">
        @foreach($info['coupons'] as $key => $coupon)
          @if($key >8)
          <?php break; ?>
          @endif
          @if($key > 4)
          <div class="col-sm-6 small-image-box">
            <a href="{{ route('home.couponInfo', $coupon->id) }}" target="_blank">
              <img data-src="{{ $coupon->image }}" src="/img/loading.gif" alt="{{ $coupon->goods_name }}">
              <div class="text-center i-text">
                <h6>{{ $coupon->goods_name }}</h6>
                <h6 class="price">￥{{ $coupon->price_now }} <del>{{ $coupon->price }}</del></h6>
              </div>
            </a>
          </div>
          @endif
        @endforeach

      </div>
    </div>

  </div>
</div>
