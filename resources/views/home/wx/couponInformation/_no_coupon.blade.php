<!--没有优惠券的时候提示的信息-->
<div id="noCoupon" style="display: block; position: fixed; z-index: 999; width: 80%; margin-left: 10%; margin-right: 10%; top: 30%;">
  <div style="width: 100%; height: 30px; text-align: center; background-color: #ed2a7a; border-top-right-radius: 30px; border-top-left-radius: 30px; border: 1px solid #ed2a7a;">
    <span style="line-height: 30px; font-size: 18px; color: #FFFFFF; font-weight: 800;">提示</span>
  </div>
  <div style="padding: 5px 20px; width: 100%; background-color: #FFFFFF; border: 1px solid #ed2a7a;">
    <div style="border: 1px dashed #ed2a7a; margin-top:10px; padding: 20px 5px; position: relative; text-align: center;">
      <span style="font-size: 14px;  -webkit-user-select:auto;" id="kouLingCode">
        太可惜了，您来晚了~~~优惠券已经领完了，您可以看看其他的商品。
      </span>
    </div>
    <div id="kouLingDivBtn" style="position: relative; width: 40%; margin-left: 30%; bottom: 13px; padding: 2px; background-color: #ed2a7a; text-align: center;  border-radius: 14px;">
      <a class="a-can-do" href="{{ route('home.coupon') }}">
          <span id="kouLingBtn" class="kouLingBtn" data-clipboard-action="copy" data-clipboard-target="#kouLingCode" style="font-size: 14px; line-height: 14px; color: #FFFFFF;">查看其他优惠券</span>
      </a>
    </div>
  </div>
  <div style="width: 100%; height: 30px; text-align: center; background-color: #ed2a7a; border-bottom-right-radius: 30px; border-bottom-left-radius: 30px; border: 1px solid #ed2a7a;"></div>
</div>
<div id="noCouponZheZhao" onclick="shareClose()" style="display: block; position: fixed; z-index: 998; top: 0px; right: 0px; left: 0px; bottom: 0px; background-color: rgba(0,0,0,.1); opacity: 1;"></div>
