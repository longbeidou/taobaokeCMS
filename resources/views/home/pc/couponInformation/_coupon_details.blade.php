<div class="container" id="goods-details">
  <div class="row">
    <div class="col-sm-12 i-title" onclick="getCouponInfo()">
      <h3>商品详情 <small>（点击查看）</small> <span class="pull-right glyphicon glyphicon-chevron-down"></span></h3>
    </div>
  </div>
  <div class="row" style="background-color: #fff">
    <div class="col-sm-10 col-sm-offset-1 i-content" id="couponInfoDetails"></div>
  </div>
</div>

<!-- 获取详情 -->
<script type="text/javascript">
  function getCouponInfo() {
    var str = document.getElementById('couponInfoDetails').innerHTML;

    if (str == '') {
      getCouponInfoByAjax();
      $("#goods-details h3 small").text("（点击隐藏）");
      $("#goods-details h3 span").addClass("glyphicon-chevron-up");
      $("#goods-details h3 span").removeClass("glyphicon-chevron-down");
    } else {
      if (str == '加载失败，请稍后重试...' ) {
        getCouponInfoByAjax();
      } else {
        $("#goods-details h3 small").text("（点击显示）");
        $("#goods-details h3 span").addClass("glyphicon-chevron-down");
        $("#goods-details h3 span").removeClass("glyphicon-chevron-up");
        document.getElementById('couponInfoDetails').innerHTML = '';
      }
    }
  };

  function getCouponInfoByAjax() {
    $.ajax({
      url : "{{ route('couponItemInfo.index', $couponInfo->goods_id) }}",
      async : true,
      success : function(data) {
        var jsonData = JSON.parse(data);
        if(jsonData.status == 'ok') {
          document.getElementById('couponInfoDetails').innerHTML = jsonData.content;
        } else {
          document.getElementById('couponInfoDetails').innerHTML = "加载失败，请稍后重试...";
        }
      },
      error:function(xhr,type,errorThrown){
        //异常处理；
        console.log(type);
      }
    });
  }
</script>
