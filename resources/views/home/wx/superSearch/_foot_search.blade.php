<form class="" action="{{ route('home.superSearch.result') }}" method="post">
  {{ csrf_field() }}
<nav class="mui-bar mui-bar-tab" style="height: 80px; background-color: #FFFFFF;">
  <div style="float: left; height: 80px; width: 80%; padding: 5px;">
    <textarea name="q" required placeholder="请粘贴含有淘口令的信息或者商品的标题到这里" rows="" cols="" style="width: 100%; height: 100%; border: 3px solid #ed2a7a; font-size: 16px; background-color: #efefef;"></textarea>
  </div>
  <div style="float: left; height: 80px; width: 20%; text-align: center; padding:5px 5px 5px 0px;">
    <div style="width: 100%; height: 100%; background-color: #ed2a7a; color: #FFFFFF; font-weight: 800; border-width: 0px;">
      <button type="submit" style="display:block; padding: 0px; font-size: 28px; width: 100%; border: 0px; height: 35px; padding: 12px 0px 0px 0px; color: #fff; background-color:transparent;" class="mui-icon mui-icon-search"></button>
      <button type="submit" style="display:block; padding: 0px; font-size: 16px; width: 100%; border: 0px; height: 35px; padding: 0px 0px 12px 0px; color: #fff; background-color:transparent;">搜索</button>
    </div>
  </div>
</nav>
</form>
