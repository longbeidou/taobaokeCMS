<ul class="mui-table-view mui-grid-view mui-grid-9" style="background-color:#fff;">
  @foreach($categorys as $category)
  <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3">
      <a class="a-can-do" href="{{ $category['link'] }}">
          <!-- <img src="{{ $category['image_small'] }}" width="41px" height="41px" alt="" /> -->
          {!! $category['font_icon'] !!}
          <div class="mui-media-body">{{ $category['name'] }}</div>
      </a>
  </li>
  @endforeach
<!-- <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3">
    <a href="#">
        <span class="mui-icon mui-icon-email"><span class="mui-badge mui-badge-red">5</span></span>
        <div class="mui-media-body">Email</div>
    </a>
</li> -->
</ul>
<div style="width: 100%; height: 10px;"></div>
