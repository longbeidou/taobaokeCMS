@foreach($banners as $banner)
<tr>
    <td>
       <input type="checkbox"   name="ids[]" value="{{ $banner->id }}" style="width:20px; height:20px; " checked>
    </td>
    <td>
      <input type="number" min="0" max="99" step="1" name="order[{{ $banner->id }}]" value="{{ $banner->order }}" />
    </td>
    <td>{{ $banner->name }}</td>
    <td class="text-center">{{ $banner->link }}</td>
    <td class="text-center">
      <a href="{{ $banner->image }}" target="_blank">
        <img class="img-thumbnail" src="{{ $banner->image }}" style="height:41px;" />
      <a>
    </td>
    <td class="text-center">
      @if($banner->flat == 'wx')
      <span class="text-info">移动端展示</span>
      @else
      <span class="text-danger">PC端展示</span>
      @endif
    </td>
    <td class="text-center">
      @if($banner->is_show == '1')
         <span style="color:green;">显示</span>
      @else
         <span style="color:red;">不显示</span>
      @endif
    </td>
    <td class="text-center">
        <a href="{{ route('banners.edit', $banner->id) }}"><i class="fa fa-edit text-navy" title="编辑" style="color:green;"></i></a> |
        <a href="{{ route('banners.delete', $banner->id) }}"><i class="fa fa-close text-navy" title="删除" style="color:red;"></i></a> @if($banner->is_show == 1) |
        <a href="{{ route('banners.notShow', $banner->id) }}"><i class="fa fa-toggle-off text-navy" title="取消显示" style="color:red;"></i></a> | @endif
        @if($banner->is_show == 0) |
        <a href="{{ route('banners.isShow', $banner->id) }}"><i class="fa fa-toggle-on text-navy" title="设置显示" style="color:green;"></i></a> |
        @endif
        <a href="{{ route('banners.show', $banner->id) }}"><i class="fa fa-info-circle text-navy" title="查看详情" style="color:green;"></i></a>
    </td>
</tr>
@endforeach
