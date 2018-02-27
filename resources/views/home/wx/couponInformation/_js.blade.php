<script type="text/javascript">
//		分享
  function share(){
    document.getElementById('zheZhao').style.display = 'block';
    document.getElementById('shareInfo').style.display = 'block';
  }
//		淘口令
  function taoKouLing(){
    document.getElementById('zheZhao').style.display = 'block';
    document.getElementById('taoKouLingInfo').style.display = 'block';
  }
//		客服
  function keFu(){
    document.getElementById('zheZhao').style.display = 'block';
    document.getElementById('keFuInfo').style.display = 'block';
  }
//		关闭遮罩层
  function shareClose(){
    document.getElementById('zheZhao').style.display = 'none';
    document.getElementById('shareInfo').style.display = 'none';
    document.getElementById('taoKouLingInfo').style.display = 'none';
    document.getElementById('keFuInfo').style.display = 'none';
    document.getElementById('noCoupon').style.display = 'none';
    document.getElementById('noCouponZheZhao').style.display = 'none';
        document.getElementById('kouLingBtn').innerHTML = "一键复制";
        document.getElementById('kouLingDivBtn').style.backgroundColor = "#ed2a7a";
        document.getElementById('shareBtn').innerHTML = "复制文案，分享给朋友";
        document.getElementById('shareDivBtn').style.backgroundColor = "#EC971F";
  }
</script>

<!--解决复制的问题-->
<script src="https://cdn.jsdelivr.net/npm/clipboard@1/dist/clipboard.min.js"></script>
<!--复制分享的文案-->
  <script>
    var clipboard = new Clipboard('.shareCodeBtn');

    clipboard.on('success', function(e) {
        console.log(e);
        document.getElementById('shareBtn').innerHTML = "复制成功";
        document.getElementById('shareDivBtn').style.backgroundColor = "green";
    });

    clipboard.on('error', function(e) {
        console.log(e);
        document.getElementById('shareBtn').innerHTML = "复制失败，请手动复制";
        document.getElementById('shareDivBtn').style.backgroundColor = "red";
    });
  </script>
<!--复制淘口令-->
  <script>
    var clipboard = new Clipboard('.kouLingBtn');

    clipboard.on('success', function(e) {
        console.log(e);
        document.getElementById('kouLingBtn').innerHTML = "复制成功";
        document.getElementById('kouLingDivBtn').style.backgroundColor = "green";
    });

    clipboard.on('error', function(e) {
        console.log(e);
        document.getElementById('kouLingBtn').innerHTML = "复制失败";
        document.getElementById('kouLingDivBtn').style.backgroundColor = "red";
    });
  </script>
