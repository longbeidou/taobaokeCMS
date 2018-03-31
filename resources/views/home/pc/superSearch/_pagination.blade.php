<?php
  $num = $paginaton['count'] / $paginaton['page_size'];
?>
@if($num > 0)
<ul class="pagination">
    @if($paginaton['page'] == 1)
    <li class="disabled"><span>«</span></li>
    @else
    <li><a href="{{ route('home.superSearch.resultPC')}}?search={{ $oldRequest['search'] }}&page={{ $paginaton['page']-1 }}" rel="prev">«</a></li>
    @endif

    @for($i = 1; $i < $num+1; $i++)
        @if($paginaton['page'] == $i)
        <li class="active"><span>{{ $paginaton['page'] }}</span></li>
        @else
        <li><a href="{{ route('home.superSearch.resultPC')}}?search={{ $oldRequest['search'] }}&page={{ $i }}">{{ $i }}</a></li>
        @endif
    @endfor

    @if($paginaton['page'] == $num+1 || $paginaton['page'] * $paginaton['page_size'] == $paginaton['count'])
    <li class="disabled"><span>»</span></li>
    @else
    <li><a href="{{ route('home.superSearch.resultPC')}}?search={{ $oldRequest['search'] }}&page={{ $paginaton['page']+1 }}" rel="next">»</a></li>
    @endif
</ul>
@endif
