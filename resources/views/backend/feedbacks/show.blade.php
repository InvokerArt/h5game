@extends('backend.layouts.app')

@section('page-title')
反馈详情
@stop

@section('content')
    <div class="portlet">            
        <div class="portlet-title">
            <div class="actions btn-set">
                <button type="button" name="back" class="btn btn-secondary-outline" onclick="location.href='{{ route(env('APP_BACKEND_PREFIX').'.feedbacks.index') }}'">
                    <i class="fa fa-angle-left"></i>
                    返回
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
                                </label>
                                <div class="col-md-10">
                                    <div class="form-control height-auto">
                                        $feedback->username
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    内容
                                </label>
                                <div class="col-md-10">
                                    <div class="form-control height-auto">
                                    $feedback->content
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
