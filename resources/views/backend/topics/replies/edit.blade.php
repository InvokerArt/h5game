@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/global/vendor/jstree/themes/default/style.min.css')}}">
@stop

@section('content')
{{ Form::model($reply, ['route' => [env('APP_BACKEND_PREFIX').'.replies.update', $reply], 'method' => 'PATCH', 'id' => 'edit-reply']) }}
    {{ Form::hidden('parent_id', $reply->id) }}
    <div id="poststuff">
        <div class="left-body-content">
            <div class="replies-body">
                <div class="form-group">
                    {{ Form::textarea('content', null, ['class' => 'form-control', 'id' => 'editor']) }}
                </div>
            </div>
        </div>
        <div class="right-sidebar">
            <div class="box margin-bottom-15">
                <h2>
                    <span>回复属性</span>
                </h2>
                <div class="inside">
                    <div class="form-group">
                        <label class="control-label">用户</label>
                        {{ Form::select('user_id', [$reply->user_id => $reply->username], $reply->user_id, ['class' => 'form-control user-ajax']) }}
                    </div>
                    <div class="form-group">
                        <label class="control-label">话题</label>
                        {{ Form::select('topic_id', [$reply->topic_id => $reply->title], $reply->topic_id, ['class' => 'form-control topic-ajax', 'readonly' => true]) }}
                    </div>
                    <div class="form-group">
                        <label class="control-label">是否屏蔽</label>
                        {{ Form::select('is_blocked', ['' => '请选择', 'yes' => '是','no' => '否'], 'no', ['class' => 'form-control input-sm select2']) }}
                    </div>
                    <div class="form-group">
                        <label class="control-label">赞数</label>
                        {{ Form::text('vote_count', 0, ['class' => 'form-control']) }}
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
