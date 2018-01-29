@foreach($coupons as $coupon)
<tr>
    <td>
        <input type="checkbox" checked class="i-checks-notuse checkboxstyle" name="ids[]" value="{{ $coupon['id'] }}">
    </td>
    <td><img src="{{ $coupon['image'] }}" width="70px" /></td>
    <td style="max-width:200px;">
      <a href="{{ $coupon['goods_info_link'] }}" target="_blank">
      {{ $coupon['goods_name'] }}
      </a>
    </td>
    <td style="max-width:100px;">{{ $coupon['category'] }}</td>
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
      <a href="{{ route('admin.coupons.deleteById', $coupon['id']) }}"><i title="删除" class="fa fa-close text-danger"></i></a> |
      @if($coupon['is_recommend'] == 0)
      <a href="{{ route('admin.coupons.recommendById', $coupon['id']) }}"><i title="推荐商品" class="fa fa-thumbs-up text-navy"></i></a> |
      @endif
      @if($coupon['is_recommend'] == 1)
      <a href="{{ route('admin.coupons.notRecommendById', $coupon['id']) }}"><i title="取消推荐" class="fa fa-thumbs-down text-danger"></i></a> |
      @endif
      @if($coupon['is_show'] == 0)
      <a href="{{ route('admin.coupons.showById', $coupon['id']) }}"><i title="前台显示商品" class="fa fa-toggle-on text-navy"></i></a> |
      @endif
      @if($coupon['is_show'] == 1)
      <a href="{{ route('admin.coupons.notShowById', $coupon['id']) }}"><i title="取消前台商品显示" class="fa fa-toggle-off text-danger"></i></a>
      @endif
    </td>
</tr>
@endforeach
