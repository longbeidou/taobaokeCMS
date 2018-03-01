@if ($paginator->hasPages())
    <ul class="mui-pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="mui-disabled"><span>首页</span></li>
            <li class="mui-disabled"><span>上一页</span></li>
        @else
            <li><a class="a-can-do" href="{{ $elements[0][1] }}" rel="prev">首页</a></li>
            <li><a class="a-can-do" href="{{ $paginator->previousPageUrl() }}" rel="prev">上一页</a></li>
        @endif

        <?php
            $e = end($elements);
            $lastUrl = end($e);
        ?>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a class="a-can-do" href="{{ $paginator->nextPageUrl() }}" rel="next">下一页</a></li>
            <li><a class="a-can-do" href="{{ $lastUrl }}" rel="next">末页</a></li>
        @else
            <li class="mui-disabled"><span>下一页</span></li>
            <li class="mui-disabled"><span>末页</span></li>
        @endif
    </ul>
@endif
