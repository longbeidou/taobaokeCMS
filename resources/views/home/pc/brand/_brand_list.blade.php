<!-- 品牌的列表 开始 -->
<div class="container" id="brand-category-list">
  @foreach($brands as $key => $brand)
    @if($id != $brand['id'])
    <div class="row title">
      <div class="col-sm-6">
        {{ $brand['brand_category_name']}}
      </div>
      <div class="col-sm-6 text-right">
        <a href="{{ route('home.brands', $brand['id']) }}">更多</a>
      </div>
    </div>
    @endif
  <div class="row content">
      <div class="row" style="padding: 0px 10px;">
        @foreach($brand['brands'] as $brand)
        <div class="col-sm-2" style="padding-left: 0px; padding-right: 0px;">
          <div class="brand-box" style="margin-bottom: 10px;">
            <a href="#" target="_blank">
              <div class="img-box" style="height: 101px; overflow: hidden;">
                <img src="{{ $brand->image }}" alt="{{ $brand->name }}">
              </div>
              <h5 class="text-center" style="margin-bottom: 0px;">{{ $brand->name }}<small><span style="color: #777;">(共{{ $brand->total }}个商品)</span></small></h5>
            </a>
          </div>
        </div>
        @endforeach
      </div>
  </div>
  @endforeach
</div>
<!-- 品牌的列表 结束 -->
