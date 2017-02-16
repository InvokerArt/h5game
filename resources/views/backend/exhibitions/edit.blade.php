@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/global/vendor/jstree/themes/default/style.min.css')}}">
    <link rel="stylesheet" href="{{ asset('js/vendor/fancybox/jquery.fancybox.css') }}">
@stop

@section('content')
{{ Form::model($exhibition, ['route' => [env('APP_BACKEND_PREFIX').'.exhibitions.update', $exhibition], 'method' => 'PATCH', 'id' => 'edit-exhibition']) }}
    <div id="poststuff">
        <div class="left-body-content">
            <div class="exhibition-body">
                <div class="form-group">
                    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => '在此输入展会标题']) }}
                </div>
                {{-- <div class="inside">
                    <div id="edit-slug-box" class="hide-if-no-js"> <strong>固定链接：</strong>
                        <span id="sample-permalink">
                            {{ env('APP_URL').'exhibition/' }}
                            <span id="editable-post-name">
                                <input type="text" id="slug" class="form-control" name="slug" autocomplete="off" value="{{ str_replace(env('APP_URL').'exhibition/', '', $exhibition->slug) }}"></span>
                        </span>
                    </div>
                </div> --}}
                <div class="form-group margin-top-15">
                    {{ Form::textarea('subtitle', null, ['class' => 'form-control', 'placeholder' => '在此输入展会简介', 'rows' => '3']) }}
                    <span class="help-block">字数建议控制在100字以内</span>
                </div>
                <div class="form-group">
                    <textarea name="content" id="editor" class="form-control">{{ $exhibition->content }}</textarea>
                </div>
            </div>
        </div>
        <div class="right-sidebar">
            <div class="box margin-bottom-15">
                <h2>
                    <span>发布</span>
                </h2>
                <div class="inside">
                    {{ Form::text('published_at', null, ['class' => 'form-control date-timepicker', 'placeholder' => '发布时间']) }}
                    <button href="javascript:;" class="btn btn-default  margin-top-10">
                        <i class="fa fa-eye"></i>
                        预览 
                    </button>
                    <button href="javascript:;" class="btn green pull-right margin-top-10">
                        <i class="fa fa-edit"></i>
                        发布 
                    </button>
                </div>
            </div>
            <div class="box margin-bottom-15">
                <h2>
                    <span>首页置顶</span>
                </h2>
                <div class="inside">
                    {{ Form::select('is_excellent', ['yes' => '是', 'no' => '否'], null, ['class' => 'form-control select2', 'placeholder' => '是否首页置顶']) }}
                </div>
            </div>
            <div class="box margin-bottom-15">
                <h2>
                    <span>联系方式</span>
                </h2>
                <div class="inside">
                    {{ Form::text('telephone', null, ['class' => 'form-control margin-bottom-15', 'placeholder' => '联系电话']) }}
                    {{ Form::text('address', null, ['class' => 'form-control', 'placeholder' => '展会地址']) }}
                </div>
            </div>
            <div class="box margin-bottom-15">
                <h2>
                    <span>分类目录</span>
                </h2>
                <div class="inside exhibition-categories">
                </div>
                <input type="hidden" name="categories_id" id="categories">
            </div>
            <div class="box margin-bottom-15">
                <h2>
                    <span>特色图片</span>
                </h2>
                <div class="inside">
                    {{ Form::hidden('image', null, ['class' => 'thumbnail', 'id' => 'image']) }}
                    <div class="image-value-show" @if(!$exhibition->image)style="display: none"@endif>
                        <a href="/filemanager/dialog.php?type=1&field_id=image" class="update-thumbnail iframe-btn">
                            <img class="img img-responsive" id="page-image-preview" style="width:100%" src="{{ $exhibition->image }}">
                        </a>
                        <p class="help-block" id="how-to">点击图片来修改或更新</p>
                        <p class="help-block">
                            <a href="javascript:;" class="news-thumbnail">移除特色图片</a>
                        </p>
                    </div>
                    <div class="image-value-first" @if($exhibition->image)style="display: none"@endif>
                        <p class="help-block">
                            <a href="/filemanager/dialog.php?type=1&field_id=image" class="iframe-btn">添加特色图片</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{ Form::close() }}
@stop

@section('js')
    @include('UEditor::head')
    <script type="text/javascript" src="{{ asset('js/vendor/fancybox/jquery.fancybox.pack.js') }}"></script>
    <script src="{{asset('js/jstree.min.js')}}"></script>
    <script type="text/javascript">
        $(function(){
            // 图片管理
            $('.iframe-btn').fancybox({
                'type'      : 'iframe',
                'autoSize'  : false,
                beforeLoad : function() {
                    this.width  = 900;
                    this.height = 600;
                },
                afterClose: function(event) {
                    $baseImagePath = $('.thumbnail').val().replace("{{ env('APP_URL') }}", "");
                    $('.thumbnail').val($baseImagePath);
                    $('.img-responsive').attr('src', $('.thumbnail').val());
                    $('.image-value-show').show();
                    $('.image-value-first').hide();
                }
            });

            $('.news-thumbnail').on('click', function(){
                $('.thumbnail').val('');
                $('.image-value-show').hide();
                $('.image-value-first').show();
            })

            var checkNodeIds = "{{ implode(',', $categories) }}".split(",");

            //分类目录
            $('.exhibition-categories').jstree({
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
                            return "{{ route(env('APP_BACKEND_PREFIX').'.exhibitions.categories.children') }}"
                        },
                        data: function(e) {
                            return {
                                parent: e.id,
                                disabled: 1
                            }
                        }
                    }
                },
                'plugins': ["wholerow", "checkbox", "types"]
            })
            .on("changed.jstree", function (e, data){
                var categories = [];
                var categoriesElms = $('.exhibition-categories').jstree("get_selected", true);
                $.each(categoriesElms, function() {
                    categories.push(this.id);
                });
                $('#categories').val(categories);
            })
            .bind("loaded.jstree", function (event, data) {
                $('.exhibition-categories').jstree("open_all");
            })
            .bind("ready.jstree", function (event, data) {
                $('.exhibition-categories').find("li").each(function() {
                    for (var i = 0; i < checkNodeIds.length; i++) {
                        if ($(this).attr("id") == checkNodeIds[i]) {
                            $('.exhibition-categories').jstree("check_node", $(this));
                        }
                    }
                });
            });
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

        //媒体库逻辑
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
@stop