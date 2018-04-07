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
    <div class="panel-body only-image">
      <div class="row">
        @foreach($info['coupons'] as $key => $coupon)
          @if($key == 0)
          <div class="col-sm-12 i-top">
            <a href="{{ route('home.couponInfo', $coupon->id) }}" title="{{ $coupon->goods_name }}" target="_blank"><img class="lazy" data-original="{{ $coupon->image }}"  alt="{{ $coupon->goods_name }}"></a>
          </div>
          @else
          <?php break; ?>
          @endif
        @endforeach
        <div class="col-sm-12 i-buttom">
          @foreach($info['coupons'] as $key => $coupon)
            @if($key > 0 && $key < 4)
            <div class="col-sm-4 i-left">
              <a href="{{ route('home.couponInfo', $coupon->id) }}" title="{{ $coupon->goods_name }}" target="_blank"><img class="lazy" data-original="{{ $coupon->image }}"  alt="{{ $coupon->goods_name }}"></a>
            </div>
            @endif
            @if($key >= 4)
            <?php break; ?>
            @endif
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
