<div class="mui-input-row mui-search">
    <input type="search" name="wd" id="search" class="mui-input-clear" placeholder="请输入要搜索的商品名称,多条件用空格隔开。">
</div>
<script  type="text/javascript" charset="utf-8">
mui.plusReady(function() {
      var search = document.getElementById("search");
  //              监听input框键盘事件
      search.addEventListener("keypress", function(e) {
          console.log(e.keyCode);
          var ad = search.value;
    //                  当e.keyCode的值为13 即，点击前往/搜索 按键时执行以下操作
          if(e.keyCode == 13) {
              mui.openWindow({
                  url: "https://www.baidu.com/s?wd=",//跳转地址
                  id:"search",//id
                  show: {
                      aniShow: "slide-in-right",//页面显示动画，默认为”slide-in-right“；
                      duration: 300,//页面动画持续时间，Android平台默认100毫秒，iOS平台默认200毫秒
                      autoShow: true //页面loaded事件发生后自动显示，默认为true
                  },
                   extras:{
                    text1:ad//自定义扩展参数，可以用来处理页面间传值
                  },
                  waiting: {
                      title: '正在玩命搜索...'//等待对话框上显示的提示内容
                  }
              })
          }
      });
  });
</script>
