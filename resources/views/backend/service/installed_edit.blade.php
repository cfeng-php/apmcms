@extends('layouts.app')

@section('htmlheader_title')
    安装服务
@endsection
@section('contentheader_title')
    安装服务编辑
@endsection

@section('css')
    <link href="{{ asset('plugins/summernote/dist/summernote.css') }}" rel="stylesheet" type="text/css" />
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

@section('js')
    <script src="{{ asset('plugins/summernote/dist/summernote.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#setup').summernote({
                callbacks: {
                    onChange: function(contents) {
                        console.log(contents);
                        $('input[name="setup"]').val(contents);
                    }
                }
            });
        });
    </script>
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

                    {!! Form::open(['method' => 'post','url' => 'service/installed/update','enctype' => 'multipart/form-data']) !!}
                    @include('backend.service.installed_form',['submitButtonText'=>'保存'])
                    {!! Form::close() !!}

                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
    </div>
@endsection
