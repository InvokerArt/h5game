@extends('backend.layouts.app')

@section('css')
<link rel="stylesheet" href="/js/vendor/cropper/cropper.min.css">
<link rel="stylesheet" href="/js/vendor/cropper/main.css">
@stop

@section('content')
<div id="crop-avatar">
    {{ Form::model($user, ['route' => [env('APP_BACKEND_PREFIX').'.users.update', $user], 'class' => 'form-horizontal', 'method' => 'PATCH', 'id' => 'edit-user']) }}
    <div class="portlet">
        <div class="portlet-title">
            <div class="actions btn-set">
                <button type="button" name="back" class="btn btn-secondary-outline" onclick="location.href='{{ route(env('APP_BACKEND_PREFIX').'.users.index') }}'">
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
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#user">个人资料</a>
                    </li>
                    @if ($company)
                    <li>
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.companies.edit', $company->id) }}">公司信息</a>
                    </li>
                    @endif
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="user">
                        <div class="form-body">
                            <div class="form-group">
                                <div class="pull-left col-xs-offset-2">
                                    <div class="avatar-view" data-toggle="tooltip" data-placement="bottom" title="修改头像">
                                        <img src="{{ $user->avatar['_default'] }}" class="user-profile-image" />
                                    </div>
                                </div>
                                <input type="hidden" name="avatar" id="avatar">
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    用户名
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('username', null, ['class' => 'form-control', 'autocomplete' => 'off']) }}
                                    <span class="help-block">只能由小写字母、横杠组成。</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    手机号
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('mobile', null, ['class' => 'form-control', 'autocomplete' => 'off']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    真实姓名
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    邮箱
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('email', null, ['class' => 'form-control', 'autocomplete' => 'off']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    密码
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::password('password', ['class' => 'form-control', 'autocomplete' => 'off']) }}
                                    <span class="help-block">不修改密码则留空。密码长度必须大于6位</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    确认密码
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::password('password_confirmation', ['class' => 'form-control', 'autocomplete' => 'off']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
    <!-- Cropping modal -->
    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                {!! Form::open(['route' => [env('APP_BACKEND_PREFIX').'.users.avatar', $user->id], 'class' => 'avatar-form', 'method' => 'POST']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="avatar-modal-label">设置新头像</h4>
                </div>
                <div class="modal-body">
                    <div class="avatar-body">

                        <!-- Upload image and data -->
                        <div class="avatar-upload">
                            <input type="hidden" class="avatar-src" name="avatar_src">
                            <input type="hidden" class="avatar-data" name="avatar_data">
                            <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
                        </div>

                        <!-- Crop and preview -->
                        <div class="row">
                            <div class="col-md-9">
                                <div class="avatar-wrapper"></div>
                            </div>
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg"></div>
                                300*300
                                <div class="avatar-preview preview-md"></div>
                                150*150
                                <div class="avatar-preview preview-sm"></div>
                                65*65
                            </div>
                        </div>

                        <div class="row avatar-btns">
                            <div class="col-md-9">
                                <button type="button" class="btn btn-primary" data-method="rotate" data-option="-5" title="向左旋转">
                                    <span class="docs-tooltip" data-toggle="tooltip" data-method="rotate" data-option="-5" title="" data-original-title="向左旋转">
                                        <span class="fa fa-rotate-left" data-method="rotate" data-option="-5"></span>
                                    </span>
                                </button>
                                <button type="button" class="btn btn-primary" data-method="rotate" data-option="5" title="向右旋转">
                                    <span class="docs-tooltip" data-toggle="tooltip" data-method="rotate" data-option="5" title="" data-original-title="向右旋转">
                                        <span class="fa fa-rotate-right" data-method="rotate" data-option="5"></span>
                                    </span>
                                </button>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary btn-block avatar-save">完成</button>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div><!-- /.modal -->

    <!-- Loading state -->
    <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
</div>
@stop

@section('js')
    <script src="/js/vendor/cropper/cropper.min.js"></script>
    <script src="/js/vendor/cropper/main.js"></script>
@stop