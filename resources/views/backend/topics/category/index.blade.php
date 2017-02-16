@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/global/vendor/jstree/themes/default/style.min.css')}}">
@stop

@section('content')

<div class="portlet">
    <div class="note note-danger no-margin margin-bottom-10">右键点击分类进行添加、删除、移动分类，想要更新某一个分类则左键点击选中后，在右边编辑相信信息，然后点击更新按钮完成更新分类。</div>
    <div class="portlet-body">
    <div class="tabbable-bordered">
        <div class="tab-content">
            <div class="row">
                <div class="col-xs-2">
                    <div id="category_tree"></div>
                </div>
                <div class="col-xs-10 category-new">
                    {!! Form::model($category,['route' => [env('APP_BACKEND_PREFIX').'.topics.categories.update', $category->id], 'id' => 'category','class'=>'form-horizontal','method' => 'PATCH','enctype'=>'multipart/form-data']) !!}
                    <div class="form-group">
                        <label class="col-xs-2 control-label">
                            名称
                            <span class="required">*</span>
                        </label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" name="name" placeholder="名称" value="{!! $category->name !!}">
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label class="col-xs-2 control-label">激活
                            <span class="required">*</span>
                        </label>
                        <div class="col-xs-7">
                            {!! Form::select('is_active', [1=>'是',0=>'否'], null, ['class' => 'select2 form-control','style'=>'width: 100%']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label">链接
                            <span class="required">*</span>
                        </label>
                        <div class="col-xs-7">
                            {!! Form::text('slug', old('slug') ? old('slug') : $category->slug, ['class' => 'form-control','placeholder'=>'链接']) !!}
                            <span class="help-block">“链接”是在URL中使用的，通常使用小写，只能包含字母，数字和连字符（-）。</span>
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <label class="col-xs-2 control-label">描述</label>
                        <div class="col-xs-7">
                            {!! Form::textarea('description', $category->description, ['class' => 'form-control','id' => 'editor','placeholder'=>'描述','rows'=>'4']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-7 col-xs-offset-2">
                            <button class="btn btn-success" type="submit">
                                <i class="fa fa-check"></i>
                                更新
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@stop

@section('js')
    <script src="{{asset('js/jstree.min.js')}}"></script>
    <script>
        $(function () {
            $("#category_tree").jstree({
                core: {
                    strings: { 
                        loading: "加载中 ...",
                        new_node: "新分类"
                    },
                    themes: {
                        responsive: false
                    },
                    check_callback: true,
                    data: {
                        url: function(e) {
                            return "{{ route(env('APP_BACKEND_PREFIX').'.topics.categories.children') }}"
                        },
                        data: function(e) {
                            return {
                                parent: e.id
                            }
                        }
                    }
                },
                force_text : true,
                plugins: ["dnd", "types","unique",'contextmenu','wholerow'],
                contextmenu:{
                    "items": function($node) {
                        var tree = $("#category_tree").jstree(true);
                        return {
                            "Create": {
                                "separator_before": false,
                                "separator_after": false,
                                "label": "创建分类",
                                "action": function (obj) {
                                    $node = tree.create_node($node);
                                    tree.edit($node);
                                }
                            },
                            "Rename": {
                                "separator_before": false,
                                "separator_after": false,
                                "label": "重命名",
                                "action": function (obj) {
                                    tree.edit($node);
                                }
                            },
                            "Delete": {
                                "separator_before": false,
                                "separator_after": false,
                                "label": "删除分类",
                                "action": function (obj) {
                                    tree.delete_node($node);
                                }
                            },
                            "Move": {
                                "separator_before": false,
                                "separator_after": false,
                                "label": "移动分类",
                                "action": function (obj) {
                                    tree.move_node($node);
                                }
                            }
                        };
                    }
                },
                types : {
                    default : {
                        icon : "fa fa-folder icon-lg icon-state-warning"
                    }
                }
            })
            .on('delete_node.jstree', function (e, data) {
                $.post("/{{ env('APP_BACKEND_PREFIX') }}/topics/categories/"+data.node.id, { '_method' : 'delete', '_token' : '{{ csrf_token() }}' })
                        .fail(function () {
                            data.instance.refresh();
                        })
                        .done(function () {
                            //swal("", "删除成功！", "success");
                        });
            })
            .on('create_node.jstree', function (e, data) {
                $.post("{{ route(env('APP_BACKEND_PREFIX').'.topics.categories.store') }}", { 'id' : data.node.parent, 'name' : data.node.text, '_token' : '{{ csrf_token() }}' })
                        .done(function (d) {
                            data.instance.set_id(data.node, d.id);
                            //swal("", "创建成功！", "success");
                        })
                        .fail(function () {
                            data.instance.refresh();
                        })
            })
            .on('rename_node.jstree', function (e, data) {
                $.post("{{ route(env('APP_BACKEND_PREFIX').'.topics.categories.rename') }}", { 'id' : data.node.id, 'name' : data.text, '_token' : '{{ csrf_token() }}' })
                        .fail(function () {
                            data.instance.refresh();
                        })
                        .done(function () {
                            //swal("", "重命名成功！", "success");
                        });
            })
            .on('move_node.jstree', function (e, data) {
                $.post("{{ route(env('APP_BACKEND_PREFIX').'.topics.categories.move') }}", { 'id' : data.node.id, 'parent' : data.parent, '_token' : '{{ csrf_token() }}' })
                        .fail(function () {
                            data.instance.refresh();
                        })
                        .done(function () {
                            //swal("", "移动成功！", "success");
                        });
            })
            .on('changed.jstree', function (e, data) {
                if(data && data.selected && data.selected.length) {
                    $.get('?id=' + data.selected.join(':'), function (d) {
                        $('.category-new').html($(d).find('.category-new').html());
                    });
                }
            })
        })
    </script>
@stop