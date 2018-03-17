<!--解决复制的问题-->
<script src="https://cdn.jsdelivr.net/npm/clipboard@1/dist/clipboard.min.js"></script>
<div class="mui-row">
  <div class="mui-col-xs-12" style="text-align: center; margin: 10px 0px 5px;">
  </div>
  <!--图片-->
  <div class="mui-col-xs-12">
    <a class="a-can-do" href="#">
      <div class="mui-row" style="padding-right: 10px;">
        <div class="mui-col-xs-2" style="padding: 3px 3px 3px 5px;">
          <img src="/img/logo.jpg" height="40px" style="border-radius: 20px;" alt="" />
        </div>
        <div class="mui-col-xs-9" style="position: relative; background-color: #FFFFFF; min-height: 40px; padding: 5px; border-radius: 10px; margin-bottom: 10px;">
          <div class="dialogue-triangle"></div>
          <div style="text-align: center; padding: 5px;">
            @if(count($itemCouponsArr) == 0)
            <p>使出了吃奶的力气也没有找到要相关的宝贝，建议搜索其他的宝贝试试~~~</p>
            @else
            <p>玩命搜索后,共找到{{ count($itemCouponsArr) }}个宝贝信息!</p>
            @endif
            @if (count($errors) > 0)
              @foreach ($errors->all() as $error)
              <p>{{ $error }}</p>
              @endforeach
            @endif
          </div>
        </div>
      </div>
    </a>
  </div>
</div>
@inject('coupon', 'App\Presenters\CouponPresenter')
@inject('image', 'App\Presenters\ImageSrcShowFrom')
@foreach($itemCouponsArr as $key=>$itemCoupon)
<!--查询的结果-->
@if(!empty($itemCoupon['coupon_info']))
<div class="mui-row">
  <div class="mui-col-xs-12" style="text-align: center; margin: 10px 0px 5px;">
    <span style="color: #555555; font-size: 14px;">{{ date('H:i:s', time()) }}</span>
  </div>
  <!--图片-->
  <div class="mui-col-xs-12">
    <a class="a-can-do" href="#">
      <div class="mui-row" style="padding-right: 10px;">
        <div class="mui-col-xs-2" style="padding: 3px 3px 3px 5px;">
          <img src="/img/logo.jpg" height="40px" style="border-radius: 20px;" alt="" />
        </div>
        <div class="mui-col-xs-5" style="position: relative; background-color: #FFFFFF; min-height: 40px; padding: 5px; border-radius: 10px; margin-bottom: 10px;">
          <div class="dialogue-triangle"></div>
          <div style="text-align: center; padding: 5px;">
            <img src="{{ $image->imageSuperSearchSrc($itemCoupon, $show_from) }}" width="100%" />
          </div>
        </div>
      </div>
    </a>
  </div>
  <!--文字信息-->
  <div class="mui-col-xs-12" style="margin-bottom: 10px;">
      <div class="mui-row" style="padding-right: 10px;">
        <div class="mui-col-xs-2" style="padding: 3px 3px 3px 5px;">
          <img src="/img/logo.jpg" height="40px" style="border-radius: 20px;" alt="" />
        </div>
        <div class="mui-col-xs-10" style="position: relative; background-color: #FFFFFF; min-height: 40px; padding: 5px; border-radius: 10px;">
          <div class="dialogue-triangle"></div>
          <div>
            <p style="-webkit-user-select: auto; padding: 5px; font-size: 14px; margin-bottom: -10px;" id="tpwdInfo{{ $key }}" >
              商品名：{{ $itemCoupon['title'] }}<br />
              原&nbsp;&nbsp;&nbsp;价：{{ $itemCoupon['zk_final_price'] }}元【券后只要{{ $coupon->finalPrice($itemCoupon['coupon_info'], $itemCoupon['zk_final_price']) }}元】<br>
              店铺名：{{ $itemCoupon['shop_title'] }}<br />
              @if(!empty($itemCoupon['item_description']))
              其&nbsp;&nbsp;&nbsp;他：{{ $itemCoupon['item_description'] }}
              @endif
              {{ $itemCoupon['title'] }}<br>
              @if(!empty($itemCoupon['tkl']))
              特价口令：{{ $itemCoupon['tkl'] }}。<br />
              复制此信息，打开手机淘宝即可领取优惠。
              @endif
            </p>
            <hr style="border: 1px dotted #555555;" />
            <div class="mui-row" style="padding-bottom: 5px;">
              <div class="mui-col-xs-6">
                <span style="color: #ed2a7a; font-size: 16px; margin-left: 10px;">领取立省{{  $coupon->saveMoney($itemCoupon['coupon_info'], $itemCoupon['zk_final_price']) }}元</span>
              </div>
              <div class="mui-col-xs-6">
                @if($show_from)
                <div style="padding-right:20px; font-size: 16px; font-weight: 800;">
                  <span type="button" id="tpwdBtn{{ $key }}" class="tpwdBtn{{ $key }}"  data-clipboard-action="copy" data-clipboard-target="#tpwdInfo{{ $key }}" style="background-color: #ed2a7a; color: #fff; padding: 2px 10px; border-radius: 19px; float: right;">复制口令</span>
                </div>
                @else
                <a class="a-can-do" href="{{ $itemCoupon['coupon_click_url'] }}" target="_blank">
                  <div style="border: 1px solid #ed2a7a; border-radius: 20px; width: 110px; background-color: #ed2a7a; color: #FFFFFF; font-size: 18px; font-weight: 800;">
                    <span class="mui-icon mui-icon-plus" style="color: #ed2a7a; background-color: #FFFFFF; border-radius: 20px;"></span>领券购买
                  </div>
                </a>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>

</div>

<!--复制淘口令-->
  <script>
  var clipboard = new Clipboard('.tpwdBtn{{ $key }}');

  clipboard.on('success', function(e) {
      console.log(e);
      document.getElementById('tpwdBtn{{ $key }}').innerHTML = "复制成功";
      document.getElementById('tpwdBtn{{ $key }}').style.backgroundColor = "green";
  });

  clipboard.on('error', function(e) {
      console.log(e);
      document.getElementById('tpwdBtn{{ $key }}').innerHTML = "复制失败";
      document.getElementById('tpwdBtn{{ $key }}').style.backgroundColor = "red";
  });
  </script>
  @endif
@endforeach
