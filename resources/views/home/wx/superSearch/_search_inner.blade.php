<div class="mui-row" style="position: relative; margin-bottom: -5px;">
  <div class="mui-col-xs-12">
    <img src="/img/supersearch/search_inner_bg.jpg" width="100%" alt="">
  </div>
  <div class="mui-col-xs-12" style="position:absolute; bottom: 60px; ">
    <form class="mui-input-group" action="{{ route('home.coupon.search') }}" method="get" style="background:transparent;">
        <div class="mui-row">
          <div class="mui-col-xs-9 mui-pull-right" style="color: #fff; padding-left: 20px;">
            <input type="text" name="search" value="" placeholder="请输入商品名称,多条件用空格隔开。" style="background-color: #fff; border-radius: 20px 0px 0px 20px; height: 40px; color:rgba(237, 42, 122, 1);">
          </div>
          <div class="mui-col-xs-3 mui-pull-left" style="">
            <button type="submit" class="" style="height: 40px; background-color: rgba(237, 42, 122, 0.8); border: 0px; color: #fff; border-radius: 0px 20px 20px 0px; width: 80%;" >确认</button>
          </div>
        </div>
    </form>
  </div>
</div>
<div class="mui-row" id="super_search_inner_recommend">
  <h4>热门搜索</h4>
  <ul>
    <li><a class="a-can-do" href="{{ route('home.coupon.search') }}?search=衬衫">衬衫</a></li>
    <li><a class="a-can-do" href="{{ route('home.coupon.search') }}?search=童鞋">童鞋</a></li>
    <li><a class="a-can-do" href="{{ route('home.coupon.search') }}?search=钢化膜">钢化膜</a></li>
    <li><a class="a-can-do" href="{{ route('home.coupon.search') }}?search=垃圾桶">垃圾桶</a></li>
    <li><a class="a-can-do" href="{{ route('home.coupon.search') }}?search=防晒">防晒</a></li>
    <li><a class="a-can-do" href="{{ route('home.coupon.search') }}?search=糕点">糕点</a></li>
    <li><a class="a-can-do" href="{{ route('home.coupon.search') }}?search=水杯">水杯</a></li>
    <li><a class="a-can-do" href="{{ route('home.coupon.search') }}?search=休闲鞋">休闲鞋</a></li>
    <li><a class="a-can-do" href="{{ route('home.coupon.search') }}?search=配饰">配饰</a></li>
    <li><a class="a-can-do" href="{{ route('home.coupon.search') }}?search=护肤套装">护肤套装</a></li>
    <li><a class="a-can-do" href="{{ route('home.coupon.search') }}?search=面膜">面膜</a></li>
    <li><a class="a-can-do" href="{{ route('home.coupon.search') }}?search=伞">伞</a></li>
    <li><a class="a-can-do" href="{{ route('home.coupon.search') }}?search=项链">项链</a></li>
    <li><a class="a-can-do" href="{{ route('home.coupon.search') }}?search=收纳箱">收纳箱</a></li>
  </ul>
</div>
