<!--商品标题等信息-->
<div class="mui-row" style="background-color: #FFFFFF;">
  <div class="mui-col-xs-12">
    <h4 style="line-height: 20px;">{{ $couponInfo->goods_name }}
      <span style="color: #929292; font-weight: 400;">(月销{{ $couponInfo->sales }}件)</span>
    </h4>
  </div>
  <div class="mui-col-xs-8">
    <div class="mui-row" style="margin-top: 40px;">
      <div class="mui-col-xs-12">
        <span style="color: #ed2a7a;">￥</span>
        <span style="color: #ed2a7a; font-size: 30px;font-weight: 800;">{{ $couponInfo->price_now }}</span>
        <span style="background-color: #ed2a7a; display: inline-block; height: 30px; color: #FFFFFF; padding: 10px 5px 0px; font-weight: 800;">券后价</span>
        <span style="font-size: 12px;color: #555555;">(包邮)</span>
      </div>
      <div class="mui-col-xs-12">
        <span style="font-size: 14px;">天猫在售￥{{ $couponInfo->price }}</span>&nbsp;
        <span style="font-size: 12px; color: #555555;">领券立省{{ $couponInformationArr[1]}}元</span>
      </div>
    </div>
  </div>
  <div class="mui-col-xs-4 mui-text-center">
    <img src="http://placehold.it/400x400" style="width: 80%;">
    <p>微信关注找券神器<br />随时随地想找就找</p>
  </div>
</div>

<!--商品详情-->
<ul class="mui-table-view" style="margin-top: 10px;">
    <li class="mui-table-view-cell mui-collapse">
        <a class="mui-navigate-right" href="#">商品图文详情</a>
        <a style="position:absolute; top:13px; right: 23px; color: #555555;" >（点击展开）</a>
        <div class="mui-collapse-content">
            <p>商品图片详情</p>
        </div>
    </li>
</ul>
