<!--商品标题等信息-->
<div class="mui-row" style="background-color: #FFFFFF; padding-right: 10px; padding-left: 10px;">
  <div class="mui-col-xs-12">
    <h5 style="line-height: 20px; color: #000;">{{ $couponInfo->goods_name }}
      <span style="color: #929292; font-weight: 400;">(月销{{ $couponInfo->sales }}件)</span>
    </h5>
  </div>
  <div class="mui-col-xs-8">
    <div class="mui-row" style="margin-top: 40px;">
      <div class="mui-col-xs-12">
        <span style="color: #ed2a7a;">￥</span>
        <span style="color: #ed2a7a; font-size: 30px;font-weight: 800;">{{ $couponInfo->price_now }}</span>
        <span style="background-color: #ed2a7a; display: inline-block; height: 20px;font-size:10px; line-height:20px; color: #FFFFFF; padding: 2px 5px 2px 5px; font-weight: 800;">券后价</span>
        <span style="font-size: 12px;color: #929292;">(包邮)</span>
      </div>
      <div class="mui-col-xs-12">
        <span style="font-size: 14px;">天猫在售￥{{ $couponInfo->price }}</span>&nbsp;
        <span style="font-size: 12px; color: #929292;">领券立省{{ $couponInformationArr[1]}}元</span>
      </div>
      <div class="mui-col-xs-12">
        @if(empty($couponCountInfo->coupon_remain_count))
        <span style="font-size:12px; color:#ed2a7a;">优惠券没有了，请关注其他商品！</span>
        @else
  			<span style="font-size:12px;">优惠券剩余{{ $couponCountInfo->coupon_remain_count }}份,请抓紧时间领取！</span>
        @endif
  		</div>
    </div>
  </div>
  <div class="mui-col-xs-4 mui-text-center">
    <img src="/img/about/qcode_public.jpg" style="width: 80%;">
    <p>微信关注找券神器<br />随时随地想找就找</p>
  </div>
</div>

<!--商品详情-->
<ul class="mui-table-view" id="couponInfo" style="margin-top: 10px;">
    <li class="mui-table-view-cell mui-collapse">
        <a class="mui-navigate-right" href="#">商品图文详情（点击展开）</a>
        <div class="mui-collapse-content">
            <p>正在加载商品详情信息...</p>
        </div>
    </li>
</ul>
