<div class="container" id="home-brand">
  <div class="col-sm-12 brand-category">
    <div class="row">
      <div class="col-sm-4">
        <h4>天猫淘宝品牌优惠券大全<small>知名品牌优惠券免费领取</small></h4>
      </div>
      <div class="col-sm-8 ">
          <ul class="nav nav-tabs pull-right" role="tablist">
            @foreach($brandCategorys as $key=>$brandCategory)
              <?php $key += 1; ?>
              @if($key == 1)
              <li role="presentation" class="active"><a href="#banner{{$key}}" role="tab" data-toggle="tab" aria-controls="banner{{$key}}" aria-expanded="true">{{ $brandCategory->name }}</a></li>
              @else
              <li role="presentation" class=""><a href="#banner{{$key}}" role="tab" data-toggle="tab" aria-controls="banner{{$key}}" aria-expanded="false">{{ $brandCategory->name }}</a></li>
              @endif
            @endforeach
            <li role="presentation" class=""><a href="{{ route('home.brands') }}" target="-_blank">更多</a></li>
          </ul>
      </div>
    </div>
  </div>
  <div class="col-sm-12">
    <div class="tab-content brand-content">
      @foreach($brands as $key=>$brand)
        @if($key == 0)
        <div role="tabpanel" class="tab-pane fade active in" id="banner{{$key}}" aria-labelledby="home-tab">
          <ul class="list-inline">
            @foreach($brand as $b)
            <li><a href="{{ route('home.brandCoupons', $b->id) }}"><img src="{{ $b->image }}" alt="{{ $b->name }}" /></a></li>
            @endforeach
          </ul>
        </div>
        @else
        <div role="tabpanel" class="tab-pane fade" id="banner{{$key}}" aria-labelledby="profile-tab">
          <ul class="list-inline">
            @foreach($brand as $b)
            <li><a href="{{ route('home.brandCoupons', $b->id) }}"><img src="{{ $b->image }}" alt="{{ $b->name }}" /></a></li>
            @endforeach
          </ul>
        </div>
        @endif
      @endforeach
    </div>
  </div>
</div>
