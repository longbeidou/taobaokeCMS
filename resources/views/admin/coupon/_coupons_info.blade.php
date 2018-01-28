@foreach($coupons as $coupon)
<tr>
    <td>
        <input type="checkbox" checked class="i-checks-notuse checkboxstyle" name="input[]" value="{{ $coupons['id'] }}">
    </td>
    <td><img src="{{ $coupon['image'] }}" width="70px" /></td>
    <td style="max-width:200px;">
      <a href="{{ $coupon['goods_info_link'] }}" target="_blank">
      {{ $coupon['goods_name'] }}
      </a>
    </td>
    <td>{{ $coupon['category'] }}</td>
    <td>{{ $coupon['coupon_info'] }}</td>
    <td class="text-right">{{ $coupon['price'] }}</td>
    <td class="text-right">{{ $coupon['price_now'] }}</td>
    <td class="text-right">{{ $coupon['rate_sales'] }}%</td>
    <td class="text-right">{{ $coupon['money'] }}</td>
    <td class="text-right">{{ $coupon['sales'] }}</td>
    <td class="text-center">
      @if($coupon['flat'] == '天猫')
          <img src="/img/tmallicon.ico" />
      @else
          <img src="/img/taobaoicon.ico" />
      @endif
    </td>
    <td class="text-center">
      <a href="table_basic.html#"><i class="fa fa-check text-navy"></i></a>
      <a href="table_basic.html#"><i class="fa fa-check text-navy"></i></a>
    </td>
</tr>
@endforeach
