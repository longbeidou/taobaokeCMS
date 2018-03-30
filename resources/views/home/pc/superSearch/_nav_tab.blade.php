<div class="row category" style="margin-top: 64px; background-color: #ed2a7a; padding-top: 10px; padding-bottom: 10px;">
  <div class="col-sm-11 col-sm-offset-1">
    <ul class="list-inline">
      <li><a href="/" target="_blank">首页</a></li>
      @foreach($categorys as $category)
      <li><a href="{{ $category['link'] }}" target="_blank">{{ $category['name'] }}</a></li>
      @endforeach
    </ul>
  </div>
</div>
