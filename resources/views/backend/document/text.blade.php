@extends('layouts.app')
@section('htmlheader_title')
    文档
@endsection
@section('contentheader_title')
    文档列表
@endsection

@section('js')
    <script>
        $('#search_type').change(function(){
            if($(this).val != '0') $(this).css('color','#000');
            $(this).css('color','#333');
        });
    </script>
@endsection

@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        {!! Form::open(['method' => 'post','url' => 'doc/text','style' => 'width:450px']) !!}
                        <div class="input-group">
                            <select name="search_type" id="search_type" class="form-control" style="width:200px;@if(!$search_type) color:#a0a0a0; @endif">
                                <option value="0" disabled selected>文档类型</option>
                                @foreach($types as $type)
                                    <option value="{{$type->id}}" @if($search_type == $type->id) selected="selected" @endif>{{$type->type_name}}</option>
                                @endforeach
                            </select>
                            <input type="text" name="search_title" value="{{  $search_title?$search_title:''  }}" class="form-control" style="width:210px;"  placeholder="输入文档标题">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-sm btn-info" href="{{url('doc/text/add')}}"><i class="fa fa-plus"></i>添加</a>
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
                                    <th>文档类型</th>
                                    <th>文档标题</th>
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
                                        <td>{{ $item->type_name }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-info" href="{{url('doc/text/edit/'.$item->id)}}" title="编辑"><i class="fa fa-edit"></i>{{--查看--}}</a>
                                            <a class="btn btn-sm btn-danger" onclick="return confirm('确定删除该记录吗?')" href="{{url('doc/text/del/'.$item->id)}}" title="删除"><i class="fa fa-trash-o"></i>{{--删除--}}</a>
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
                                {!! $datas->appends(['search_type'=>$search_type,'search_title'=>$search_title])->render() !!}
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
