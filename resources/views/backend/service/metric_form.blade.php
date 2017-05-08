{{--<div class="form-group">
    {!! Form::label('integrationid', '服务名称:') !!}
    {!! Form::text('integrationid', isset($data) ? $data->integrationid : null, ['class' => 'form-control', 'autofocus' => 'autofocus','required' =>'required']) !!}
</div>--}}

<div class="form-group">
    {!! Form::label('metric_name', '指标名称:') !!}
    {!! Form::text('metric_name', isset($data) ? $data->metric_name : null, ['class' => 'form-control', 'autofocus' => 'autofocus','required' =>'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('subname', '节点名称:') !!}
    {!! Form::text('subname', isset($data) ? $data->subname : null, ['class' => 'form-control', 'autofocus' => 'autofocus','required' =>'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('metric_type', '指标类型:') !!}
    <select name="metric_type" class="form-control">
        @foreach(getMetricTypeName() as $value)
            <option value="{{$value}}" @if(isset($data) && $value == $data->metric_type ) selected="selected" @endif>{{$value}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    {!! Form::label('description', '描述:') !!}
    {!! Form::text('description', isset($data) ? $data->description : null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
</div>

<div class="form-group">
    {!! Form::label('short_description', '简描述:') !!}
    {!! Form::text('short_description', isset($data) ? $data->short_description : null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
</div>

<div class="form-group">
    {!! Form::label('metric_alias', '别名:') !!}
    {!! Form::text('metric_alias', isset($data) ? $data->metric_alias : null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
</div>

<div class="form-group">
    {!! Form::label('plural_unit', '单位(plural_unit):') !!}
    <select name="plural_unit" class = 'form-control'>
        <option value="null">(none)</option>
        @foreach(getPluralUnit() as $key => $value)
            <optgroup label="{{$key}}">
                @foreach($value as $plural_unit)
                    <option value="{{$plural_unit}}" @if(isset($data) && $plural_unit == $data->plural_unit ) selected="selected" @endif>{{ $plural_unit }}</option>
                @endforeach
            </optgroup>
        @endforeach
    </select>
</div>

<div class="form-group">
    {!! Form::label('per_unit', '采集每秒单位(per_unit):') !!}
    <select name="per_unit" class = 'form-control'>
        <option value="null">(none)</option>
        @foreach(getPluralUnit() as $key => $value)
            <optgroup label="{{$key}}">
                @foreach($value as $plural_unit)
                    <option value="{{$plural_unit}}" @if(isset($data) && $plural_unit == $data->per_unit ) selected="selected" @endif>{{ $plural_unit }}</option>
                @endforeach
            </optgroup>
        @endforeach
    </select>
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
