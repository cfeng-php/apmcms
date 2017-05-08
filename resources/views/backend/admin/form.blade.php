<div class="form-group">
    {!! Form::label('email', '邮箱:') !!}
    {!! Form::email('email', isset($datas) ? $datas->email : null, ['class' => 'form-control', 'autofocus' => 'autofocus','required' =>'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('name', '名称:') !!}
    {!! Form::text('name', isset($datas) ? $datas->name : null, ['class' => 'form-control', 'autofocus' => 'autofocus','required' =>'required']) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
