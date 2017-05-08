<input type="hidden" name="action" value="change_pwd">
<div class="form-group">
    {!! Form::label('old_pwd', '原密码:') !!}
    {!! Form::password('old_pwd',null, ['class' => 'form-control', 'autofocus' => 'autofocus','required' =>'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('new_pwd', '新密码:') !!}
    {!! Form::password('new_pwd',null, ['class' => 'form-control', 'autofocus' => 'autofocus','required' =>'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('re_new_pwd', '重复新密码:') !!}
    {!! Form::password('re_new_pwd', null, ['class' => 'form-control', 'autofocus' => 'autofocus','required' =>'required']) !!}
</div>

<div class="form-group">
    <p style="color: red">密码应该由至少6位数组、字母或者下划线组成</p>
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
