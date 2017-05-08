@extends('layouts.app')

@section('htmlheader_title')
    服务详情
@endsection
@section('contentheader_title')
    服务详情
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

                    {!! Form::open(['method' => 'post','url' => 'service/update/' . $data->integration,'enctype' => 'multipart/form-data']) !!}
                    @include('backend.service.form',['submitButtonText'=>'保存'])
                    {!! Form::close() !!}

                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function(){
            $('#img_upload').click(function(){
                $('#mpicurl').click();
            });
        });
        function imgUploadChange(obj){
            $('#filename').text(obj.value.substr(obj.value.lastIndexOf("\\")+1, obj.value.length));
        }
    </script>
@endsection
