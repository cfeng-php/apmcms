<div class="modal fade type_add_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{url('doc/type/add')}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">添加文档类型</h4>
                </div>
                <div class="modal-body" id="myModalContent">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" style="display: inline-block" class="control-label">报表名称：</label>
                            <div style="display: inline-block;margin-right:30px;width: 300px;">
                                <input type="text" name="type_name" id="type_name" class="form-control">
                            </div>
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

@foreach($datas as $key => $item)
    <div class="modal fade type_edit_modal_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{url('doc/type/edit/'.$item->id)}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">编辑文档类型</h4>
                    </div>
                    <div class="modal-body" id="myModalContent">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name" style="display: inline-block" class="control-label">报表名称：</label>
                                <div style="display: inline-block;margin-right:30px;width: 300px;">
                                    <input type="text" name="type_name" id="type_name" value="{{$item->type_name}}" class="form-control">
                                </div>
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
@endforeach