@extends('layouts.app')

@section('htmlheader_title')
    指标详情
@endsection
@section('contentheader_title')
    指标详情
@endsection

@section('main-content')
    <div class="row">
        <div class="col-lg-14">
            <div class="box">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="box-body">

                    {!! Form::open(['method' => 'post','url' => 'service/metric/update','enctype' => 'multipart/form-data']) !!}
                    @include('backend.service.metric_form',['submitButtonText'=>'保存'])
                    {!! Form::close() !!}

                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
    </div>
@endsection
