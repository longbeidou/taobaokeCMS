<?php
  if ( empty($oldRequest['order']) ) {
    $order = 'all';
  } else {
    $order = $oldRequest['order'];
  }
  $activeAll =
  $activeprice_now_up =
  $activeprice_now_down =
  $activesales_up =
  $activesales_down =
  $activerate_up =
  $activerate_down =
  $activetmall =
  $activetaobao = '';

  switch ($order) {
    case 'price_now_up':
      $activeprice_now_up = 'active';
      break;

    case 'price_now_down':
      $activeprice_now_down = 'active';
      break;

    case 'sales_up':
      $activesales_up = 'active';
      break;

    case 'sales_down':
      $activesales_down = 'active';
      break;

    case 'rate_up':
      $activerate_up = 'active';
      break;

    case 'rate_down':
      $activerate_down = 'active';
      break;

    case 'tmall':
      $activetmall = 'active';
      break;

    case 'taobao':
      $activetaobao = 'active';
      break;

    default:
      $activeAll = 'active';
      break;
  }
?>
<li class="{{ $activeAll }}"><a href="{{ $currentUrl }}">综合排序</a></li>
<li class="{{ $activeprice_now_up }}"  ><a href="{{ $currentUrl }}?order=price_now_up"  >价格升序</a></li>
<li class="{{ $activeprice_now_down }}"><a href="{{ $currentUrl }}?order=price_now_down">价格降序</a></li>
<li class="{{ $activesales_up }}"  ><a href="{{ $currentUrl }}?order=sales_up"  >销量升序</a></li>
<li class="{{ $activesales_down }}"><a href="{{ $currentUrl }}?order=sales_down">销量降序</a></li>
<li class="{{ $activerate_up }}"  ><a href="{{ $currentUrl }}?order=rate_up"  >优惠幅度升序</a></li>
<li class="{{ $activerate_down }}"><a href="{{ $currentUrl }}?order=rate_down">优惠幅度降序</a></li>
<li class="{{ $activetmall }}" ><a href="{{ $currentUrl }}?order=tmall" >天猫</a></li>
<li class="{{ $activetaobao }}"><a href="{{ $currentUrl }}?order=taobao">淘宝</a></li>
