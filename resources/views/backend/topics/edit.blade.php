@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/global/vendor/jstree/themes/default/style.min.css')}}">
@stop

@section('content')
{{ Form::model($topic, ['route' => [env('APP_BACKEND_PREFIX').'.topics.update', $topic], 'method' => 'PATCH', 'id' => 'edit-topic']) }}
    <div id="poststuff">
        <div class="left-body-content">
            <div class="topics-body">
                <div class="form-group">
                    {{ Form::text('title', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::textarea('content', null, ['class' => 'form-control', 'id' => 'editor']) }}
                </div>
            </div>
        </div>
        <div class="right-sidebar">
            <div class="box margin-bottom-15">
                <h2>
                    <span>话题属性</span>
                </h2>
                <div class="inside">
                    <div class="form-group">
                        <label class="control-label">用户</label>
                        {{ Form::select('user_id', [$topic->user_id => $topic->username], $topic->user_id, ['class' => 'form-control user-ajax']) }}
                    </div>
                    <div class="form-group">
                        <label class="control-label">分类</label>
                        <div class="form-control height-auto">
                            <div class="categories-topics">
                            </div>
                            {{ Form::hidden('category_id', null, ['class' => 'form-control', 'id' => 'categories']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">是否推荐</label>
                        {{ Form::select('is_excellent', ['' => '请选择', 'yes' => '是','no' => '否'], null, ['class' => 'form-control input-sm select2']) }}
                    </div>
                    <div class="form-group">
                        <label class="control-label">是否屏蔽</label>
                        {{ Form::select('is_blocked', ['' => '请选择', 'yes' => '是','no' => '否'], null, ['class' => 'form-control input-sm select2']) }}
                    </div>
                    <div class="form-group">
                        <label class="control-label">查看数</label>
                        {{ Form::text('view_count', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <label class="control-label">回复数</label>
                        {{ Form::text('reply_count', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <label class="control-label">赞数</label>
                        {{ Form::text('vote_count', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <button href="javascript:;" class="btn green btn-block margin-top-10">
                            <i class="fa fa-edit"></i>
                            发布 
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{ Form::close() }}
@stop

@section('js')
    @include('UEditor::head')
    <script src="{{asset('js/jstree.min.js')}}"></script>
    <script type="text/javascript">
        $(function(){

            //分类选中
            var checkNodeIds = {{ $topic->category_id }};

            //分类目录
            $('.categories-topics').jstree({
                core: {
                    multiple: false,
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
                            return "{{ route(env('APP_BACKEND_PREFIX').'.topics.categories.children') }}"
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
                var categoriesElms = $('.categories-topics').jstree("get_selected", true);
                $.each(categoriesElms, function() {
                    categories.push(this.id);
                });
                $('#categories').val(categories);
            })
            .bind("loaded.jstree", function (event, data) {
                $('.categories-topics').jstree("open_all");
            })
            .bind("ready.jstree", function (event, data) {
                $('.categories-topics').find("li").each(function() {
                    if ($(this).attr("id") == checkNodeIds) {
                        $('.categories-topics').jstree("check_node", $(this));
                    }
                });
            });
            
            //用户资料
            function formatUser(user) {
                if (user.loading) return user.text;
                var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__avatar'><img src='" + user.avatar + "' /></div>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" + user.mobile + "</div>";
                if (user.username) {
                    markup += "<div class='select2-result-repository__description'>用户名：" + user.username + "</div>";
                }
                markup += "</div></div>";
                return markup;
            }

            function formatUserSelection(user) {
                return user.username || user.mobile || user.text;
            }
            $.fn.select2.defaults.set("theme", "bootstrap");
            $(".user-ajax").select2({
                ajax: {
                    url: "{{ route(env('APP_BACKEND_PREFIX').'.users.ajax.info') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, page) {
                        return {
                            results: data.data
                        };
                    },
                    cache: true
                },
                escapeMarkup: function(markup) {
                    return markup;
                }, // let our custom formatter work
                minimumInputLength: 1,
                templateResult: formatUser,
                templateSelection: formatUserSelection
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

    </script>
@stop
