@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/global/vendor/jstree/themes/default/style.min.css')}}">
@stop

@section('page-title')
编辑公司
@stop

@section('content')
    <div class="portlet light portlet-fit portlet-form bordered" id="form_wizard">
        <div class="portlet-body">
            {{ Form::model($company, ['route' => [env('APP_BACKEND_PREFIX').'.companies.update', $company], 'class' => 'form-horizontal', 'method' => 'PATCH', 'id' => 'submit_form']) }}
            <div class="form-wizard" id="company">
                <div class="form-body">
                    <ul class="nav nav-pills nav-justified steps">
                        <li class="active">
                            <a href="#tab1" data-toggle="tab" class="step active" aria-expanded="true">
                                <span class="number"> 1 </span>
                                <span class="desc">
                                    <i class="fa fa-check"></i>基本信息
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab2" data-toggle="tab" class="step">
                                <span class="number"> 2 </span>
                                <span class="desc">
                                    <i class="fa fa-check"></i>公司营业执照
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab3" data-toggle="tab" class="step">
                                <span class="number"> 3 </span>
                                <span class="desc">
                                    <i class="fa fa-check"></i>公司照片
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab4" data-toggle="tab" class="step">
                                <span class="number"> 4 </span>
                                <span class="desc">
                                    <i class="fa fa-check"></i>确定
                                </span>
                            </a>
                        </li>
                    </ul>
                    <div id="bar" class="progress progress-striped" role="progressbar">
                        <div class="progress-bar progress-bar-success"> </div>
                    </div>
                    <div class="tab-content">
                        <div class="alert alert-danger display-none error-message">
                            <button class="close" data-dismiss="alert"></button> 请完成必填项信息输入！
                        </div>
                        <div class="alert alert-success display-none success-message">
                            <button class="close" data-dismiss="alert"></button> 您的表单验证成功！
                        </div>
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
                                    {{ Form::text('username', null, ['class' => 'form-control', 'autocomplete' => 'true', 'readonly' => true]) }}
                                    <span class="help-block"><a href="{{ route(env('APP_BACKEND_PREFIX').'.users.edit', $company->user_id) }}" class="user-info" target="_blank">会员资料</a></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    公司名
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'true']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    主营分类
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    <div class="form-control height-auto">
                                        <div class="categories-companies"></div>
                                    </div>
                                    <input type="hidden" name="categories" id="categories">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    公司电话
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-3">
                                    {{ Form::text('telephone', null, ['class' => 'form-control', 'autocomplete' => 'true']) }}
                                </div>
                            </div>
                            <div class="form-group">
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
                                    加盟须知
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::textarea('notes', null, ['class' => 'form-control', 'autocomplete' => 'true', 'rows' => '5']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    公司简介
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::textarea('content', null, ['class' => 'form-control editor', 'autocomplete' => 'true', 'id' => 'editor']) }}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <div id="uploader_licenses" class="text-align-reverse margin-bottom-10">
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
                                    <div class="alert added-files alert-success" id="uploaded_file_{{ $key }}">
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
                        <div class="tab-pane" id="tab3">
                            <div id="uploader_photos" class="text-align-reverse margin-bottom-10">
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
                                    <div class="alert added-files alert-success" id="uploaded_file_{{ $key }}">
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
                        <div class="tab-pane" id="tab4">
                            <h3 class="block">确认公司信息</h3>
                            <h4 class="form-section">基本信息</h4>
                            <div class="form-group">
                                <label class="control-label col-md-3">所属会员用户名:</label>
                                <div class="col-md-4">
                                    <p class="form-control-static" data-display="username"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">公司名:</label>
                                <div class="col-md-4">
                                    <p class="form-control-static" data-display="name"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">公司类型:</label>
                                <div class="col-md-4">
                                    <p class="form-control-static" data-display="role"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">公司电话:</label>
                                <div class="col-md-4">
                                    <p class="form-control-static" data-display="telephone"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">公司地址:</label>
                                <div class="col-md-4">
                                    <p class="form-control-static" data-display="address"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">主营分类:</label>
                                <div class="col-md-4">
                                    <p class="form-control-static" data-display="categories"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">加盟须知:</label>
                                <div class="col-md-4">
                                    <p class="form-control-static" data-display="notes"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">公司简介:</label>
                                <div class="col-md-4">
                                    <p class="form-control-static" data-display="content"></p>
                                </div>
                            </div>
                            <h4 class="form-section">公司营业执照</h4>
                            <div class="form-group">
                                <label class="control-label col-md-3">公司营业执照:</label>
                                <div class="col-md-4">
                                    <p class="form-control-static" data-display="licenses[]"></p>
                                </div>
                            </div>
                            <h4 class="form-section">公司照片</h4>
                            <div class="form-group">
                                <label class="control-label col-md-3">公司照片:</label>
                                <div class="col-md-4">
                                    <p class="form-control-static" data-display="photos[]"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-10">
                            <a href="javascript:;" class="btn default button-previous disabled" style="display: none;">
                                <i class="fa fa-angle-left"></i>返回</a>
                            <a href="javascript:;" class="btn btn-outline green button-next">
                                下一步
                                <i class="fa fa-angle-right"></i>
                            </a>
                            <a href="javascript:;" class="btn green button-submit" style="display: none;">
                                提交
                                <i class="fa fa-check"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
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
            $('#location').location({
                address:{!! $location !!}
            });
            $('input').iCheck({
                radioClass: 'iradio_flat-green'
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
                    categories.push(this.id);
                });
                $('#categories').val(categories);
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

            if (!jQuery().bootstrapWizard) {
                return;
            }

            var form = $('#submit_form');
            var error = $('.error-message', form);
            var success = $('.success-message', form);
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
                    success.hide();
                    error.show();
                    Theme.scrollTo(error, -200);
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
                    error.hide();
                    form.submit();
                    //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
                }

            });

            var displayConfirm = function() {
                $('#tab4 .form-control-static', form).each(function(){
                    var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                    if (input.is(":radio")) {
                        input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                    }
                    if (input.is(":text") || input.is("textarea")) {
                        $(this).html(input.val());
                    } else if (input.is("select")) {
                        $(this).html(input.find('option:selected').text());
                    } else if (input.is(":radio") && input.is(":checked")) {
                        $(this).html(input.attr("data-title"));
                    }  else if ($(this).attr("data-display") == 'address') {
                        $(this).html($('#city-title').html());
                    } else if ($(this).attr("data-display") == 'licenses[]') {
                        var licenses = [];
                        $('[name="licenses[]"]', form).each(function(){ 
                            licenses.push('<img src="' + $(this).val() + '" style="width:30px;margin-right:5px"/>');
                        });
                        $(this).html(licenses.join(""));
                    } else if ($(this).attr("data-display") == 'photos[]') {
                        var photos = [];
                        $('[name="photos[]"]', form).each(function(){
                            photos.push('<img src="' + $(this).val() + '" style="width:30px;margin-right:5px"/>');
                        });
                        $(this).html(photos.join(""));
                    } else if($(this).attr("data-display") == 'categories') {
                        var categories = [];
                        var categories_id = $('#categories').val().split(',');
                        $.each(categories_id, function(key, value) {
                            categories.push($('#'+value).text());
                        })
                        $(this).html(categories.join("<br>"));
                    }
                });
            }

            var handleTitle = function(tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', $('#form_wizard')).text('Step ' + (index + 1) + ' of ' + total);
                // set done steps
                jQuery('li', $('#form_wizard')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if (current == 1) {
                    $('#form_wizard').find('.button-previous').hide();
                } else {
                    $('#form_wizard').find('.button-previous').show();
                }

                if (current >= total) {
                    $('#form_wizard').find('.button-next').hide();
                    $('#form_wizard').find('.button-submit').show();
                    displayConfirm();
                } else {
                    $('#form_wizard').find('.button-next').show();
                    $('#form_wizard').find('.button-submit').hide();
                }
                Theme.scrollTo($('.page-title'));
            }
            
            // default form wizard
            $('#form_wizard').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function (tab, navigation, index, clickedIndex) {
                    return false;
                    
                    success.hide();
                    error.hide();
                    if (form.valid() == false) {
                        return false;
                    }
                    
                    handleTitle(tab, navigation, clickedIndex);
                },
                onNext: function (tab, navigation, index) {
                    success.hide();
                    error.hide();
                    if (form.valid() == false) {
                        return false;
                    }

                    handleTitle(tab, navigation, index);
                },
                onPrevious: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    handleTitle(tab, navigation, index);
                },
                onTabShow: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    $('#form_wizard').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $('#form_wizard').find('.button-previous').hide();
            $('#form_wizard .button-submit').click(function () {
                $('#submit_form').submit();
            }).hide();
        })

        //执照
        var link = $('a[data-method="delete"]');
        var cancel = (link.attr('data-trans-button-cancel')) ? link.attr('data-trans-button-cancel') : "返回";
        var confirm = (link.attr('data-trans-button-confirm')) ? link.attr('data-trans-button-confirm') : "确定";
        var title = (link.attr('data-trans-title')) ? link.attr('data-trans-title') : "警告";
        var text = (link.attr('data-trans-text')) ? link.attr('data-trans-text') : "你确定要删除图片吗？删除后一定要提交，不然会导致找不到图片！！！";
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
                        var event = $(this);
                        var src = $(this).parents('.added-files').find('img').attr('src');
                        swal({
                            title: title,
                            text: text,
                            type: "warning",
                            showCancelButton: true,
                            cancelButtonText: cancel,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: confirm,
                            closeOnConfirm: true
                        }, function(confirmed) {
                            if (confirmed) {
                                $.post(
                                    "{{ route('upload.company') }}", 
                                    { 
                                        '_method' : 'delete', 
                                        '_token' : '{{ csrf_token() }}', 
                                        'url' : src 
                                    }
                                );
                                licenses.removeFile(event.parents('.added-files').attr("id"));    
                                event.parents('.added-files').remove();
                            }
                        });                     
                    });
                },
         
                FilesAdded: function(up, files) {
                    plupload.each(files, function(file) {
                        $('#licenses_uploader_filelist').append('<div class="alert alert-warning added-files" id="uploaded_file_' + file.id + '"><div class="filename new" style="line-height: 32px;overflow: hidden;">' + file.name + '(' + plupload.formatSize(file.size) + ') <span class="status label label-info"></span>&nbsp;<a href="javascript:;" class="remove pull-right btn btn-sm red"><i class="fa fa-times"></i> 删除</a></div></div>');
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
                        var event = $(this);
                        var src = $(this).parents('.added-files').find('img').attr('src');
                        swal({
                            title: title,
                            text: text,
                            type: "warning",
                            showCancelButton: true,
                            cancelButtonText: cancel,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: confirm,
                            closeOnConfirm: true
                        }, function(confirmed) {
                            if (confirmed) {
                                $.post(
                                    "{{ route('upload.company') }}", 
                                    { 
                                        '_method' : 'delete', 
                                        '_token' : '{{ csrf_token() }}', 
                                        'url' : src 
                                    }
                                );
                                licenses.removeFile(event.parents('.added-files').attr("id"));    
                                event.parents('.added-files').remove();
                            }
                        });                     
                    });
                },
         
                FilesAdded: function(up, files) {
                    plupload.each(files, function(file) {
                        $('#photos_uploader_filelist').append('<div class="alert alert-warning added-files" id="uploaded_file_' + file.id + '"><div class="filename new" style="line-height: 32px;overflow: hidden;">' + file.name + '(' + plupload.formatSize(file.size) + ') <span class="status label label-info"></span>&nbsp;<a href="javascript:;" class="remove pull-right btn btn-sm red"><i class="fa fa-times"></i> 删除</a></div></div>');
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