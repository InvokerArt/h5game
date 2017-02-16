@extends('backend.layouts.app')

@section('content')
{{ Form::model($role, ['route' => [env('APP_BACKEND_PREFIX').'.access.role.update', $role], 'class' => 'form-horizontal', 'method' => 'PATCH', 'id' => 'edit-role']) }}
    <div class="portlet">
        <div class="portlet-title">
            <div class="actions btn-set">
                <button type="button" name="back" class="btn btn-secondary-outline" onclick="location.href='{{ route(env('APP_BACKEND_PREFIX').'.access.role.index') }}'">
                    <i class="fa fa-angle-left"></i>
                    返回
                </button>
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-check-circle"></i>
                    保存
                </button>
                @if ($role->id>3)
                    <button class="btn btn-danger" type="button" href="{{ route(env('APP_BACKEND_PREFIX').'.access.role.destroy', $role->id) }}" data-method="delete">
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
                                    角色名称
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('name', $role->name, ['class' => 'form-control', 'autocomplete' => 'off']) }}
                                    <span class="help-block"> 只能由小写字母组成。 </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    显示名称
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('display_name', $role->display_name, ['class' => 'form-control', 'autocomplete' => 'off']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    角色描述
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::textarea('description', $role->description, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    相关权限
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::select('associated-permissions', ['all' => '全部', 'custom' => '自定义'], ($role->all) ? 'all' : 'custom',['class' => 'form-control', 'id' => 'associated-permissions']) }}
                                    <div id="available-permissions" class="margin-top-20 hidden">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="icheck-inline">
                                                    @if ($permissions->count())
                                                        @foreach ($permissions as $perm)
                                                            <label for="perm_{{ $perm->id }}">
                                                                <input type="checkbox" name="permissions[]" value="{{ $perm->id }}" id="perm_{{ $perm->id }}" {{in_array($perm->id, $role_permissions) ? 'checked' : ""}}>
                                                                {{ $perm->display_name }}
                                                            </label>
                                                        @endforeach
                                                    @else
                                                        <p>有没有可用的权限。</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    排序
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('sort', $role->sort, ['class' => 'form-control', 'autocomplete' => 'off']) }}
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
        $(function(){
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

            $('input').iCheck({
                checkboxClass: 'icheckbox_flat-green'
            });

            /**
             * 删除操作
             */
            $('body').on('submit', 'form[name=delete_item]', function(e){
                e.preventDefault();
                var form = this;
                var link = $('[data-method="delete"]');
                var cancel = (link.attr('data-trans-button-cancel')) ? link.attr('data-trans-button-cancel') : "返回";
                var confirm = (link.attr('data-trans-button-confirm')) ? link.attr('data-trans-button-confirm') : "确定";
                var title = (link.attr('data-trans-title')) ? link.attr('data-trans-title') : "警告";
                var text = (link.attr('data-trans-text')) ? link.attr('data-trans-text') : "你确定要删除这个项目吗？";

                swal({
                    title: title,
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: cancel,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: confirm,
                    closeOnConfirm: true
                }, function(confirmed) {
                    if (confirmed)
                        form.submit();
                });
            });
        })
    </script>
@stop