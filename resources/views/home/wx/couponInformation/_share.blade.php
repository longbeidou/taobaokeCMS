<div id="shareInfo" style="display: none; position: fixed; z-index: 999; width: 80%; margin-left: 10%; margin-right: 10%; top: 45px;">
  <div style="width: 100%; height: 30px; text-align: center; background-color: #ed2a7a; border-top-right-radius: 30px; border-top-left-radius: 30px; border: 1px solid #ed2a7a;">
    <span style="line-height: 30px; font-size: 18px; color: #FFFFFF; font-weight: 800;">分享优惠券</span>
  </div>
  <div style="padding: 5px 20px; width: 100%; background-color: #FFFFFF; border: 1px solid #ed2a7a; border-bottom-right-radius: 30px; border-bottom-left-radius: 30px;">
    <div style="border: 1px dashed #ed2a7a; margin: 10px 0px 0px; height: 250px;">
      <div style="height: 250px; padding: 2px; width: 100%; text-align: center;">
        <img src="{{ route('home.shareCouponImage', $couponInfo->id) }}" height="100%"/><br />
      </div>
    </div>
    <div style="text-align: center; margin: 0px 5px 0px;">
      <span style="font-size: 14px;">长按上方图片保存,分享给朋友</span>
    </div>
    <div style="border: 1px dashed #ed2a7a; padding: 5px 5px 15px; position: relative; text-align: left;">
      <p style="font-size: 12px; line-height:14px; margin-bottom:0px; -webkit-user-select:auto;" id="shareCode">
        {{ $couponInfo->goods_name }}（包邮）<br>
        【原 价】￥{{ $couponInfo->price }}元 <br>
        【券 后】￥{{ $couponInfo->price_now }}元<br>
        复制这条信息，打开「手机淘宝」即可领劵下单！{{ $taoKouLing }}
      </p>
    </div>
    <div id="shareDivBtn" style="position: relative; width: 60%; margin-left: 20%; bottom: 13px; padding: 2px; background-color: #EC971F; text-align: center; border-radius: 14px;">
      <span type="button" id="shareBtn" class="shareCodeBtn" data-clipboard-action="copy" data-clipboard-target="#shareCode" style="font-size: 14px; line-height: 14px; color: #FFFFFF;">复制分享给朋友</span>
    </div>
    <div style="font-size: 11px; color: red; text-align: center; margin-top: -10px;">
      注：若复制失败，请手动复制
    </div>
  </div>
</div>
