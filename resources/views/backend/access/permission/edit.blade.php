@extends('backend.layouts.app')

@section('content')
{{ Form::model($permission, ['route' => [env('APP_BACKEND_PREFIX').'.access.permission.update', $permission], 'class' => 'form-horizontal', 'method' => 'PATCH', 'id' => 'edit-permission']) }}
    <div class="portlet">
        <div class="portlet-title">
            {{-- <div class="caption">
                编辑权限
            </div> --}}
            <div class="actions btn-set">
                <button type="button" name="back" class="btn btn-secondary-outline" onclick="location.href='{{ route(env('APP_BACKEND_PREFIX').'.access.permission.index') }}'">
                    <i class="fa fa-angle-left"></i>
                    返回
                </button>
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-check-circle"></i>
                    保存
                </button>
                @if ($permission->id>3)
                    <button class="btn btn-danger" type="button" href="{{ route(env('APP_BACKEND_PREFIX').'.access.permission.destroy', $permission->id) }}" data-method="delete">
                    <i class="fa fa-trash"></i> 
                    删除
                </button>
                @endif
            </div>
        </div>
        <div class="portlet-body">
            <div class="tabbable-bordered">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_general">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    权限名称
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('name', $permission->name, ['class' => 'form-control', 'autocomplete' => 'off']) }}
                                    <span class="help-block"> 只能由小写字母、横杠组成。 </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    显示名称
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('display_name', $permission->display_name, ['class' => 'form-control', 'autocomplete' => 'off']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    权限描述
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::textarea('description', $permission->description, ['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{ Form::close() }}
@stop

@section('js')
    <script type="text/javascript">
        var associated = $("select[name='associated-permissions']");
        var associated_container = $("#available-permissions");

        if (associated.val() == "custom")
            associated_container.removeClass('hidden');
        else
            associated_container.addClass('hidden');

        associated.change(function() {
            if ($(this).val() == "custom")
                associated_container.removeClass('hidden');
            else
                associated_container.addClass('hidden');
        });
    </script>
@stop