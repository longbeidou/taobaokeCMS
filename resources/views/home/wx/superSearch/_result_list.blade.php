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
          <img src="/img/kefu.jpg" height="40px" style="border-radius: 20px;" alt="" />
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
<div class="mui-row" style="position:relative; padding: 10px 0px 5px; background-color: #fff; margin: 5px 0px;">
  <!--图片-->
  <div style="width:40%; float:left; padding-left:10px;">
    <img src="{{ $image->imageSuperSearchSrc($itemCoupon, $show_from) }}" width="100%" />
  </div>
  <div style="width:60%; float:left; padding: 0px 10px;">
    <p style="white-space: normal; color:#000; max-height: 40px; overflow: hidden; text-align: left;">{{ $itemCoupon['title'] }}</p>
  </div>
  <div style="position: absolute; bottom: 0px; left: 40%; padding: 0px 10px 3px;">
    <div style="width:100%; float:left;">
      <p class="mui-text-left"   style="margin-bottom: 0px; font-size: 11px; line-height: 12px;">
        特价口令:<span id="tpwdInfo{{ $key }}" style="-webkit-user-select: auto;">{{ $itemCoupon['tkl'] }}</span>
      </p>
    </div>
    <div style="width:100%; float:left;">
      <p class="mui-text-right" style="margin-top: 1px; margin-bottom: 0px;">
        <span style="font-size: 18px; color: #ed2a7a;">￥{{ $itemCoupon['zk_final_price'] }}</span>
        <span style="text-decoration: line-through; color: #929292;" >￥{{ $coupon->finalPrice($itemCoupon['coupon_info'], $itemCoupon['zk_final_price']) }}</span>
      </p>
    </div>
    <div style="width:100%; float:left;">
      <div class="mui-media-body mui-row" style="height: 2.2em;">
        <div class="mui-col-xs-7 mui-text-center coupon-info">立省10元</div>
        @if(!$show_from)
        <div class="mui-col-xs-5 mui-text-center coupon-take" id="tpwddiv{{ $key }}">
          <span type="button" id="tpwdBtn{{ $key }}" class="tpwdBtn{{ $key }}"  data-clipboard-action="copy" data-clipboard-target="#tpwdInfo{{ $key }}" >复制口令</span>
        </div>
        @else
        <div class="mui-col-xs-5 mui-text-center coupon-take">
          <a class="a-can-do" href="{{ $itemCoupon['coupon_click_url'] }}" style="color:#fff;" target="_blank">马上领券</a>
        </div>
        @endif
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
      document.getElementById('tpwddiv{{ $key }}').style.backgroundColor = "green";
  });

  clipboard.on('error', function(e) {
      console.log(e);
      document.getElementById('tpwdBtn{{ $key }}').innerHTML = "复制失败";
      document.getElementById('tpwdBtn{{ $key }}').style.backgroundColor = "red";
  });
  </script>
  @endif
@endforeach
