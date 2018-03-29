<div class="container" id="banner">
  <div class="row">
    <div class="col-sm-3 b-left">
      <ul class="list-inline">
        @foreach($couponCategorys as $key => $couponCategory)
        <li><a href="{{ route('home.coupon', $couponCategory->id) }}" target="_blank">{!! $couponCategory->font_icon !!} {{ $couponCategory->category_name }}</a></li>
        @endforeach
      </ul>
    </div>
    <div class="col-sm-6 b-center">
      <div id="banner-list" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          @foreach($banners as $key => $banner)
            @if($key == 0)
            <li data-target="#banner-list" data-slide-to="{{$key}}" class="active"></li>
            @else
            <li data-target="#banner-list" data-slide-to="{{$key}}" class=""></li>
            @endif
          @endforeach
        </ol>
        <div class="carousel-inner" role="listbox">
          @foreach($banners as $key => $banner)
            @if($key == 0)
            <div class="item active">
            @else
            <div class="item">
            @endif
              <a href="{{ $banner->link }}" target="_blank">
                <img src="{{ $banner->image }}" alt="{{ $banner->name }}">
              </a>
            </div>
          @endforeach
        </div>
        <a class="left carousel-control" href="#banner-list" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        </a>
        <a class="right carousel-control" href="#banner-list" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        </a>
      </div>
    </div>
    <div class="col-sm-3 b-right">
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#banner-right-one" role="tab" data-toggle="tab" aria-controls="banner-right-one" aria-expanded="true">推荐</a></li>
        <li role="presentation" class=""><a href="#banner-right-two" role="tab" data-toggle="tab" aria-controls="banner-right-two" aria-expanded="false">公众号</a></li>
        <li role="presentation" class=""><a href="#banner-right-three" role="tab" data-toggle="tab" aria-controls="banner-right-three" aria-expanded="false">客服</a></li>
        <li role="presentation" class=""><a href="#banner-right-four" role="tab" data-toggle="tab" aria-controls="banner-right-four" aria-expanded="false">手机端</a></li>
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in" id="banner-right-one" aria-labelledby="banner-right-one-tab">
          <p>
            <a href="https://mos.m.taobao.com/activity_newer?from=pub&pid=mm_46591525_34308672_311396917" target="_blank">
              <img src="/img/pc/laxin.jpg" width="100%" alt="">
            </a>
          </p>
        </div>
        <div role="tabpane2" class="tab-pane fade in" id="banner-right-two" aria-labelledby="banner-right-two-tab">
          <p>
            <!-- <a href="#" target="_blank"> -->
              <img src="/img/about/qcode_public_239_239.png" width="100%" alt="">
            <!-- </a> -->
          </p>
        </div>
        <div role="tabpane3" class="tab-pane fade in" id="banner-right-three" aria-labelledby="banner-right-three-tab">
          <p>
            <!-- <a href="#" target="_blank"> -->
              <img src="/img/about/qcode_person_239_239.png" width="100%" alt="">
            <!-- </a> -->
          </p>
        </div>
        <div role="tabpane4" class="tab-pane fade in" id="banner-right-four" aria-labelledby="banner-right-four-tab">
          <p>
            <!-- <a href="#" target="_blank"> -->
              <img src="/img/about/qcode_website_239_239.png" width="100%" alt="">
            <!-- </a> -->
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
