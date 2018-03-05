<div style="position: fixed; z-index: 998; bottom: 0px; height: 50px; width: 100%; text-align: center; background-color: #ed2a7a; ">
  <div style="width: 100%;">
    <div class="coupon-info-footer coupon-info-footer-home" style="width: 15%;">
      <a class="mui-tab-item mui-active mui-col-xs-2 a-can-do" href="/">
            <span class="mui-icon mui-icon-home"></span><br />
            <span class="mui-tab-label">首页</span>
        </a>
    </div>
    <div class="coupon-info-footer coupon-info-footer-kefu" style="width: 15%;">
        <a onclick="keFu()" >
            <span class="mui-icon mui-icon-weixin"></span><br />
            <span class="mui-tab-label">客服</span>
        </a>
    </div>
    <div class="coupon-info-footer coupon-info-footer-take" style="width: 35%;" >
        <a class="a-can-do" href="{{ route('home.coupon.urlConfirm', $couponInfo->id) }}">
            <span style="font-weight: 800; font-size: 17px; line-height: 46px;">领券下单</span>
        </a>
    </div>
    <div class="coupon-info-footer coupon-info-footer-code" style="width: 35%; background-color: #ed2a7a; ">
        <a onclick="taoKouLing()">
            <span style="font-weight: 800; font-size: 17px; line-height: 46px;">淘口令领券</span>
        </a>
    </div>
  </div>
</div>
