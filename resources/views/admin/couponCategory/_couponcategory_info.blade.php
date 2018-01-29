@foreach($couponCategorys as $couponCategory)
<tr>
    <td>
       <input type="checkbox"   name="ids[]" value="{{ $couponCategory->id }}" style="width:20px; height:20px; " checked>
    </td>
    <td>
      <input type="number" min="0" max="99" step="1" name="order[{{ $couponCategory->id }}]" value="{{ $couponCategory->order }}" />
    </td>
    <td><a href="#" target="_blank">{{ $couponCategory->category_name }}</a></td>
    <td><img src="{{ $couponCategory->imgage_small }}" height="30px" /></td>
    <td class="text-center" style="color:">133</td>
    <td>{{ $couponCategory->self_where }}</td>
    <td class="text-center">
      @if($couponCategory->is_show == '1')
         <span style="color:green;">是</span>
      @else
         <span style="color:red;">否</span>
      @endif
    </td>
    <td class="text-center">
        <a href="{{ route('couponCategorys.edit', $couponCategory->id) }}"><i class="fa fa-edit text-navy"  style="color:green;"></i> 编辑</a> |
        <a href="{{ route('couponCategorys.edit', $couponCategory->id) }}"><i class="fa fa-close text-navy"  style="color:red;"></i> 删除</a> |
        <a href="{{ route('couponCategorys.edit', $couponCategory->id) }}"><i class="fa fa-arrow-down text-navy"  style="color:red;"></i> 取消显示</a>
    </td>
</tr>
@endforeach
