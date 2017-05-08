@extends('layouts.app')
@section('htmlheader_title')
    服务指标列表
@endsection
@section('contentheader_title')
    服务指标列表
@endsection

@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        {!! Form::open(['method' => 'post','url' => 'service/metric','style' => 'width:200px']) !!}
                        <div class="input-group">
                            <input type="text" name="search_name" value="{{  $search_name?$search_name:''  }}" class="form-control" placeholder="输入指标名">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-sm btn-info" href="{{url('service/metric/add')}}"><i class="fa fa-plus"></i>添加</a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-hover dataTable" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>服务名</th>
                                    <th>节点名</th>
                                    <th>指标名</th>
                                    <th>描述</th>
                                    <th>短描述</th>
                                    <th>指标类型</th>
                                    <th>单位</th>
                                    <th>采集每秒单位</th>
                                    <th>别名</th>
                                    <th style="width:50px">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $key => $item)
                                    <?php
                                    $no = ($datas->currentPage() - 1) * $page_num + ($key+1);
                                    ?>
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $item->integrationid }}</td>
                                        <td>{{ $item->subname }}</td>
                                        <td>{{ $item->metric_name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->short_description }}</td>
                                        <td>{{ $item->metric_type }}</td>
                                        <td>{{ $item->plural_unit }}</td>
                                        <td>{{ $item->per_unit }}</td>
                                        <td>{{ $item->metric_alias }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-info" href="{{url('service/metric/show/'.$item->metric_name)}}" title="编辑"><i class="fa fa-edit"></i>{{--查看--}}</a>
                                            <a class="btn btn-sm btn-danger" onclick="return confirm('确定删除该记录吗?')" href="{{url('service/metric/del/'.$item->metric_name)}}" title="删除"><i class="fa fa-trash-o"></i>{{--删除--}}</a>
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
                                {!! $datas->render() !!}
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
