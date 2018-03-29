<?php
  if ( empty($requestId) ) {
    $active = 'active';
  } else {
    $active = '';
  }
?>
<li class="{{ $active }}"><a href="{{ route('home.coupon') }}">全部</a></li>
@foreach($couponCategorys as $couponcate)
<?php
  if ($requestId == $couponcate->id) {
    $active = 'active';
  } else {
    $active = '';
  }
?>
<li class="{{ $active }}"><a href="{{ route('home.coupon', $couponcate->id) }}">{{ $couponcate->category_name }}</a></li>
@endforeach
