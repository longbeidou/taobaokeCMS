@extends('admin.layouts.table.index')

@section('title', $title)
@section('headcss')

@stop
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>自定义响应式表格</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-5 m-b-xs">
                        <select class="input-sm form-control input-s-sm inline">
                            <option value="0">请选择</option>
                            <option value="1">选项1</option>
                            <option value="2">选项2</option>
                            <option value="3">选项3</option>
                        </select>
                    </div>
                    <div class="col-sm-4 m-b-xs">
                        <div data-toggle="buttons" class="btn-group">
                            <label class="btn btn-sm btn-white">
                                <input type="radio" id="option1" name="options">天</label>
                            <label class="btn btn-sm btn-white active">
                                <input type="radio" id="option2" name="options">周</label>
                            <label class="btn btn-sm btn-white">
                                <input type="radio" id="option3" name="options">月</label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input type="text" placeholder="请输入关键词" class="input-sm form-control"> <span class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-primary"> 搜索</button> </span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>项目</th>
                                <th>进度</th>
                                <th>任务</th>
                                <th>日期</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="checkbox" checked class="i-checks" name="input[]">
                                </td>
                                <td>米莫说｜MiMO Show</td>
                                <td><span class="pie">0.52/1.561</span>
                                </td>
                                <td>20%</td>
                                <td>2014.11.11</td>
                                <td><a href="table_basic.html#"><i class="fa fa-check text-navy"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="i-checks" name="input[]">
                                </td>
                                <td>商家与购物用户的交互试衣应用</td>
                                <td><span class="pie">6,9</span>
                                </td>
                                <td>40%</td>
                                <td>2014.11.11</td>
                                <td><a href="table_basic.html#"><i class="fa fa-check text-navy"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="i-checks" name="input[]">
                                </td>
                                <td>天狼---智能硬件项目</td>
                                <td><span class="pie">3,1</span>
                                </td>
                                <td>75%</td>
                                <td>2014.11.11</td>
                                <td><a href="table_basic.html#"><i class="fa fa-check text-navy"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="i-checks" name="input[]">
                                </td>
                                <td>线下超市+线上商城+物流配送互联系统</td>
                                <td><span class="pie">4,9</span>
                                </td>
                                <td>18%</td>
                                <td>2014.11.11</td>
                                <td><a href="table_basic.html#"><i class="fa fa-check text-navy"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@stop
@section('footJs')

@stop
