@extends('layouts.app')
@section('htmlheader_title')
    服务列表
@endsection
@section('contentheader_title')
    服务列表
@endsection

@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        {!! Form::open(['method' => 'post','url' => 'service','style' => 'width:200px']) !!}
                        <div class="input-group">
                            <input type="text" name="search_name" value="{{  $search_name?$search_name:''  }}" class="form-control" placeholder="输入服务名">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-sm btn-info" href="{{url('service/add')}}"><i class="fa fa-plus"></i>添加</a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-hover dataTable" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>服务名称</th>
                                    <th>类型</th>
                                    {{--<th>描述</th>--}}
                                    <th>显示</th> {{--IS_DISPLAY（1为后台显示，0为不显示）--}}
                                    <th>别名</th>
                                    <th style="width:210px">LOGO</th>
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
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->integration }}</td>
                                    <td>{{ getMetricServiceTypeName($item->type) }}</td>
                                    {{--<td>{{ $item->typedesc }}</td>--}}
                                    <td>{{ $item->is_display == 1? '后台显示' : '不显示' }}</td>
                                    <td>{{ $item->alias }}</td>
                                    <td>{{ htmlspecialchars($item->logo) }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-info" href="{{url('service/show/'.$item->integration)}}" title="编辑"><i class="fa fa-edit"></i>{{--查看--}}</a>
                                        <a class="btn btn-sm btn-danger" onclick="return confirm('确定删除该记录吗?')" href="{{url('service/del/'.$item->integration)}}" title="删除"><i class="fa fa-trash-o"></i>{{--删除--}}</a>
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
