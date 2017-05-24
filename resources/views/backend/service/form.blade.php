<div class="form-group">
    {!! Form::label('integration', '服务名称:') !!}
    @if(isset($data))
    {!! Form::text('integration', $data->integration, ['class' => 'form-control', 'autofocus' => 'autofocus','readonly' => 'readonly','required' =>'required']) !!}
    @else
    {!! Form::text('integration', null, ['class' => 'form-control', 'autofocus' => 'autofocus','required' =>'required']) !!}
    @endif
</div>

<div class="form-group">
    {!! Form::label('type', 'type:') !!}
    <select name="type" class = 'form-control'>
        @for($i=1;$i<=10;$i++)
            <option value="{{$i}}" @if(isset($data) && $i == $data->type ) selected="selected" @endif>{{ getMetricServiceTypeName($i) }}</option>
        @endfor
    </select>
</div>

<div class="form-group">
    {!! Form::label('is_display', 'Is_display(后台显示，必填):') !!}
    <div style="display: inline-block;margin:0px 10px">
        {!! Form::radio('is_display',1,isset($data) ? $data->is_display == 1 ? true :false : false,['required' =>'required']) !!} 显示
        {!! Form::radio('is_display',0,isset($data) ? $data->is_display != 1 ? true : false : true,['required' =>'required']) !!} 不显示
    </div>
</div>

<div class="form-group">
    {!! Form::label('alias', 'Alias(别名):') !!}
    {!! Form::text('alias', isset($data) ? $data->alias : null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
</div>

<div class="form-group">
    {!! Form::label('logo', 'Logo信息:') !!}
    {!! Form::text('logo', isset($data) ? htmlspecialchars($data->logo) : null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
</div>

<div class="form-group">
    {!! Form::label('logoname', 'Logo Name:') !!}
    {!! Form::text('logoname', isset($data) ? htmlspecialchars($data->logoname) : null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
</div>

<div class="form-group">
    {!! Form::label('mpicurl', '图片:') !!}
    <input type="file" id="mpicurl" style="display: none" name="mpicurl" onChange="imgUploadChange(this)">
    <img src="{{isset($data) ? $data->mpicurl :''}}" class="img-responsive pad">
    {{--@if(isset($filename) && !empty($filename))
    <img src="/template/{{$filename}}" alt="" class="img-responsive pad">
    @endif--}}
    <a class="btn btn-social btn-instagram" id="img_upload"><i class="fa fa-instagram"></i> 上传图片</a>
    <p id="filename" style="display: inline-block"></p>
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
