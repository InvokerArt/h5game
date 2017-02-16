@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/global/vendor/jstree/themes/default/style.min.css')}}">
@stop

@section('page-title')
编辑公司
@stop

@section('content')
{{ Form::model($company, ['route' => [env('APP_BACKEND_PREFIX').'.companies.update', $company], 'class' => 'form-horizontal', 'method' => 'PATCH', 'id' => 'submit_form']) }}
    <div class="portlet">           
        <div class="portlet-title">
            <div class="actions btn-set">
                <button type="button" name="back" class="btn btn-secondary-outline" onclick="location.href='{{ route(env('APP_BACKEND_PREFIX').'.companies.index') }}'">
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
                    <div class="form-body">
                        <div class="tab-pane active" id="tab1">
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    公司类型
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                            <label>
                                            {{ Form::radio('role', 1, true) }}
                                            采购商
                                            </label>
                                            <label>
                                            {{ Form::radio('role', 2, false) }}
                                            供应商
                                            </label>
                                            <label>
                                            {{ Form::radio('role', 3, false) }}
                                            机构/单位
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    所属会员用户名
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::select('user_id', [$company->user_id => $company->username], $company->user_id, ['class' => 'form-control user-ajax']) }}
                                </div>
                            </div>
                            <div class="form-group" id="company">
                                <label class="col-md-2 control-label">
                                    公司名
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'true']) }}
                                </div>
                            </div>
                            <div class="form-group" id="category">
                                <label class="col-md-2 control-label">
                                    主营分类
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    <div class="form-control height-auto">
                                        <div class="categories-companies"></div>
                                    </div>
                                    <div id="categories">
                                        @foreach ($categories as $category)
                                            {{ Form::hidden('categories',$category) }}
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="telephone">
                                <label class="col-md-2 control-label">
                                    公司电话
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-3">
                                    {{ Form::text('telephone', null, ['class' => 'form-control', 'autocomplete' => 'true']) }}
                                </div>
                            </div>
                            <div class="form-group" id="address">
                                <label class="col-md-2 control-label">
                                    公司地址
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-3">
                                    <div id="location"></div>
                                    {{ Form::hidden('address', null, ['class' => 'form-control address', 'autocomplete' => 'true']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    详细地址
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-3">
                                    {{ Form::textarea('addressDetail', null, ['class' => 'form-control margin-top-10', 'autocomplete' => 'false', 'placeholder' => '建议您如实填写详细地址，例如街道名称，门牌号码，楼层和房间号等信息', 'rows' =>3]) }}
                                </div>
                            </div>
                            <div class="form-group" id="licenses">
                                <label class="col-md-2 control-label">
                                    公司营业执照
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    <div class="form-control height-auto">
                                        <div id="uploader_licenses">
                                            <a id="licenses_uploader_pickfiles" href="javascript:;" class="btn btn-success"> <i class="fa fa-plus"></i>
                                                选择图片
                                            </a>
                                            <a id="licenses_uploader_uploadfiles" href="javascript:;" class="btn btn-primary">
                                                <i class="fa fa-share"></i>
                                                上传图片
                                            </a>
                                        </div>
                                        <div class="row">
                                            <div id="licenses_uploader_filelist" class="col-md-12">
                                                @foreach ($company->licenses as $key => $license)
                                                <div class="alert added-files alert-success" id="uploaded_file_{{ $key }}" style="margin: 12px 0 0">
                                                    <a href="{{ $license }}" data-toggle="lightbox">
                                                        <img style="float:left;margin-right:10px;max-width:40px;max-height:32px;" src="{{ $license }}">
                                                    </a>
                                                    <input type="hidden" name="licenses[]" value="{{ $license }}">
                                                    <div class="filename new" style="line-height: 32px;overflow: hidden;">
                                                        <a href="javascript:;" class="remove pull-right btn btn-sm red"><i class="fa fa-times"></i> 删除</a>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="photos">
                                <label class="col-md-2 control-label">
                                    公司照片
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    <div class="form-control height-auto">
                                        <div id="uploader_photos">
                                            <a id="photos_uploader_pickfiles" href="javascript:;" class="btn btn-success"> <i class="fa fa-plus"></i>
                                                选择图片
                                            </a>
                                            <a id="photos_uploader_uploadfiles" href="javascript:;" class="btn btn-primary">
                                                <i class="fa fa-share"></i>
                                                上传图片
                                            </a>
                                        </div>
                                        <div class="row">
                                            <div id="photos_uploader_filelist" class="col-md-12">
                                                @foreach ($company->photos as $key => $photo)
                                                <div class="alert added-files alert-success" id="uploaded_file_{{ $key }}" style="margin: 12px 0 0">
                                                    <a href="{{ $photo }}" data-toggle="lightbox">
                                                        <img style="float:left;margin-right:10px;max-width:40px;max-height:32px;" src="{{ $photo }}">
                                                    </a>
                                                    <input type="hidden" name="photos[]" value="{{ $photo }}">
                                                    <div class="filename new" style="line-height: 32px;overflow: hidden;">
                                                        <a href="javascript:;" class="remove pull-right btn btn-sm red"><i class="fa fa-times"></i> 删除</a>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="notes">
                                <label class="col-md-2 control-label">
                                    加盟须知
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::textarea('notes', null, ['class' => 'form-control', 'autocomplete' => 'true', 'rows' => '5']) }}
                                </div>
                            </div>
                            <div class="form-group" id="content">
                                <label class="col-md-2 control-label">
                                    公司简介
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::textarea('content', null, ['class' => 'form-control editor', 'autocomplete' => 'true', 'id' => 'editor']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    是否推广
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::select('is_excellent', ['' => '请选择', 'yes' => '是','no' => '否'], null, ['class' => 'form-control input-sm select2']) }}
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
    <script src="{{asset('js/location.js')}}"></script>
    <script src="{{asset('js/vendor/plupload/plupload.full.min.js')}}"></script>
    <script src="{{asset('js/vendor/plupload/i18n/zh_CN.js')}}"></script>
    @include('UEditor::head')
    <script src="{{asset('js/jstree.min.js')}}"></script>
    {{-- {!! JsValidator::formRequest('App\Http\Requests\Backend\Companies\CompanyStoreOrUpdateRequest', '#submit_form') !!} --}}
    <script type="text/javascript">
        $(function(){
            function demandJoin() {
                $('#company .control-label').html('公司名 <span class="required" aria-required="true">*</span>');
                $('#category .control-label').html('主营分类 <span class="required" aria-required="true">*</span>');
                $('#telephone .control-label').html('公司电话 <span class="required" aria-required="true">*</span>');
                $('#address .control-label').html('公司地址 <span class="required" aria-required="true">*</span>');
                $('#licenses').show();
                $('#photos .control-label').html('公司照片 <span class="required" aria-required="true">*</span>');
                $('#notes .control-label').html('加盟须知 <span class="required" aria-required="true">*</span>');
                $('#content .control-label').html('公司简介 <span class="required" aria-required="true">*</span>');
            }
            function certification(){
                $('#company .control-label').html('单位名 <span class="required" aria-required="true">*</span>');
                $('#category .control-label').html('单位类别 <span class="required" aria-required="true">*</span>');
                $('#telephone .control-label').html('单位电话 <span class="required" aria-required="true">*</span>');
                $('#address .control-label').html('单位地址 <span class="required" aria-required="true">*</span>');
                $('#licenses').hide();
                $('#photos .control-label').html('单位照片 <span class="required" aria-required="true">*</span>');
                $('#notes .control-label').html('认证须知 <span class="required" aria-required="true">*</span>');
                $('#content .control-label').html('单位简介 <span class="required" aria-required="true">*</span>');
            }
            //地区插件
            $('#location').location({
                address:{!! $location !!}
            });
            //icheck
            $('input').iCheck({
                radioClass: 'iradio_flat-green'
            });
            if ($('[name="role"]:checked').val()  == 3) {
                certification();
            } else {
                demandJoin();
            }
            $('input').on('ifChecked', function(event){
                $('.categories-companies').jstree('refresh');
                if ($(this).val() == 3) {
                    certification();
                } else {
                    demandJoin();
                }
            });

            //分类选中
            var checkNodeIds = "{{ implode(',', $categories) }}".split(",");

            //分类
            var tree = $('.categories-companies').jstree({
                core: {
                    strings : { 
                        loading : "加载中 ..."
                    },
                    themes : {
                        responsive: false,
                        icons:false
                    },
                    check_callback: !0,
                    data: {
                        url: function(e) {
                            return "{{ route(env('APP_BACKEND_PREFIX').'.companies.categories.children') }}"
                        },
                        data: function(e) {
                            return {
                                parent: e.id,
                                role: $('[name="role"]:checked').val()
                            }
                        }
                    }
                },
                'plugins': ["wholerow", "checkbox", "types"]
            })
            .on("changed.jstree", function (e, data){
                var categories = [];
                var categoriesElms = $('.categories-companies').jstree("get_selected", true);
                $.each(categoriesElms, function() {
                    categories.push('<input type="hidden" value=' + this.id + ' name=categories[]>');
                });
                $('#categories').html('').html(categories);
            })
            .bind("loaded.jstree", function (event, data) {
                $('.categories-companies').jstree("open_all");
            })
            .bind("ready.jstree", function (event, data) {
                $('.categories-companies').find("li").each(function() {
                    for (var i = 0; i < checkNodeIds.length; i++) {
                        if ($(this).attr("id") == checkNodeIds[i]) {
                            $('.categories-companies').jstree("check_node", $(this));
                        }
                    }
                });
            });
            $('.radio-list input').on('ifChecked', function(event){
                $('.categories-companies').jstree('refresh');
            });

            var form = $('#submit_form');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);
            $.validator.setDefaults({ignore: ":hidden:not(#categories,.editor)"});
            form.validate({
                doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                rules: {
                    username: {
                        required: true
                    },
                    name: {
                        required: true
                    },
                    telephone: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    categories: {
                        required: true
                    },
                    notes: {
                        required: true
                    },
                    content: {
                        required: true
                    },
                },

                messages: { 
                    
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("name") == "categories_id") { // for uniform radio buttons, insert the after the given container
                        error.insertAfter("#form_gender_error");
                    } else if (element.attr("name") == "payment[]") { // for uniform checkboxes, insert the after the given container
                        error.insertAfter("#form_payment_error");
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit   
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    if (label.attr("for") == "主营分类") { // for checkboxes and radio buttons, no need to show OK icon
                        label
                            .closest('.form-group').removeClass('has-error').addClass('has-success');
                        label.remove(); // remove error label here
                    } else { // display success icon for other inputs
                        label
                            .addClass('valid') // mark the current input as valid and display OK icon
                        .closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    }
                },

                submitHandler: function (form) {
                    form.submit();
                    //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
                }

            });
        })

        //执照
        var licenses = new plupload.Uploader({
            // add X-CSRF-TOKEN in headers attribute to fix this issue
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            runtimes : 'html5,flash,silverlight,html4',
            browse_button : document.getElementById('licenses_uploader_pickfiles'), // you can pass in id...
            container: document.getElementById('uploader_licenses'), // ... or DOM Element itself
            url : "{{ route('upload.company') }}",
            filters : {
                max_file_size : '10mb',
                mime_types: [
                    {title : "图片文件", extensions : "jpg,jpeg,gif,png"}
                ]
            },
            flash_swf_url : "{{ asset("js/vendor/plupload/Moxie.swf") }}",
            silverlight_xap_url : '{{ asset("js/vendor/plupload/Moxie.xap") }}',          
         
            init: {
                PostInit: function() {
                    //$('#licenses_uploader_filelist').html("");
         
                    $('#licenses_uploader_uploadfiles').click(function() {
                        licenses.start();
                        return false;
                    });

                    $('#licenses_uploader_filelist').on('click', '.added-files .remove', function(){
                        var src = $(this).parents('.added-files').find('img').attr('src');
                        $.post(
                            "{{ route('upload.company') }}", 
                            { 
                                '_method' : 'delete', 
                                '_token' : '{{ csrf_token() }}', 
                                'url' : src 
                            }
                        );
                        licenses.removeFile($(this).parents('.added-files').attr("id"));    
                        $(this).parents('.added-files').remove();                     
                    });
                },
         
                FilesAdded: function(up, files) {
                    plupload.each(files, function(file) {
                        $('#licenses_uploader_filelist').append('<div class="alert alert-warning added-files" id="uploaded_file_' + file.id + '" style="margin:12px 0 0;"><div class="filename new" style="line-height: 32px;overflow: hidden;">' + file.name + '(' + plupload.formatSize(file.size) + ') <span class="status label label-info"></span>&nbsp;<a href="javascript:;" class="remove pull-right btn btn-sm red"><i class="fa fa-times"></i> 删除</a></div></div>');
                    });
                },
         
                UploadProgress: function(up, file) {
                    $('#uploaded_file_' + file.id + ' > .status').html(file.percent + '%');
                },

                FileUploaded: function(up, file, response) {
                    var response = $.parseJSON(response.response);

                    if (response.result && response.result.message == 'OK') {
                        var id = response.id; // uploaded file's unique name. Here you can collect uploaded file names and submit an jax request to your server side script to process the uploaded files and update the images tabke

                        $('#uploaded_file_' + file.id + ' .status').removeClass("label-info").addClass("label-success").html('<i class="fa fa-check"></i> 完成');
                        $('#uploaded_file_' + file.id).removeClass("alert-warning").addClass("alert-success").prepend('<a href="' + response.result.url + '" data-toggle="lightbox"><img style="float:left;margin-right:10px;max-width:40px;max-height:32px;" src="' + response.result.url + '"></a><input type="hidden" name="licenses[]" value="' + response.result.url + '"/>') // set successfull upload
                    } else {
                        $('#uploaded_file_' + file.id + ' > .status').removeClass("label-info").addClass("label-danger").html('<i class="fa fa-warning"></i> Failed'); // set failed upload
                        Theme.alert({type: 'danger', message: '其中一个上传失败。 请重试。', closeInSeconds: 10, icon: 'warning'});
                    }
                },
         
                Error: function(up, err) {
                    Theme.alert({type: 'danger', message: err.message, closeInSeconds: 10, icon: 'warning'});
                }
            }
        });
        licenses.init();

        //照片
        var photoer = new plupload.Uploader({
            // add X-CSRF-TOKEN in headers attribute to fix this issue
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            runtimes : 'html5,flash,silverlight,html4',
            browse_button : document.getElementById('photos_uploader_pickfiles'), // you can pass in id...
            container: document.getElementById('uploader_photos'), // ... or DOM Element itself
            url : "{{ route('upload.company') }}",
            filters : {
                max_file_size : '10mb',
                mime_types: [
                    {title : "图片文件", extensions : "jpg,jpeg,gif,png"}
                ]
            },
            flash_swf_url : "{{ asset("js/vendor/plupload/Moxie.swf") }}",
            silverlight_xap_url : '{{ asset("js/vendor/plupload/Moxie.xap") }}',          
         
            init: {
                PostInit: function() {
                    //$('#photos_uploader_filelist').html("");
         
                    $('#photos_uploader_uploadfiles').click(function() {
                        photoer.start();
                        return false;
                    });

                    $('#photos_uploader_filelist').on('click', '.added-files .remove', function(){
                        var src = $(this).parents('.added-files').find('img').attr('src');
                        $.post(
                            "{{ route('upload.company') }}", 
                            { 
                                '_method' : 'delete', 
                                '_token' : '{{ csrf_token() }}', 
                                'url' : src 
                            }
                        );
                        photoer.removeFile($(this).parents('.added-files').attr("id"));    
                        $(this).parents('.added-files').remove();                     
                    });
                },
         
                FilesAdded: function(up, files) {
                    plupload.each(files, function(file) {
                        $('#photos_uploader_filelist').append('<div class="alert alert-warning added-files" id="uploaded_file_' + file.id + '" style="margin:12px 0 0;"><div class="filename new" style="line-height: 32px;overflow: hidden;">' + file.name + '(' + plupload.formatSize(file.size) + ') <span class="status label label-info"></span>&nbsp;<a href="javascript:;" class="remove pull-right btn btn-sm red"><i class="fa fa-times"></i> 删除</a></div></div>');
                    });
                },
         
                UploadProgress: function(up, file) {
                    $('#uploaded_file_' + file.id + ' > .status').html(file.percent + '%');
                },

                FileUploaded: function(up, file, response) {
                    var response = $.parseJSON(response.response);

                    if (response.result && response.result.message == 'OK') {
                        var id = response.id; // uploaded file's unique name. Here you can collect uploaded file names and submit an jax request to your server side script to process the uploaded files and update the images tabke

                        $('#uploaded_file_' + file.id + ' .status').removeClass("label-info").addClass("label-success").html('<i class="fa fa-check"></i> 完成');
                        $('#uploaded_file_' + file.id).removeClass("alert-warning").addClass("alert-success").prepend('<a href="' + response.result.url + '" data-toggle="lightbox"><img style="float:left;margin-right:10px;max-width:40px;max-height:32px;" src="' + response.result.url + '"></a><input type="hidden" name="photos[]" value="' + response.result.url + '"/>') // set successfull upload
                    } else {
                        $('#uploaded_file_' + file.id + ' > .status').removeClass("label-info").addClass("label-danger").html('<i class="fa fa-warning"></i> Failed'); // set failed upload
                        Theme.alert({type: 'danger', message: '其中一个上传失败。 请重试。', closeInSeconds: 10, icon: 'warning'});
                    }
                },
         
                Error: function(up, err) {
                    Theme.alert({type: 'danger', message: err.message, closeInSeconds: 10, icon: 'warning'});
                }
            }
        });
        photoer.init();

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
        });
    </script>
    @stop