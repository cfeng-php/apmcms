@extends('layouts.app')
@section('htmlheader_title')
    安装服务
@endsection
@section('contentheader_title')
    安装服务列表
@endsection

@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        {!! Form::open(['method' => 'post','url' => 'service/installed','style' => 'width:200px']) !!}
                        <div class="input-group">
                            <input type="text" name="search_name" value="{{  $search_name?$search_name:''  }}" class="form-control" placeholder="输入服务名">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-sm btn-info" href="{{url('service/installed/add')}}" title="添加安装服务"><i class="fa  fa-plus">添加</i></a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-hover dataTable" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>MID</th>
                                    <th>服务名称</th>
                                    <th style="width:90px;">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $key => $item)
                                    <?php
                                    $no = ($datas->currentPage() - 1) * $page_num + ($key+1);
                                    ?>
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $item->mid }}</td>
                                        <td>{{ $item->integration }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-success" href="{{url('service/installed/show/'.$item->integration)}}" title="查看"><i class="fa fa-eye"></i>{{--查看--}}</a>
                                            <a class="btn btn-sm btn-info" href="{{url('service/installed/edit/'.$item->integration)}}" title="编辑"><i class="fa fa-edit"></i>{{--编辑--}}</a>
                                            <a class="btn btn-sm btn-danger" onclick="return confirm('确定删除该记录吗?')" href="{{url('service/installed/del/'.$item->integration)}}" title="删除"><i class="fa fa-trash-o"></i>{{--删除--}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">
                                每页{{ $datas->count() }}条,共{{ $datas->lastPage() }}页,总{{ $datas->total() }}条.
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                                {!! $datas->appends(['search_name'=>$search_name])->render() !!}
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

@section('js')
    <script>
        if('{{Session('error')}}'){
            alert('{{Session('error')}}');
        }
    </script>
@endsection
