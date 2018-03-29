<footer class="container-fluid" id="footer">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <ul class="list-inline">
          <li><a href="/" target="_blank">首页</a></li> /
          @foreach($categorys as $category)
          <li><a href="{{ $category['link']}}" target="_blank">{{  $category['name'] }}</a></li> /
          @endforeach
        </ul>
      </div>
      <div class="col-sm-6 text-right">
        <h5>—— 分享淘宝天猫优惠券的专业网站 ——</h5>
      </div>
      <div class="col-sm-6">
        Powered by {{ config('website.company_name') }}
      </div>
      <div class="col-sm-6 text-right">
        Copyright@2018-2018 备案号：{{ config('website.domain_beian') }}
      </div>
    </div>
  </div>
</footer>
