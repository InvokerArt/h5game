@extends('backend.layouts.app')

@section('content')
{{ Form::open(['route' => env('APP_BACKEND_PREFIX').'.faqs.store', 'method' => 'post', 'id' => 'create-faq', 'class' => 'form-horizontal']) }}
<div class="portlet"> 
    <div class="portlet-title">
        <div class="actions btn-set">
            <button type="button" name="back" class="btn btn-secondary-outline" onclick="location.href='{{ route(env('APP_BACKEND_PREFIX').'.faqs.index') }}'">
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
        <div class="col-xs-12">
            <div class="form-group">
                {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => '在此输入问题标题']) }}
            </div>
            <div class="form-group">
                {{ Form::textarea('content', null, ['class' => 'form-control', 'id' => 'editor']) }}
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@stop

@section('js')
    @include('UEditor::head')
    <script>
        $(function(){
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
        });
    </script>
@stop