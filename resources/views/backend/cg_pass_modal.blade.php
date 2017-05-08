<div class="modal fade my_change_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{url('admin/change/'.Auth::user()->id)}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">修改密码</h4>
                </div>
                <div class="modal-body" id="myModalContent">
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('old_pwd', '原密码:') !!}
                            {!! Form::password('old_pwd',null, ['class' => 'form-control', 'autofocus' => 'autofocus','required' =>'required']) !!}

                            {!! Form::label('new_pwd', '新密码:') !!}
                            {!! Form::password('new_pwd',null, ['class' => 'form-control', 'autofocus' => 'autofocus','required' =>'required']) !!}

                            {!! Form::label('re_new_pwd', '重复新密码:') !!}
                            {!! Form::password('re_new_pwd', null, ['class' => 'form-control', 'autofocus' => 'autofocus','required' =>'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>