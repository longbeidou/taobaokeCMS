<!--解决复制的问题-->
<div class="mui-row">
  <div class="mui-col-xs-12" style="text-align: center; margin: 10px 0px 5px;">
  </div>
  <!--图片-->
  <div class="mui-col-xs-12">
    <a class="a-can-do" href="#">
      <div class="mui-row" style="padding-right: 10px;">
        <div class="mui-col-xs-2" style="padding: 3px 3px 3px 5px;">
          <img src="/img/logo.jpg" height="40px" style="border-radius: 20px;" alt="" />
        </div>
        <div class="mui-col-xs-9" style="position: relative; background-color: #FFFFFF; min-height: 40px; padding: 5px; border-radius: 10px; margin-bottom: 10px;">
          <div class="dialogue-triangle"></div>
          <div style="text-align: center; padding: 5px;">
              @foreach ($errors->all() as $error)
              <p>{{ $error }}</p>
              @endforeach
          </div>
        </div>
      </div>
    </a>
  </div>
</div>
