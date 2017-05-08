@extends('layouts.app')

@section('htmlheader_title')
    服务安装
@endsection
@section('contentheader_title')
    {{$data->integration}} - 服务安装详情

    <div style="float: right">
        <a class="btn btn-sm btn-info" href="{{url('service/installed/edit/'.$data->integration)}}" title="编辑"><i class="fa fa-edit"></i></a>
        <a class="btn btn-sm btn-danger" onclick="return confirm('确定删除该记录吗?')" href="{{url('service/installed/del/'.$data->integration)}}" title="删除"><i class="fa fa-trash-o"></i>{{--删除--}}</a>
        <a class="btn btn-sm btn-info" href="{{url('service/installed/add')}}" title="添加"><i class="fa fa-plus"></i></a>
    </div>
@endsection

@section('css')
    <style>
        blockquote{
            padding: 15px 20px;
            margin: 0 0 20px;
            font-size: 16px;
            border-left: 4px solid #566FC9;
            background: #f7f7f9;
            color: #2f2c2c;
        }
    </style>
@endsection

@section('main-content')
    <div class="row">
        <div class="col-lg-14">
            <div class="box">
                <div class="box-body">
                    <p class="muted">{{$data->description}}</p>
                    <div style="padding:10px;margin-top:30px;">
                        {!! $data->setup !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
