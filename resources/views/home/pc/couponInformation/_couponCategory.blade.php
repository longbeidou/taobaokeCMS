<div class="container" id="category-list">
  <div class="row">
    <div class="container">
      <ul class="list-inline">

        <li class="active"><a href="{{ route('home.coupon') }}">全部</a></li>
        @foreach($couponCategorys as $couponcate)
        <li class=""><a href="{{ route('home.coupon', $couponcate->id) }}">{{ $couponcate->category_name }}</a></li>
        @endforeach

      </ul>
    </div>
  </div>
</div>
