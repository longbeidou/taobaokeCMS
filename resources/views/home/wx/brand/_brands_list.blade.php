@foreach($brands as $brand)
<li class="mui-table-view-cell mui-media mui-col-xs-4">
    <a href="{{ route('home.brandCoupons', $brand->id) }}">
        <img class="mui-media-object" src="{{ $brand->image }}">
        <div class="mui-media-body">
          <p style="white-space: normal; max-height: 30px; overflow: hidden;">{{ $brand->name }}</p>
        </div>
    </a>
</li>
@endforeach
