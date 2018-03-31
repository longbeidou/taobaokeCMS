<nav class="container-fluid" id="nav_tab">
  <div class="row">
    <div class="container">
      <div class="col-sm-3 text-center home">
        <a href="/">
          <span class="glyphicon glyphicon-th-list"></span> 每日新品
        </a>
      </div>
      <div class="col-sm-9 nav">
        <ul class="list-inline">
          <li><a href="/" target="_blank">首页</a></li>
          @foreach($categorys as $category)
          <li><a href="{{ $category['link'] }}" target="-_blank">{{ $category['name'] }}</a></li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</nav>
