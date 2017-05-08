@extends('layouts.app')

@section('htmlheader_title')
    管理员
@endsection

@section('contentheader_title')
    列表
@endsection


@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">管理员列表</h3>
                    <div class="pull-right">
                        <a class="btn btn-sm btn-primary" href="{{ url('admin/add') }}">添加</a>
                    </div>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-hover dataTable" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>用户名</th>
                                    <th>邮箱</th>
                                    <th>修改时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($admins as $key => $admin)
                                    <?php
                                        $no = ($admins->currentPage() - 1) * $page_num + ($key+1);
                                    ?>
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ date('Y-m-d H:i:s',strtotime($admin->updated_at)) }}</td>
                                        <td>
                                            {!! Form::open(['method' => 'get', 'url' => 'admin/edit/'.$admin->id , 'style' => 'float:left;margin-right: 10px;']) !!}
                                            <button type="submit" class="btn btn-success btn-sm iframe cboxElement"><span class="glyphicon glyphicon-pencil"></span> 编辑</button>
                                            {!! Form::close() !!}

                                            {!! Form::open(['method' => 'get', 'url' => 'admin/active/'.$admin->id, 'style' => 'float:left;margin-right: 10px;']) !!}
                                            <button type="submit" class="btn btn-sm {{$admin->active ? 'btn-danger' : 'btn-success'}} iframe cboxElement"><span class="glyphicon glyphicon-trash"></span> {{$admin->active ? "禁用" :"激活"}}</button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                                {{--<tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>公司名称</th>
                                        <th>图片</th>
                                        <th>创建时间</th>
                                        <th>操作</th>
                                    </tr>
                                </tfoot>--}}
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">
                                每页{{ $admins->count() }}条,共{{ $admins->lastPage() }}页,总{{ $admins->total() }}条.
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                                {!! $admins->render() !!}
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection
