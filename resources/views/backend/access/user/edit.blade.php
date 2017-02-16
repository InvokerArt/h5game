@extends('backend.layouts.app')

@section('content')
{{ Form::model($user, ['route' => [env('APP_BACKEND_PREFIX').'.access.admin.update', $user], 'class' => 'form-horizontal', 'method' => 'PATCH', 'id' => 'edit-user']) }}
    <div class="portlet">
        <div class="portlet-title">
            <div class="actions btn-set">
                <button type="button" name="back" class="btn btn-secondary-outline" onclick="location.href='{{ route(env('APP_BACKEND_PREFIX').'.access.admin.index') }}'">
                    <i class="fa fa-angle-left"></i>
                    返回
                </button>
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-check-circle"></i>
                    保存
                </button>
                @if ($user->id>1)
                <button class="btn btn-danger" type="button" href="{{ route(env('APP_BACKEND_PREFIX').'.access.admin.destroy', $user->id) }}" data-method="delete">
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
                                    用户名
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::select('user_id', [$user->id => $user->username], $user->id, ['class' => 'form-control user-ajax']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    角色
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::select('role_user', ['all' => '超级管理员', 'custom' => '普通管理员'], in_array(2, $role_user) ? 'all' : 'custom',['class' => 'form-control select2', 'id' => 'role-user']) }}
                                    <div id="available-roles" class="margin-top-20 hidden">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="icheck-inline">
                                                    @foreach ($roles as $role)
                                                        @if ($role->id < 3)
                                                            @continue
                                                        @endif
                                                        <label for="role_{{ $role->id }}">
                                                            <input type="checkbox" name="roles[]" value="{{ $role->id }}" id="role_{{ $role->id }}" {{in_array($role->id, $role_user) ? 'checked' : ''}}>
                                                            {{ $role->display_name }}
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

            var associated = $("select[name='role_user']");
            var associated_container = $("#available-roles");

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