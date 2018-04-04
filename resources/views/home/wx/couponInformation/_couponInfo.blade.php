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
<ul class="mui-table-view" onclick="getCouponInfo()" id="couponInfo" style="margin-top: 10px;">
    <li  class="mui-table-view-cell mui-collapse mui-active">
        <a class="mui-navigate-right" href="#">商品图文详情</a>
        <div id="couponInfoDetails" class="mui-collapse-content" style="padding-left:0px; padding-right:0px;">
            <p class="mui-text-center">点击查看商品详情...</p>
        </div>
    </li>
</ul>

<script type="text/javascript">
  function getCouponInfo() {
    mui.ajax('{{ route('couponItemInfo.index', $couponInfo->goods_id) }}',{
    	data:{
    	},
    	dataType:'json',//服务器返回json格式数据
    	type:'get',//HTTP请求类型
    	timeout:10000,//超时时间设置为10秒；
    	headers:{'Content-Type':'application/json'},
    	success:function(data){
    		if(data.status == 'ok') {
          document.getElementById('couponInfoDetails').innerHTML = data.content;
        }
    	},
    	error:function(xhr,type,errorThrown){
    		//异常处理；
    		console.log(type);
    	}
    });
  }

</script>
