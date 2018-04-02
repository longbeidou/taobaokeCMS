<?php
  $num = $paginaton['count'] / $paginaton['page_size'];
  $num = $num > 200 ? 201 : $num;
  $beginAndEnd = [1,2,$num-1,$num];
?>
@if($num > 0)
<ul class="pagination">
    @if($paginaton['page'] == 1)
    <li class="disabled"><span>«</span></li>
    @else
    <li><a href="{{ route('home.superSearch.resultJuPC')}}?search={{ $oldRequest['search'] }}&page={{ $paginaton['page']-1 }}" rel="prev">«</a></li>
    @endif

    @for($i = 1; $i < $num+1; $i++)
        @if($paginaton['page'] == $i)
        <li class="active"><span>{{ $paginaton['page'] }}</span></li>
        @else
          @if(in_array($i, $beginAndEnd))
          <li><a href="{{ route('home.superSearch.resultJuPC')}}?search={{ $oldRequest['search'] }}&page={{ $i }}">{{ $i }}</a></li>
          @endif
          @if( ($i < $paginaton['page'] + 4 && $i > $paginaton['page'] - 4) && !(in_array($i, $beginAndEnd)) )
          <li><a href="{{ route('home.superSearch.resultJuPC')}}?search={{ $oldRequest['search'] }}&page={{ $i }}">{{ $i }}</a></li>
          @endif
          @if($i == $paginaton['page'] + 4 || $i == $paginaton['page'] - 4)
          <li class="disabled"><span>...</span></li>
          @endif
        @endif
    @endfor

    @if($paginaton['page'] == $num+1 || $paginaton['page'] == 201 || $paginaton['page'] * $paginaton['page_size'] == $paginaton['count'])
    <li class="disabled"><span>»</span></li>
    @else
    <li><a href="{{ route('home.superSearch.resultJuPC')}}?search={{ $oldRequest['search'] }}&page={{ $paginaton['page']+1 }}" rel="next">»</a></li>
    @endif
</ul>
@endif
