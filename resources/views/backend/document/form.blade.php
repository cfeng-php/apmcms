
<div class="form-group">
    {!! Form::label('type', '文档类型:') !!}
    <select name="type" class="form-control">
        @foreach($types as $type)
            <option value="{{$type->id}}" @if(isset($data) && $data->type == $type->id) selected="selected" @endif>{{$type->type_name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    {!! Form::label('title', '文档标题:') !!}
    {!! Form::text('title', isset($data) ? $data->title : null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
</div>

<div class="form-group">
    {!! Form::label('setup', '详情:') !!}
    <input type="hidden" name="text" value="{{isset($data) ? $data->text : ''}}">
    <div id="text">{!! isset($data) ? $data->text : '' !!}</div>
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>