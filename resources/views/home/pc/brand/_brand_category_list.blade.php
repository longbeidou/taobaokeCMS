<div class="container" id="category-list">
  <div class="row">
    <div class="container">
      <ul class="list-inline">
        <li class=""><a href="{{ route('home.brands') }}"><strong>全部品牌</strong></a></li> /
        <?php
          if ($currentBrand->id == $currentBrandCategory->id) {
            $active = 'active';
          } else {
            $active = '';
          }
        ?>
        <li class="{{ $active }}"><a href="{{ route('home.brands', $currentBrandCategory->id) }}"><strong>{{ $currentBrandCategory->name }}</strong></a></li> /
        @foreach($brandCategoryList as $brandCategory)
          <?php
            if ($currentBrand->id == $brandCategory->id) {
              $active = 'active';
            } else {
              $active = '';
            }
          ?>
        <li class="{{ $active }}"><a href="{{ route('home.brandCoupons', $brandCategory->id) }}">{{ $brandCategory->name }}</a></li>
        @endforeach

      </ul>
    </div>
  </div>
</div>
