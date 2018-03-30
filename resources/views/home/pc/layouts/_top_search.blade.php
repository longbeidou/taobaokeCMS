<div class="row" id="top">
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <a href="/">
          <img src="/img/pc/logolist.png" alt="">
        </a>
      </div>
      <div class="col-sm-6">
        <div class="row">
          <div class="col-sm-12 form">
            <form class="" action="#" method="get">
              <div class="col-sm-9 input">
                <input type="text" name="search" class="form-control" placeholder="请输入要搜索的商品">
              </div>
              <div class="col-sm-3 text-center submit">
                <button type="submit" class="btn">搜索商品</button>
              </div>
            </form>
          </div>
          <div class="col-sm-12 searchword">
            <ul class="list-inline">
              <strong>热门搜索：</strong>
              @include('home.pc.layouts._search_keywords')
            </ul>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="row text-center">
          <div class="col-sm-4 topimg">
            <div class="imgdiv"><img src="/img/pc/top01.png" alt=""></div>
            <div class="text-center">
              <p>100%人工审核</p>
            </div>
          </div>
          <div class="col-sm-4 topimg">
            <div class="imgdiv"><img src="/img/pc/top02.png" alt=""></div>
            <div class="text-center">
              <p>实时维护排查</p>
            </div>
          </div>
          <div class="col-sm-4 topimg">
            <div class="imgdiv"><img src="/img/pc/top03.png" alt=""></div>
            <div class="text-center">
              <p>全天持续上新</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
