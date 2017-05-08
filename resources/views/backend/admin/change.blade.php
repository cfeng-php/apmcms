@extends('layouts.app')


@section('htmlheader_title')
    管理员设置
@endsection

@section('contentheader_title')
    密码修改
@endsection


@section('main-content')

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-7">
            <div class="box">
                <div class="box-header"></div>
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

                    {!! Form::open(['method' => 'post','url' => 'admin/change/'.$datas->id,'autocomplete' => 'off']) !!}
                    @include('backend.admin.pwd_form',['submitButtonText'=>'保存'])
                    {!! Form::close() !!}

                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
    </div>
    <!-- /.row -->
@stop

@section('js')
    <script>
        if('{{Session('error')}}'){
            alert('{{Session('error')}}');
        }
    </script>
@endsection
