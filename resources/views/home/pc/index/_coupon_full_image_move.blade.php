<div class="col-sm-12 goods-box full-image-move">
  <div class="row title">
    <div class="col-sm-12 text-center">
      <h2>—— {{ $info['category_name'] }} ——</h2>
    </div>
  </div>
  <div class="row coupon">
    <div id="full-image-move" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php
          $m = count($info['coupons']) / 3;
        ?>
        @for($i=0; $i< $m; $i++)
          @if($i == 0)
          <li data-target="#full-image-move" data-slide-to="0" class="active"></li>
          @else
          <li data-target="#full-image-move" data-slide-to="{{$i}}" class=""></li>
          @endif
        @endfor
      </ol>
      <div class="carousel-inner" role="listbox">

        @for($i=0; $i<$m; $i++)
          @if($i==0)
          <div class="item active">
            <div class="row coupon-box">
              @foreach($info['coupons'] as $key => $coupon)
                @if($key < 3)
                <div class="col-sm-4 i-left">
                  <a href="{{ route('home.couponInfo', $coupon->id) }}" target="_blank">
                    <div class="row image-box">
                      <div class="image">
                        <img src="{{ $coupon->image }}" alt="{{ $coupon->goods_name }}">
                      </div>
                      <h3 class="goods-name">{{ $coupon->goods_name }}</h3>
                      <div class="col-sm-6 i-price">
                        <h6 class="price">￥{{ $coupon->price_now }} <del><small>￥{{ $coupon->price }}</small></del></h6>
                      </div>
                      <div class="col-sm-6 text-right i-save">
                        <h6 class="save">领券立省<strong>{{ $couponInfoPre->saveMoney($coupon->coupon_info, $coupon->price) }}</strong>元</h6>
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
            <div class="row coupon-box">
              @foreach($info['coupons'] as $key => $coupon)
                @if($key >= $i*3 && $key < $i*3+3)
                <div class="col-sm-4 i-left">
                  <a href="{{ route('home.couponInfo', $coupon->id) }}" target="_blank">
                    <div class="row image-box">
                      <div class="image">
                        <img src="{{ $coupon->image }}" alt="{{ $coupon->goods_name }}">
                      </div>
                      <h3 class="goods-name">{{ $coupon->goods_name }}</h3>
                      <div class="col-sm-6 i-price">
                        <h6 class="price">￥{{ $coupon->price_now }} <del><small>￥{{ $coupon->price }}</small></del></h6>
                      </div>
                      <div class="col-sm-6 text-right i-save">
                        <h6 class="save">领券立省<strong>{{ $couponInfoPre->saveMoney($coupon->coupon_info, $coupon->price) }}</strong>元</h6>
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

      <a class="carousel-control-left" href="#full-image-move" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      </a>
      <a class="carousel-control-right" href="#full-image-move" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      </a>
    </div>
  </div>
</div>
