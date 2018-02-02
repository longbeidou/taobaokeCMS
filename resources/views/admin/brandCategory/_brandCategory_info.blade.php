@foreach($brandCategorys as $brandCategory)
<tr>
    <td>
       <input type="checkbox"   name="ids[]" value="{{ $brandCategory->id }}" style="width:20px; height:20px; " checked>
    </td>
    <td>
      <input type="number" min="0" max="99" step="1" name="order[{{ $brandCategory->id }}]" value="{{ $brandCategory->order }}" />
    </td>
    <td><a href="#" target="_blank">{{ $brandCategory->name }}</a></td>
    <td>{{ $brandCategory->total }}</td>
    <td>{{ $brandCategory->font_icon }}</td>
    <td class="text-center">
      @if($brandCategory->is_show == '1')
         <span style="color:green;">显示</span>
      @else
         <span style="color:red;">不显示</span>
      @endif
    </td>
    <td class="text-left">
        <a href="{{ route('brands.edit', $brandCategory->id) }}"><i class="fa fa-edit text-navy" title="编辑" style="color:green;"></i></a> |
        <a href="{{ route('brands.delete', $brandCategory->id) }}"><i class="fa fa-close text-navy" title="删除" style="color:red;"></i></a> @if($brandCategory->is_show == 1) |
        <a href="{{ route('brands.notShow', $brandCategory->id) }}"><i class="fa fa-toggle-off text-navy" title="取消显示" style="color:red;"></i></a> | @endif
        @if($brandCategory->is_show == 0) |
        <a href="{{ route('brands.isShow', $brandCategory->id) }}"><i class="fa fa-toggle-on text-navy" title="设置显示" style="color:green;"></i></a> |
        @endif
        <a href="{{ route('brands.show', $brandCategory->id) }}"><i class="fa fa-info-circle text-navy" title="查看详情" style="color:green;"></i></a>
    </td>
</tr>
@endforeach
