@extends('backend.layouts.app')

@section('content')
{{ Form::open(['route' => env('APP_BACKEND_PREFIX').'.banners.store', 'class' => 'form-horizontal', 'method' => 'post', 'id' => 'submit_form']) }}
    <div class="portlet">            
        <div class="portlet-title">
            <div class="actions btn-set">
                <button type="button" name="back" class="btn btn-secondary-outline" onclick="location.href='{{ route(env('APP_BACKEND_PREFIX').'.banners.index') }}'">
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
                                    广告位标题
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('title', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'title']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    广告位描述
                                </label>
                                <div class="col-md-10">
                                    {{ Form::textarea('description', null, ['class' => 'form-control editor', 'autocomplete' => 'true',]) }}
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
        })
    </script>
@stop
