@foreach($brandCategorys as $brandCategory)
<tr>
  <input type="hidden" name="ids_all" value="{{ $brandCategory->id }}">
    <td>
       <input type="checkbox"   name="ids[]" value="{{ $brandCategory->id }}" style="width:20px; height:20px; " checked>
    </td>
    <td>
      <input type="number" min="0" max="99" step="1" name="order[{{ $brandCategory->id }}]" value="{{ $brandCategory->order }}" />
    </td>
    <td><a href="{{ route('home.brands', $brandCategory->id) }}" target="_blank">{{ $brandCategory->name }}</a></td>
    <td class="text-center">{{ $brandCategory->total }}</td>
    <td class="text-center">{!! $brandCategory->font_icon !!}</td>
    <td class="text-center">
      @if($brandCategory->is_show == '1')
         <span style="color:green;">显示</span>
      @else
         <span style="color:red;">不显示</span>
      @endif
    </td>
    <td class="text-center">
        <a href="{{ route('brandCategorys.edit', $brandCategory->id) }}"><i class="fa fa-edit text-navy" title="编辑" style="color:green;"></i></a> |
        <a href="{{ route('brandCategorys.delete', $brandCategory->id) }}"><i class="fa fa-close text-navy" title="删除" style="color:red;"></i></a> @if($brandCategory->is_show == 1) |
        <a href="{{ route('brandCategorys.notShow', $brandCategory->id) }}"><i class="fa fa-toggle-off text-navy" title="取消显示" style="color:red;"></i></a> | @endif
        @if($brandCategory->is_show == 0) |
        <a href="{{ route('brandCategorys.isShow', $brandCategory->id) }}"><i class="fa fa-toggle-on text-navy" title="设置显示" style="color:green;"></i></a> |
        @endif
        <a href="{{ route('brandCategorys.show', $brandCategory->id) }}"><i class="fa fa-info-circle text-navy" title="查看详情" style="color:green;"></i></a>
    </td>
</tr>
@endforeach
