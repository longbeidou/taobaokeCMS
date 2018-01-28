<form action="{{ route('admin.coupons.index') }}" method="get">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>优惠券搜索面板</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{ route('admin.coupons.index') }}?{{ $urlStr }}page_size=10&order={{ $oldRequest['order'] or '' }}">每页显示10条信息</a></li>
                        <li><a href="{{ route('admin.coupons.index') }}?{{ $urlStr }}page_size=20&order={{ $oldRequest['order'] or '' }}">每页显示20条信息</a></li>
                        <li><a href="{{ route('admin.coupons.index') }}?{{ $urlStr }}page_size=30&order={{ $oldRequest['order'] or '' }}">每页显示30条信息</a></li>
                        <li><a href="{{ route('admin.coupons.index') }}?{{ $urlStr }}page_size=40&order={{ $oldRequest['order'] or '' }}">每页显示40条信息</a></li>
                        <li><a href="{{ route('admin.coupons.index') }}?{{ $urlStr }}page_size=50&order={{ $oldRequest['order'] or '' }}">每页显示50条信息</a></li>
                        <li><a href="{{ route('admin.coupons.index') }}?{{ $urlStr }}page_size=100&order={{ $oldRequest['order'] or '' }}">每页显示100条信息</a></li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
              <div class="row">
                  <div class="col-sm-4 ">
                      <strong>平台:</strong>
                      <div data-toggle="buttons" class="btn-group">
                          <label class="btn btn-sm btn-white   @if(empty($flat)  || $flat == 'all')    active   @endif">
                              <input type="radio" id="option1" @if(empty($flat)  || $flat == 'all')    checked  @endif name="flat" value="all">全部</label>
                          <label class="btn btn-sm btn-white   @if(!empty($flat) && $flat == 'taobao') active   @endif">
                              <input type="radio" id="option2" @if(!empty($flat) && $flat == 'taobao') checked  @endif name="flat" value="taobao">淘宝</label>
                          <label class="btn btn-sm btn-white   @if(!empty($flat) && $flat == 'tmall')  active   @endif">
                              <input type="radio" id="option3" @if(!empty($flat) && $flat == 'tmall')  checked  @endif name="flat" value="tmall">天猫</label>
                      </div>
                  </div>
                  <div class="col-sm-4 ">
                      <strong>是否推荐:</strong>
                      <div data-toggle="buttons" class="btn-group">
                          <label class="btn btn-sm btn-white   @if(empty($is_recommend)  || $is_recommend == 'all') active  @endif">
                              <input type="radio" id="option1" @if(empty($is_recommend)  || $is_recommend == 'all') checked @endif name="is_recommend" value="all">全部</label>
                          <label class="btn btn-sm btn-white   @if(!empty($is_recommend) && $is_recommend == 'yes') active  @endif">
                              <input type="radio" id="option2" @if(!empty($is_recommend) && $is_recommend == 'yes') checked @endif name="is_recommend" value="yes">是</label>
                          <label class="btn btn-sm btn-white   @if(!empty($is_recommend) && $is_recommend == 'no')  active  @endif">
                              <input type="radio" id="option3" @if(!empty($is_recommend) && $is_recommend == 'no')  checked @endif name="is_recommend" value="no">否</label>
                      </div>
                  </div>
                  <div class="col-sm-4 ">
                      <strong>是否显示:</strong>
                      <div data-toggle="buttons" class="btn-group">
                          <label class="btn btn-sm btn-white   @if(empty($is_show)  || $is_show == 'all') active  @endif">
                              <input type="radio" id="option1" @if(empty($is_show)  || $is_show == 'all') checked @endif name="is_show" value="all">全部</label>
                          <label class="btn btn-sm btn-white   @if(!empty($is_show) && $is_show == 'yes') active  @endif">
                              <input type="radio" id="option2" @if(!empty($is_show) && $is_show == 'yes') checked @endif name="is_show" value="yes">是</label>
                          <label class="btn btn-sm btn-white   @if(!empty($is_show) && $is_show == 'no')  active  @endif">
                              <input type="radio" id="option3" @if(!empty($is_show) && $is_show == 'no')  checked @endif name="is_show" value="no">否</label>
                      </div>
                  </div>

              	<div class="col-sm-4">
                  	<div class="form-inline">
                  		<strong>原价:</strong>
                          <div class="form-group">
                              <input type="number" min="0.0" max="10000" step="0.01" placeholder="最小值" name="price_min" value="{{ $price_min or '' }}" class="form-control input-sm">
                          </div>
                          <div class="form-group">
                              <input type="number" min="0.0" max="10000" step="0.01" placeholder="最大值" name="price_max" value="{{ $price_max or '' }}" class="form-control input-sm">
                          </div>
                      </div>
              	</div>
              	<div class="col-sm-4">
                  	<div class="form-inline">
                  		<strong>现价:</strong>
                          <div class="form-group">
                              <input type="number" min="0.0" max="10000" step="0.01" placeholder="最小值" name="price_now_min" value="{{ $price_now_min or '' }}" class="form-control input-sm">
                          </div>
                          <div class="form-group">
                              <input type="number" min="0.0" max="10000" step="0.01" placeholder="最大值" name="price_now_max" value="{{ $price_now_max or '' }}" class="form-control input-sm">
                          </div>
                      </div>
              	</div>
              	<div class="col-sm-4">
                  	<div class="form-inline">
                  		<strong>佣金:</strong>
                          <div class="form-group">
                              <input type="number" min="0.0" max="999" step="0.01" placeholder="最小值" name="money_min" value="{{ $money_min or '' }}" class="form-control input-sm">
                          </div>
                          <div class="form-group">
                              <input type="number" min="0.0" max="999" step="0.01" placeholder="最大值" name="money_max" value="{{ $money_max or '' }}" class="form-control input-sm">
                          </div>
                      </div>
              	</div>
              	<div class="col-sm-4">
                  	<div class="form-inline">
                  		<strong>销量:</strong>
                          <div class="form-group">
                              <input type="number" min="0" max="999999" step="1" placeholder="最小值" name="sales_min" value="{{ $sales_min or '' }}" class="form-control input-sm">
                          </div>
                          <div class="form-group">
                              <input type="number" min="0" max="999999" step="1" placeholder="最大值" name="sales_max" value="{{ $sales_max or '' }}" class="form-control input-sm">
                          </div>
                      </div>
              	</div>
                  <div class="col-sm-4">
                      <div class="form-inline">
                          <strong>优惠比:</strong>
                          <div class="form-group">
                              <input type="number" min="0.0" max="1" step="0.01" placeholder="最小值" name="rate_sales_min" value="{{ $rate_sales_min or '' }}" class="form-control input-sm">
                          </div>
                          <div class="form-group">
                              <input type="number" min="0.0" max="1" step="0.01" placeholder="最大值" name="rate_sales_max" value="{{ $rate_sales_max or '' }}" class="form-control input-sm">
                          </div>
                      </div>
                  </div>
                  <input type="hidden" name="page_size" value="{{ $oldRequest['page_size'] or '' }}">
                  <div class="col-sm-4">
                  	<div class="form-inline">
                          <div class="form-group">
                          	<strong>商品:</strong>
                              <input type="text" placeholder="请输入商品信息" class="input-sm form-control" name="goods_name" value="{{ $goods_name or '' }}">
                              <button type="submit" class="btn btn-sm btn-primary" style="float:right;"> 搜 索</button>
                          </div>
                  	</div>
                  </div>
              </div>
            </div>
        </div>
    </div>
</div>
</form>
