<div class="container" id="category-list">
  <div class="row">
    <div class="container">
      <ul class="list-inline">
        <?php
          if ($id == null) {
            $active = 'active';
          } else {
            $active = '';
          }
        ?>
        <li class="{{ $active }}"><a href="{{ route('home.brands') }}">全部</a></li>
        @foreach($AllBrandCategorys as $brandCategory)
          <?php
            if ($id == $brandCategory->id) {
              $active = 'active';
            } else {
              $active = '';
            }
          ?>
        <li class="{{ $active }}"><a href="{{ route('home.brands', $brandCategory->id) }}">{{ $brandCategory->name }}</a></li>
        @endforeach

      </ul>
    </div>
  </div>
</div>
