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
    <div class="panel-body image-carousel">
      <div class="row">
        <div class="col-sm-12">
          <div id="image-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <?php $m = count($info['coupons']); ?>
              @foreach($info['coupons'] as $key => $coupon)
                @if($key == 0)
                <li data-target="#image-carousel" data-slide-to="0" class="active"></li>
                @else
                <li data-target="#image-carousel" data-slide-to="{{ $key }}" class=""></li>
                <?php
                if($key > 15) {
                  break;
                }
                ?>
                @endif
              @endforeach
            </ol>
            <div class="carousel-inner" role="listbox">
              @foreach($info['coupons'] as $key => $coupon)
                @if($key == 0)
                <div class="item active">
                  <div class="row i-foot">
                    <div class="col-sm-12 image">
                      <a href="{{ route('home.couponInfo', $coupon->id) }}" target="_blank"><img src="{{ $coupon->image }}" ></a>
                    </div>
                    <div class="col-sm-12 title">
                      <a href="{{ route('home.couponInfo', $coupon->id) }}" target="_blank"><h4>{{ $coupon->goods_name }}</h4></a>
                    </div>
                    <div class="col-sm-6 i-left">
                      <strong>￥{{ $coupon->price_now }}</strong><small><del>￥{{ $coupon->price }}</del></small>
                    </div>
                    <div class="col-sm-6 text-right i-right">
                      领券立省<strong>￥{{ $couponInfoPre->saveMoney($coupon->coupon_info, $coupon->price) }}</strong>元</small>
                    </div>
                  </div>
                </div>
                @else
                <div class="item">
                  <div class="row i-foot">
                    <div class="col-sm-12 image">
                      <a href="{{ route('home.couponInfo', $coupon->id) }}" target="_blank"><img src="{{ $coupon->image }}" ></a>
                    </div>
                    <div class="col-sm-12 title">
                      <a href="{{ route('home.couponInfo', $coupon->id) }}" target="_blank"><h4>{{ $coupon->goods_name }}</h4></a>
                    </div>
                    <div class="col-sm-6 i-left">
                      <strong>￥{{ $coupon->price_now }}</strong><small><del>￥{{ $coupon->price }}</del></small>
                    </div>
                    <div class="col-sm-6 text-right i-right">
                      领券立省<strong>￥{{ $couponInfoPre->saveMoney($coupon->coupon_info, $coupon->price) }}</strong>元</small>
                    </div>
                  </div>
                </div>
                <?php
                if($key > 15) {
                  break;
                }
                ?>
                @endif
              @endforeach
            </div>
            <a class="carousel-control-left" href="#image-carousel" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-right" href="#image-carousel" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
