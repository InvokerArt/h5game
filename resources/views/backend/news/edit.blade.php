@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/global/vendor/jstree/themes/default/style.min.css')}}">
    <link rel="stylesheet" href="{{ asset('js/vendor/fancybox/jquery.fancybox.css') }}">
@stop

@section('content')
{{ Form::model($news, ['route' => [env('APP_BACKEND_PREFIX').'.news.update', $news], 'method' => 'PATCH', 'id' => 'edit-news']) }}
    <div id="poststuff">
        <div class="left-body-content">
            <div class="news-body">
                <div class="form-group">
                    <input type="text" name="title" class="form-control" placeholder="在此输入资讯标题" value="{{ $news->title }}">
                </div>
                {{-- <div class="inside">
                    <div id="edit-slug-box" class="hide-if-no-js"> <strong>固定链接：</strong>
                        <span id="sample-permalink">
                            {{ env('APP_URL').'news/' }}
                            <span id="editable-post-name">
                                <input type="text" id="slug" class="form-control" name="slug" autocomplete="off" value="{{ str_replace(env('APP_URL').'news/', '', $news->slug) }}"></span>
                        </span>
                    </div>
                </div> --}}
                <div class="form-group margin-top-15">
                    <textarea name="subtitle" class="form-control" placeholder="在此输入资讯简介">{{ $news->subtitle }}</textarea>
                    <span class="help-block">字数建议控制在100字以内</span>
                </div>
                <div class="form-group">
                    <textarea name="content" id="editor" class="form-control">{{ $news->content }}</textarea>
                </div>
            </div>
        </div>
        <div class="right-sidebar">
            <div class="box margin-bottom-15">
                <h2>
                    <span>发布</span>
                </h2>
                <div class="inside">
                    <input type="text" name="published_at" class="form-control date-timepicker" placeholder="发布时间" value="{{ $news->published_at }}">
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
                    <span>分类目录</span>
                </h2>
                <div class="inside news-categories">
                </div>
                <input type="hidden" name="categories_id" id="categories">
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
                    <span>标签</span>
                </h2>
                <div class="inside">
                    <div>
                        <input type="text" class="form-control newtag" autocomplete="off">
                        <input type="hidden" name="tag" class="tag" value="{{ implode(',', $newsTags) }}">
                        <button type="button" class="btn add-tag pull-right">添加</button>
                        <p class="help-block">多个标签请用英文逗号（,）分开</p>
                    </div>
                    <div class="tagchecklist">
                        @foreach ($newsTags as $key => $value)
                        <span>
                        <a class="ntdelbutton"><i class="icon-close"></i></a>&nbsp;{{ $value }}
                        </span>
                        @endforeach
                    </div>
                    <div class="hide-if-no-js">
                        <a href="javascript:;" class="tagcloud-link" id="link-post_tag">从常用标签中选择</a>
                        <p id="tagcloud-post_tag" class="the-tagcloud">
                        </p>
                    </div>
                </div>
            </div>
            <div class="box margin-bottom-15">
                <h2>
                    <span>特色图片</span>
                </h2>
                <div class="inside">
                    <input type="hidden" name="image" class="thumbnail" id="image" value="{{ $news->image }}">
                    <div class="image-value-show" @if(!$news->image)style="display: none"@endif>
                        <a href="/filemanager/dialog.php?type=1&field_id=image" class="update-thumbnail iframe-btn">
                            <img class="img img-responsive" id="page-image-preview" style="width:100%" src="{{ $news->image }}">
                        </a>
                        <p class="help-block" id="how-to">点击图片来修改或更新</p>
                        <p class="help-block">
                            <a href="javascript:;" class="news-thumbnail">移除特色图片</a>
                        </p>
                    </div>
                    <div class="image-value-first" @if($news->image)style="display: none"@endif>
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
            $('.select2').select2({
                placeholder: "从常用标签中选择"
            })

            //分类目录
            $('.news-categories').jstree({
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
                            return "{{ route(env('APP_BACKEND_PREFIX').'.news.categories.children') }}"
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
                var categoriesElms = $('.news-categories').jstree("get_selected", true);
                $.each(categoriesElms, function() {
                    categories.push(this.id);
                });
                $('#categories').val(categories);
            })
            .bind("loaded.jstree", function (event, data) {
                $('.news-categories').jstree("open_all");
            })
            .bind("ready.jstree", function (event, data) {
                $('.news-categories').find("li").each(function() {
                    for (var i = 0; i < checkNodeIds.length; i++) {
                        if ($(this).attr("id") == checkNodeIds[i]) {
                            $('.news-categories').jstree("check_node", $(this));
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

        //获取常用标签
        $('.tagcloud-link').on('click', function (){
            if ($(this).hasClass('has')) {
                $('.the-tagcloud').toggle();
            } else {
                var html = '';
                $.ajax({
                    url: '{{ route(env('APP_BACKEND_PREFIX').".tags.popular") }}',
                    success: function (data){
                        $.each(data, function(key, val){
                            html += '<a href="javascript:;" data-id="' + val.id + '" class="tag-link" title="' + val.news_count + '篇资讯">' + val.name + '</a>\n';
                        })
                        $('.tagcloud-link').addClass('has');
                        $('.the-tagcloud').html(html).show();

                    }
                })
            }
        });

        //添加标签
        $(document).on('click', '.the-tagcloud a,.add-tag', function (){
            var tag_name = $('.tag').val().split(',');
            if ($(this).hasClass('add-tag')) {
                var text = $('.newtag').val();
                $('.newtag').val('');
            } else {
                var text = $(this).text();
            }
            var html = '';
            if ($.inArray(text, tag_name) < 0) {
                if (tag_name.length && $('.tag').val()) {
                    $('.tag').val(tag_name.join(',') + ',' +text);
                } else {
                    $('.tag').val(text);
                }
                html += '<span>';
                html += '<a class="ntdelbutton"><i class="icon-close"></i></a>&nbsp;'+text;
                html += '</span>';
                $('.tagchecklist').append(html);
            } else {
                $('.newtag').focus();
            }
        });

        //删除标签
        $(document).on('click', '.ntdelbutton', function (){
            var tag_name = $('.tag').val().split(',');
            var text = $.trim($(this).closest('span').text());
            tag_name.splice($.inArray(text, tag_name), 1);
            if (tag_name.length) {
                $('.tag').val(tag_name.join(','));
            } else {
                $('.tag').val('');
            }
            $(this).closest('span').remove();
        });

        //媒体库逻辑
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>

    </script>
@stop