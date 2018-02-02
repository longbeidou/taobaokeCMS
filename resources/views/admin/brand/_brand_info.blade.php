@foreach($brands as $brand)
<tr>
    <td>
       <input type="checkbox"   name="ids[]" value="{{ $brand->id }}" style="width:20px; height:20px; " checked>
    </td>
    <td>
      <input type="number" min="0" max="99" step="1" name="order[{{ $brand->id }}]" value="{{ $brand->order }}" />
    </td>
    <td><a href="#" target="_blank">{{ $brand->name }}</a></td>
    <td>{{ $brand->brand_category_id}}</td>
    <td class="text-center"><img src="{{ $brand->image_small }}" height="41px" /></td>
    <td>{{ $brand->keywords }}</td>
    <td class="text-center">
      @if($brand->is_show == '1')
         <span style="color:green;">显示</span>
      @else
         <span style="color:red;">不显示</span>
      @endif
    </td>
    <td class="text-left">
        <a href="{{ route('brands.edit', $brand->id) }}"><i class="fa fa-edit text-navy" title="编辑" style="color:green;"></i></a> |
        <a href="{{ route('brands.delete', $brand->id) }}"><i class="fa fa-close text-navy" title="删除" style="color:red;"></i></a> @if($brand->is_show == 1) |
        <a href="{{ route('brands.notShow', $brand->id) }}"><i class="fa fa-toggle-off text-navy" title="取消显示" style="color:red;"></i></a> | @endif
        @if($brand->is_show == 0) |
        <a href="{{ route('brands.isShow', $brand->id) }}"><i class="fa fa-toggle-on text-navy" title="设置显示" style="color:green;"></i></a> |
        @endif
        <a href="{{ route('brands.show', $brand->id) }}"><i class="fa fa-info-circle text-navy" title="查看详情" style="color:green;"></i></a>
    </td>
</tr>
@endforeach
