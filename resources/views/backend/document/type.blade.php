@extends('layouts.app')
@section('htmlheader_title')
    文档类型
@endsection
@section('contentheader_title')
    文档类型列表
    <div class="pull-right">
        <a class="btn btn-sm btn-info" data-toggle="modal" data-target=".type_add_modal"><i class="fa fa-plus"></i>添加</a>
    </div>
@endsection

@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-hover dataTable" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>类型名</th>
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
                                        <td id="type_name_{{$item->id}}">{{ $item->type_name }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-info" data-toggle="modal" data-target=".type_edit_modal_{{$item->id}}" title="编辑"><i class="fa fa-edit"></i></a>
                                            {{--<a class="btn btn-sm btn-danger" onclick="return confirm('确定删除该记录吗?')" href="{{url('doc/type/del/'.$item->id)}}" title="删除"><i class="fa fa-trash-o"></i>--}}{{--删除--}}{{--</a>--}}
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
    @include('backend.document.type_modal')
@endsection

@section('js')
    <script>
        if('{{Session('error')}}'){
            alert('{{Session('error')}}');
        }
    </script>
@endsection
