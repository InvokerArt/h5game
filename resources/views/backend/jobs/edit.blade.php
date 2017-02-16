@extends('backend.layouts.app')

@section('page-title')
编辑招聘
@stop

@section('content')
{{ Form::model($job, ['route' => [env('APP_BACKEND_PREFIX').'.jobs.update', $job], 'class' => 'form-horizontal', 'method' => 'PATCH', 'id' => 'edit-job']) }}
    <div class="portlet">            
        <div class="portlet-title">
            <div class="actions btn-set">
                <button type="button" name="back" class="btn btn-secondary-outline" onclick="location.href='{{ route(env('APP_BACKEND_PREFIX').'.jobs.index') }}'">
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
                    <div class="tab-pane active" id="tab1">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    会员用户名
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::select('user_id', [$job->user_id => $job->username], $job->user_id, ['class' => 'form-control', 'readonly' => true]) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    招聘职位
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('job', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    招聘人数
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('total', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    学历要求
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('education', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    工作年限
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('experience', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    薪资待遇
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('minsalary', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    其他
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::textarea('content', null, ['class' => 'form-control editor', 'autocomplete' => 'true', 'id' => 'editor']) }}
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
    @include('UEditor::head')
    <script type="text/javascript">
        $(function(){
            //公司资料
            $(document).on('click', '.user-info', function(){
                var newWindow = window.open("","_blank");
                if ($('#username').val()){
                    $.get("{{ route(env('APP_BACKEND_PREFIX').'.users.ajax.info') }}", {username: $('#username').val()}, function(data){
                        newWindow.location.href = "/"+"{{ env('APP_BACKEND_PREFIX') }}"+"/users/"+data.id+"/edit";
                    });
                }
            })
        })

        /**
         * 百度编辑器
         */
        UE.delEditor('editor');
        var ue = UE.getEditor('editor',{
            initialFrameHeight:350,//设置编辑器高度
            scaleEnabled:true
        });
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
        })
    </script>
@stop
