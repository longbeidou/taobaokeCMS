<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    @section('head')
    @show
    <script src="/wxstyle/js/mui.min.js"></script>
    <link href="/wxstyle/css/mui.min.css" rel="stylesheet"/>
    <link href="/wxstyle/css/main.css" rel="stylesheet"/>
    <!-- <link rel="stylesheet" href="/css/selfIcon/iconfont.css"> -->
    <link rel="stylesheet" href="//at.alicdn.com/t/font_581943_sm8m2avffrgdgqfr.css">
    <script type="text/javascript" charset="utf-8">
      	mui.init();
        window.onload = function(){
    			mui('.mui-scroll-wrapper').scroll({
    			deceleration: 0.0005 //flick 减速系数，系数越大，滚动速度越慢，滚动距离越小，默认值0.0006
    			});
    		}

    		// 监听tap事件，解决 a标签 不能跳转页面问题
    		mui(document).on('tap','.a-can-do',function(){
    		    var a = document.createElement('a');
    		    a = this.cloneNode(true);
    		    a.click();
    		})
    </script>
</head>
<body>
  @section('content')

  @show
</body>
</html>
