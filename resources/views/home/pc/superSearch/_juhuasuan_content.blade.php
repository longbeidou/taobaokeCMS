<div class="col-sm-8">
  <div class="" style="padding-left: 15px; padding-right: 15px;">
    @if(!empty($itemCouponsArr['items']))
    <div class="row coupon-info">
      @foreach($itemCouponsArr['items'] as $key => $item)
      <div class="col-sm-12" style="background-color: #fff; margin-bottom: 15px;">
        <div class="row" style="padding-top: 15px; padding-bottom: 15px; height: 240px;">
          <div class="col-sm-4 image-box">
            <a href="{{ $item['pc_url'] }}" target="_blank" class="goods-name">
              <img class="lazy" data-original="{{ $item['pic_url_for_p_c'] }}"  alt="{{ $item['title'] }}">
            </a>
          </div>
          <div class="col-sm-8">
            <div class="row">
              <div class="col-sm-12" style="height: 45px;">
                <a href="{{ $item['pc_url'] }}" target="_blank" class="goods-name">
                  <h2 style="line-height: 20px;">{{ $item['title'] }}{{ time()}}</h2>
                </a>
              </div>
              <div class="col-sm-9 price" style="padding-right: 0px;">
                聚划算价格￥<strong>{{ $item['act_price'] }}</strong>元 在售价￥<del>{{ $item['orig_price'] }}</del>元
              </div>
              <div class="col-sm-3 text-center" style="padding-left: 0px;">
                  @if($item['pay_postage'] )
                  <span style="color: #ed2a7a;">包邮免运费</span>
                  @else
                  <span style="color: #777;">邮费自理</span>
                  @endif
              </div>
              <div class="col-sm-12">
                <p style="margin-bottom: 0px;">
                  产品特点：
                  @foreach($item['item_usp_list'] as $list)
                    <span style="color: #ed2a7a;">{{ $list }}</span> /
                  @endforeach
                </p>
              </div>
              <div class="col-sm-8 text-center">
                <div class="row" style="padding-top: 20px;">
                  <div class="col-sm-1 text-center i-coupon-title">
                    优惠券
                  </div>
                  <div class="col-sm-8 text-center i-coupon-info" style="padding-top: 2px; padding-bottom: 11px;">
                    <h6>{{ $item['price_usp_list'] }}</h6>
                    <p class="text-center">开始展示时间:{{ date('Y-m-d H:i:s', substr($item['show_start_time'], 0, 10)) }}<br />开团结束时间:{{ date('Y-m-d H:i:s', substr($item['show_end_time'], 0, 10)) }}</p>
                  </div>
                  <div class="col-sm-3 text-center i-take">
                    <a class="btn btn-lg" href="{{ $item['pc_url'] }}" target="_blank">
                      马上<br>领券
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 text-center qrcode">
                <h6>手机淘宝扫码领券购买</h6>
                <img class="lazy" data-original="http://api.qrserver.com/v1/create-qr-code/?size=90x90&data={{ $item['wap_url'] }}"   width="90px" alt="">
                <div class="big-qrcode">
                  <img class="lazy" data-original="http://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $item['wap_url'] }}"  width="90px" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @endif
    <div class="row text-center page">
      @include('home.pc.superSearch._pagination_juhuasuan')
    </div>
  </div>
</div>
