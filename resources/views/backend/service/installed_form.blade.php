
<div class="form-group">
    {!! Form::label('integration', '服务名称:') !!}
    <select name="integration" class="form-control">
        @foreach($services as $item)
            <option value="{{$item->integration}}" @if(isset($data) && $item->integration == $data->integration) selected="selected" @endif>{{$item->integration}}</option>
        @endforeach
    </select>
    {{--{!! Form::text('integration', isset($data) ? $data->integration : null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}--}}
</div>

<div class="form-group">
    {!! Form::label('description', '服务简介:') !!}
    {!! Form::text('description', isset($data) ? $data->description : null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
</div>

<div class="form-group">
    {!! Form::label('setup', '安装详情:') !!}
    <input type="hidden" name="setup" value="{{isset($data) ? $data->setup : ''}}">
    <div id="setup">{!! isset($data) ? $data->setup : '' !!}</div>
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>