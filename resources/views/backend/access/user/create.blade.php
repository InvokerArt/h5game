@extends('backend.layouts.app')

@section('content')
<div id="myAlert"></div>
{{ Form::open(['route' => env('APP_BACKEND_PREFIX').'.access.admin.store', 'class' => 'form-horizontal', 'method' => 'post', 'id' => 'create-user']) }}
    <div class="portlet">
        <div class="portlet-title">
            <div class="actions btn-set">
                <button type="button" name="back" class="btn btn-secondary-outline" onclick="location.href='{{ route(env('APP_BACKEND_PREFIX').'.access.admin.index') }}'">
                    <i class="fa fa-angle-left"></i>
                    返回
                </button>
                <button class="btn btn-secondary-outline" type="reset">
                    <i class="fa fa-rotate-left"></i>
                    重置
                </button>
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-check"></i>
                    保存
                </button>
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
                                    {{ Form::select('user_id', [], null, ['class' => 'form-control user-ajax']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    角色
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::select('role_user', ['all' => '超级管理员', 'custom' => '普通管理员'], 'custom',['class' => 'form-control select2', 'id' => 'role-user']) }}
                                    <div id="available-roles" class="margin-top-20 hidden">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="icheck-inline">
                                                    @foreach ($roles as $role)
                                                        @if ($role->id < 3)
                                                            @continue
                                                        @endif
                                                        <label for="role_{{ $role->id }}">
                                                            <input type="checkbox" name="roles[]" value="{{ $role->id }}" id="role_{{ $role->id }}">
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
        })
    </script>
@stop