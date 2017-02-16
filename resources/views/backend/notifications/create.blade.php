@extends('backend.layouts.app')

@section('content')
{{ Form::open(['route' => env('APP_BACKEND_PREFIX').'.notifications.store', 'method' => 'post', 'id' => 'create-notification', 'class' => 'form-horizontal']) }}
<div class="portlet">            
    <div class="portlet-title">
        <div class="note note-danger">
            <p>消息创建之后不可再修改！</p>
        </div>
        <div class="col-sm-5">
            <div class="form-group">
                <label class="col-sm-2 control-label">内容 <i class="required">*</i></label>
                <div class="col-sm-10">
                    {{ Form::textarea('data', null, ['class' => 'form-control', 'maxlength' => 40, 'placeholder' => '推送消息不宜过长，请尽量精简，最长40字符', 'id' => 'notification-content']) }}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">模块 <i class="required">*</i></label>
                <div class="col-sm-10">
                    {{ Form::select('notification_type',['App\Models\News' => '资讯', 'App\Models\Exhibition' => '展会', 'App\Models\Company' => '公司', 'App\Models\Topic' => '话题'], 1, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">资源ID <i class="required">*</i></label>
                <div class="col-sm-10">
                    {{ Form::text('notification_id', null, ['class' => 'form-control', 'id' => 'notification-id']) }}
                    <span class="help-block">如资源ID填1，模块为资讯，则推送ID为1的资讯。</span>
                </div>
            </div>
            <hr class="clearfix">
            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <button type="button" id="submit-btn" class="btn btn-success">提交</button>
                </div>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@stop

@section('js')
<script>
    $(function(){
        $('#submit-btn').on('click', function() {
            var form = $(this).closest('form');
            if($('#notification-content').val() == ''){
                swal("请填写推送内容");
            }
            if($('#notification-id').val() == ''){
                swal("请填写目标ID");
            }
            if ($('#notification-content').val().length && $('#notification-id').val().length) {
                swal({
                    title: '警告',
                    text: '消息创建之后不可再修改，确认创建？',
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: '返回',
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: '确定',
                    closeOnConfirm: true
                }, function(confirmed) {
                    if (confirmed)
                        form.submit();
                });
            };
        });

        $(".selectboxit").change(function() {
            if ($(this).val() == 1) {
                $('.user-ajax').prop('disabled', true);
            } else {
                //$('select.select2').select2('data', {});
                $('.user-ajax').prop('disabled', false);
            }
        });
    });
</script>
@stop