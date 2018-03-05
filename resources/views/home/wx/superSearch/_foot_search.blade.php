<form class="" action="{{ route('home.superSearch.result') }}" method="post">
  {{ csrf_field() }}
<nav class="mui-bar mui-bar-tab" style="height: 80px; background-color: #FFFFFF;">
  <div style="float: left; height: 80px; width: 80%; padding: 5px;">
    <textarea name="q" required placeholder="粘贴淘宝APP的分享内容到这里" rows="" cols="" style="width: 100%; height: 100%; border: 3px solid #ed2a7a; font-size: 16px; background-color: #efefef;"></textarea>
  </div>
  <div style="float: left; height: 80px; width: 20%; text-align: center; padding:5px;">
    <button type="submit" style="font-size: 20px; width: 100%; height: 100%; background-color: #ed2a7a; color: #FFFFFF; font-weight: 800; border-width: 0px;">搜索</butto>
  </div>
</nav>
</form>
