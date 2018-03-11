<form action="{{ route('home.coupon.search') }}" method="get">
  <div class="mui-input-row mui-search">
      <input type="search" name="search" value="{{ $oldRequest['search'] or '' }}" id="search" required class="mui-input-clear" placeholder="请输入要搜索的商品名称,多条件用空格隔开。">
  </div>
</form>
<script  type="text/javascript" charset="utf-8">
  function plusReady(){
      document.getElementById("search").addEventListener("keydown",function(e){
          if(13 == e.keyCode){ //点击了“搜索”
             document.activeElement.blur();//隐藏软键盘
          }
      },false);
  }
</script>
