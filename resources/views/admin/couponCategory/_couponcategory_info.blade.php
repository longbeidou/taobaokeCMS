@foreach($couponCategorys as $couponCategory)
<tr>
    <td>
       <input type="checkbox"   name="ids[]" value="{{ $couponCategory->id }}" style="width:20px; height:20px; " checked>
    </td>
    <td>
      <input type="number" min="0" max="99" step="1" name="order[{{ $couponCategory->id }}]" value="{{ $couponCategory->order }}" />
    </td>
    <td><a href="#" target="_blank">{{ $couponCategory->category_name }}</a></td>
    <td><img src="{{ $couponCategory->imgage_small }}" height="41px" /></td>
    <td class="text-center" style="color:">{{ $goodsTotal[$couponCategory->id] }}</td>
    <td>{{ $couponCategory->self_where }}</td>
    <td class="text-center">
      @if($couponCategory->is_show == '1')
         <span style="color:green;">显示</span>
      @else
         <span style="color:red;">不显示</span>
      @endif
    </td>
    <td class="text-left">
        <a href="{{ route('couponCategorys.edit', $couponCategory->id) }}"><i class="fa fa-edit text-navy" title="编辑" style="color:green;"></i></a> |
        <a href="{{ route('couponCategorys.delete', $couponCategory->id) }}"><i class="fa fa-close text-navy" title="删除" style="color:red;"></i></a> @if($couponCategory->is_show == 1) |
        <a href="{{ route('couponCategorys.notShow', $couponCategory->id) }}"><i class="fa fa-toggle-off text-navy" title="取消显示" style="color:red;"></i></a> | @endif
        @if($couponCategory->is_show == 0) |
        <a href="{{ route('couponCategorys.isShow', $couponCategory->id) }}"><i class="fa fa-toggle-on text-navy" title="设置显示" style="color:green;"></i></a> |
        @endif
        <a href="{{ route('couponCategorys.show', $couponCategory->id) }}"><i class="fa fa-info-circle text-navy" title="查看详情" style="color:green;"></i></a>
    </td>
</tr>
@endforeach
