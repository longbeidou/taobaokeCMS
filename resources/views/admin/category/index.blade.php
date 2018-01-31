@extends('admin.layouts.fooTable.index')

@section('title', $title)
@section('headcss')

@stop
@section('content')
  @include('admin.layouts.table._tips')
  @include('admin.layouts.fooTable._errors')
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>商品栏目分类</h5>
                <div class="ibox-tools">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i> 每页显示信息数
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">每页显示5条信息</a></li>
                        <li><a href="#">每页显示10条信息</a></li>
                        <li><a href="#">每页显示15条信息</a></li>
                        <li><a href="#">每页显示20条信息</a></li>
                        <li><a href="#">每页显示25条信息</a></li>
                        <li><a href="#">每页显示30条信息</a></li>
                    </ul>
                </div>
            </div>
            <div class="ibox-content">
                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="10">
                    <thead>
                        <tr>
                            <th data-toggle="true">排序</th>
                            <th>栏目名称</th>
                            <th>字体图标</th>
                            <th>显示状态</th>
                            <th>导航小图片</th>
                            <th data-hide="all">魔方左侧大图片</th>
                            <th data-hide="all">魔方右侧正方形图片</th>
                            <th data-hide="all">魔方右侧长方形图片</th>
                            <th data-hide="all">PC端</th>
                            <th data-hide="all">移动端</th>
                            <th data-hide="all">微信端</th>
                            <th data-hide="all">QQ端</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @include('admin.category._content')
                    </tbody>
                    <tfoot>
                        <table class="table table-striped">
                          <tbody>
                            <tr class="info">
                              <td>
                                <span type="" class="btn btn-xs btn-info"    onclick="chk(1)">全选  </span>
                                <span type="" class="btn btn-xs btn-primary" onclick="chk(2)">反选  </span>
                                <span type="" class="btn btn-xs btn-success" onclick="chk(3)">全不选</span>
                                <span>|</span>
                                <button type="submit" class="btn btn-xs btn-info"    onclick="submitChoice(1)"><i class="fa fa-close text-navy" style="color:#fff;"></i> 删除选中</button>
                                <button type="submit" class="btn btn-xs btn-primary" onclick="submitChoice(2)"><i class="fa fa-hand-o-up text-navy" style="color:#fff;"></i> 修改排序</button>
                              </td>
                            </tr>
                          </tbody>
                        </table>

                        <div class="row text-center">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <li class="disabled"><span>&laquo;</span></li>
                                    <li class="active"><span>1</span></li>
                                    <li><a href="http://taobaokecms.test/admin/coupons?page=2">2</a></li>
                                    <li><a href="http://taobaokecms.test/admin/coupons?page=3">3</a></li>
                                    <li><a href="http://taobaokecms.test/admin/coupons?page=4">4</a></li>
                                    <li><a href="http://taobaokecms.test/admin/coupons?page=5">5</a></li>
                                    <li><a href="http://taobaokecms.test/admin/coupons?page=6">6</a></li>
                                    <li><a href="http://taobaokecms.test/admin/coupons?page=7">7</a></li>
                                    <li><a href="http://taobaokecms.test/admin/coupons?page=8">8</a></li>
                                    <li class="disabled"><span>...</span></li>
                                    <li><a href="http://taobaokecms.test/admin/coupons?page=299">299</a></li>
                                    <li><a href="http://taobaokecms.test/admin/coupons?page=300">300</a></li>
                                    <li><a href="http://taobaokecms.test/admin/coupons?page=2" rel="next">&raquo;</a></li>
                                  </ul>
                            </nav>
                        </div>

                        <!-- <tr>
                            <td colspan="5">
                                <ul class="pagination pull-right"></ul>
                            </td>
                        </tr> -->
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
@section('footJs')

@stop
