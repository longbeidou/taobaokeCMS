<div class="container" id="goods-info">
  <div class="row">
    <div class="col-sm-4 i-left">
      <div id="goods-image-list" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#goods-image-list" data-slide-to="0" class="active"></li>
          @foreach($smallImages as $key => $smallImage)
          <li data-target="#goods-image-list" data-slide-to="{{ $key+1 }}" class=""></li>
          @endforeach
        </ol>
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img src="{{ $couponInfo->image }}" >
          </div>
          @foreach($smallImages as $key => $smallImage)
          <div class="item">
            <img src="{{ $smallImage['src'] }}" >
          </div>
          @endforeach
        </div>
        <a class="left carousel-control" href="#goods-image-list" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        </a>
        <a class="right carousel-control" href="#goods-image-list" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        </a>
      </div>
    </div>
    <div class="col-sm-8 i-right">
      <h1>{{ $couponInfo->goods_name }}</h1>
      <div class="row price">
        <div class="col-sm-4 text-right i-left">
          券后价<span class="code">￥</span><span class="price-now">{{ $couponInfo->price_now }}</span>
        </div>
        <div class="col-sm-3 text-left i-center">
          原价<del>￥{{ $couponInfo->price }}</del>
        </div>
        <div class="col-sm-5 text-right i-right">
          已有<span class="i-no">{{ $couponInfo->sales }}</span>人抢购
        </div>
      </div>
      <div class="row i-info">
        <div class="col-sm-9 i-left">
          <div class="row remain-time">
            <div class="col-sm-5 text-right">
              <i class="iconfont icon-shijian" style="font-size: 20px; color: #ed2a7a;"></i>
              离优惠券失效还剩：
            </div>
            <div id="timedown" class="col-sm-7 text-center" style="font-size: 20px;"></div>
          </div>
          <div class="row" style="padding: 0px 0px 20px; color: #777;">
            <div class="col-sm-4" style="padding: 0px 0px;">
              {{ $couponInfo->shop_name }}
            </div>
            <div class="col-sm-4" style="padding: 0px 0px;">
              优惠券剩余{{ $couponCountInfo->coupon_total_count }}份
            </div>
            <div class="col-sm-4" style="padding: 0px 0px;">
              截止日期：{{ $couponInfo->coupon_end_date }}
            </div>
          </div>
          <div class="row i-flow">
            <div class="col-sm-2 text-right" style="padding-top: 18px;">
              购买<br />流程
            </div>
            <div class="col-sm-5 text-center">
              <span class='i-coupon'>领券立省<br/><span>{{ $couponInformationArr[1] }}元</span></span>
              <a href="{{ $couponInfo->coupon_promote_link }}" target="_blank">
                <span class="text-center i-action">点击<br />领券</span>
              </a>
            </div>
            <div class="col-sm-1" style="height: 78px; padding-top: 20px;">
              <i class="iconfont icon-arrow-right" style="font-size: 30px; color: #ed2a7a;"></i>
            </div>
            <div class="col-sm-4 text-center">
                <a href="{{ $couponInfo->coupon_promote_link }}" target="_blank" style="font-size: 16px; color: #fff;">
                  <span class="i-take">领券下单</span>
                </a>
            </div>
          </div>
        </div>
        <div class="col-sm-3 text-center i-right">
          <h6>手机淘宝扫码领券购买</h6>
          <div class="image-box">
            <img src="https://www.kemaide.com//item/qrcode/dataurl/https%253A%252F%252Fwww.52010000.cn%252Fcoupon%252Fedetail%253Fe%253DVg4DVd5pUGkGQASttHIRqdVXi0NAlwkZ87i4JEIe4h1OT%25252Fz9yavfqkDSYPLw84PSZa7%25252BK1aW%25252F5NHaGaoiQxs6pBh%25252BsFgnewCt5bBKNQlPfst%25252FzOJQMDvl0gfTscre%25252FnAq7mwfF7BeUuYWVLjprSXYw%25253D%25253D%2526activityId%253De3467899837744159ed0a240253811e2%2526itemId%253D555685917741%2526pid%253Dmm_11702096_18304123_65458007%2526af%253D1.html" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- 倒计时 -->
<script language="javascript" type="text/javascript">
    var interval = 1000;
    function ShowCountDown(year,month,day,divname)
    {
    var now = new Date();
    var endDate = new Date(year, month-1, day);
    var leftTime=endDate.getTime()-now.getTime();
    var leftsecond = parseInt(leftTime/1000);
    var day1=Math.floor(leftsecond/(60*60*24));
    var hour=Math.floor((leftsecond-day1*24*60*60)/3600);
    var minute=Math.floor((leftsecond-day1*24*60*60-hour*3600)/60);
    var second=Math.floor(leftsecond-day1*24*60*60-hour*3600-minute*60);
    var cc = document.getElementById(divname);
    cc.innerHTML = day1+"天"+hour+"小时"+minute+"分"+second+"秒";
    }
    window.setInterval(function(){ShowCountDown({{$datetime[0]}},{{$datetime[1]}},{{$datetime[2]+1}},'timedown');}, interval);
</script>
