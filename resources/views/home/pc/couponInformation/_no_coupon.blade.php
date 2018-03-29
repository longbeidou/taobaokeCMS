

<div class="container-fluid" id="model" onclick="closeMode()" style="display: none; position: fixed; top: 0px; left: 0px; width: 100%; height: 100%; background-color: rgba(0,0,0,.75); z-index: 1000;">
    <div style="margin: 150px auto; width: 300px;  background-color: #fff; border-radius: 10px; padding: 15px;">
      <div class="row">
        <div class="col-sm-12" style="margin-bottom: 20px;">
          <p style="font-size: 18px;">抱歉！您来晚了一步，优惠券已经被领取完了。</p>
        </div>
        <div class="col-sm-12 text-center">
          <button onclick="closeMode()" type="button" class="btn btn-danger" name="button">关闭</button>
        </div>
      </div>
    </div>
</div>
<script type="text/javascript">
  function closeMode()
  {
     document.getElementById('model').style.display = 'none';
  }

  function showMode()
  {
     document.getElementById('model').style.display = 'block';
  }

  window.onload = function () {
    if(!{{ $couponCountInfo->coupon_total_count }}) {
      showMode()
    }
  }
</script>
