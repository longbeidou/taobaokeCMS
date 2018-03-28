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
    <div class="panel-body i-coupon">
      <div class="row">
        <div id="i-coupon" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <?php $m = count($info['coupons'])/3; ?>
            @for($i=0; $i<$m; $i++)
              @if($i == 0)
              <li data-target="#i-coupon" data-slide-to="0" class="active"></li>
              @else
              <li data-target="#i-coupon" data-slide-to="{{ $i }}" class=""></li>
              @endif
            @endfor
          </ol>
          <div class="carousel-inner" role="listbox">
            <?php $m = count($info['coupons'])/3; ?>
            @for($i=0; $i<$m; $i++)
              @if($i == 0)
              <div class="item active">
                  <div class="row">
                    @foreach($info['coupons'] as $key => $coupon)
                      @if($key < 3)
                      <div class="col-sm-12 coupon-box">
                        <a href="{{ route('home.couponInfo', $coupon->id) }}" target="_blank">
                          <div class="row coupon">
                            <div class="col-sm-4 image-box">
                              <img src="{{ $coupon->image }}" alt="{{ $coupon->goods_name }}">
                            </div>
                            <div class="col-sm-7 content">
                              <h4><span class="code">￥</span>{{ $coupon->price_now }}<del>￥{{ $coupon->price }}</del></h4>
                              <h5><span class="save">{{ $couponInfoPre->saveMoney($coupon->coupon_info, $coupon->price) }}</span>元优惠券</h5>
                              <h6 class="goods-name">{{ $coupon->goods_name }}</h6>
                            </div>
                            <div class="col-sm-1 info">
                              好评商品优惠券
                            </div>
                          </div>
                        </a>
                      </div>
                      @else
                      <?php break; ?>
                      @endif
                    @endforeach
                  </div>
              </div>
              @else
              <div class="item">
                <div class="row">
                  @foreach($info['coupons'] as $key => $coupon)
                    @if($key >= $i*3 && $key < $i*3+3)
                    <div class="col-sm-12 coupon-box">
                      <a href="{{ route('home.couponInfo', $coupon->id) }}" target="_blank">
                        <div class="row coupon">
                          <div class="col-sm-4 image-box">
                            <img src="{{ $coupon->image }}" alt="{{ $coupon->goods_name }}">
                          </div>
                          <div class="col-sm-7 content">
                            <h4><span class="code">￥</span>{{ $coupon->price_now }}<del>￥{{ $coupon->price }}</del></h4>
                            <h5><span class="save">{{ $couponInfoPre->saveMoney($coupon->coupon_info, $coupon->price) }}</span>元优惠券</h5>
                            <h6 class="goods-name">{{ $coupon->goods_name }}</h6>
                          </div>
                          <div class="col-sm-1 info">
                            好评商品优惠券
                          </div>
                        </div>
                      </a>
                    </div>
                    @endif
                    @if( $key >= $i*3+3)
                    <?php break; ?>
                    @endif
                  @endforeach

                </div>
              </div>
              @endif
            @endfor

          </div>
          <a class="carousel-control-left" href="#i-coupon" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          </a>
          <a class="carousel-control-right" href="#i-coupon" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
