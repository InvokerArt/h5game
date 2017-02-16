@extends('backend.layouts.app')

@section('content')
{{ Form::open(['route' => env('APP_BACKEND_PREFIX').'.banners.image.store', 'class' => 'form-horizontal', 'method' => 'post', 'id' => 'submit_form' ,'enctype' => 'multipart/form-data', 'accept-charset' => 'UTF-8']) }}
    <div class="portlet">
    <div class="note note-danger no-margin margin-bottom-10">广告图的名字一定不要重名！！！ 文件名最好已时间来命名 （例：2016-10-27-20-10.jpg）图片尺寸建议(750x300)</div>
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
                                    所属广告位
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::select('banner_id', $banners, null, ['class' => 'form-control select2']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    广告标题
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('title', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'title']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    广告图
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    <div class="form-control height-auto">
                                        {{ Form::file('image') }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    广告链接
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('link', null, ['class' => 'form-control', 'autocomplete' => 'true']) }}
                                    <span class="help-block">例：{{ env('APP_URL') }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    广告打开方式
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                            <label>
                                            {{ Form::radio('target', '_blank', true) }}
                                            新页面
                                            </label>
                                            <label>
                                            {{ Form::radio('target', '_self', false) }}
                                            当前页面
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    广告时间
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    <div class="input-group input-large date-picker input-daterange" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control" name="published_from">
                                        <span class="input-group-addon"> 到 </span>
                                        <input type="text" class="form-control" name="published_to"> 
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    排序
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('order', $order, ['class' => 'form-control', 'autocomplete' => 'true']) }}
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
            //icheck
            $('input').iCheck({
                radioClass: 'iradio_flat-green'
            });
        })
    </script>
@stop
