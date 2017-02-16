@extends('backend.layouts.app')

@section('content')
<div class="portlet">
    <div class="portlet-body">
        <div class="tabbable-bordered">
            <div class="tab-content">
                <div class="row">
                    <div class="col-xs-2">
                        {{ Form::model($tag, ['route' => [env('APP_BACKEND_PREFIX').'.tags.update', $tag], 'method' => 'PATCH', 'id' => 'edit-user']) }}
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="在此输入标签名称" value="{{ $tag->name }}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block green pull-right margin-top-10">
                                <i class="fa fa-edit"></i>
                                编辑标签
                            </button>
                        </div>
                        {{ Form::close() }}
                    </div>
                    <div class="col-xs-10">
                        <div class="table-container">
                            <form method="POST" id="search-form" class="form-inline" role="form">
                                <table class="table table-striped table-bordered table-hover" id="tags-table">
                                    <thead>
                                        <tr role="row" class="heading">
                                            <th class="check-column">
                                                <input type="checkbox" class="group-checkable">
                                            </th>
                                            <th class="column-id">ID</th>
                                            <th>名称</th>
                                            <th class="column-posts">总数</th>
                                            <th class="column-date">创建日期</th>
                                            <th class="column-actions">操作</th>
                                        </tr>
                                        <tr role="row" class="filter">
                                            <td>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" name="id">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" name="name">
                                            </td>
                                            <td>
                                            </td>
                                            <td>
                                                <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                                    <input type="text" class="form-control form-filter input-sm" readonly="" name="created_from" placeholder="开始时间">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-sm default" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                                <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                                    <input type="text" class="form-control form-filter input-sm" readonly="" name="created_to" placeholder="结束时间">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-sm default" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="margin-bottom-5">
                                                    <button class="btn btn-sm green btn-outline filter-submit margin-bottom" type="submit"><i class="fa fa-search"></i>搜索</button>
                                                </div>
                                                <button class="btn btn-sm red btn-outline filter-cancel"><i class="fa fa-times"></i>重置</button>
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
    <script>
        $(function() {
            $.fn.dataTableExt.oStdClasses.sWrapper = "dataTables_wrapper";
            var grid = new Datatable();
            grid.init({
                src: $('#tags-table'),
                dataTable: {
                    serverSide: true,
                    bFilter: false,
                    bStateSave: true,
                    filterApplyAction: "filter",
                    filterCancelAction: "filter_cancel",
                    resetGroupActionInputOnSuccess: true,
                    orderCellsTop: true,
                    pagingType: "bootstrap_extended",
                    autoWidth: false,
                    ajax: {
                        url: '{{ route(env('APP_BACKEND_PREFIX').".tags.get") }}',
                    },
                    columns: [
                        {data: 'ids', name: '',"orderable": false,"searchable": false},
                        {data: 'id', name: '',"orderable": true,"searchable": true},
                        {data: 'name', name: '',"orderable": true,"searchable": true},
                        {data: 'news_count', name: '',"orderable": true,"searchable": false},
                        {data: 'created_at', name: '',"orderable": true,"searchable": true},
                        {data: 'actions', name: '', orderable: false, searchable: false}
                    ],
                    "lengthMenu": [[20, 40, 100, -1], [20, 40, 100, "全部"]],
                    "order": [
                        [1, "asc"]
                    ],
                    "pageLength": 20,
                }
            });

            $('.filter-submit').on('click', function(e) {
                $('#search-form').submit(function(){
                    grid.draw();
                    e.preventDefault();
                })
            });
            
            $(document).ajaxComplete(function(){
                Customer.addDeleteForms();
            });

            /**
             * 删除操作
             */
            $('body').on('submit', 'form[name=delete_item]', function(e){
                e.preventDefault();
                var form = this;
                var link = $('a[data-method="delete"]');
                var cancel = (link.attr('data-trans-button-cancel')) ? link.attr('data-trans-button-cancel') : "返回";
                var confirm = (link.attr('data-trans-button-confirm')) ? link.attr('data-trans-button-confirm') : "确定";
                var title = (link.attr('data-trans-title')) ? link.attr('data-trans-title') : "警告";
                var text = (link.attr('data-trans-text')) ? link.attr('data-trans-text') : "你确定要删除这个标签吗？";

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
                    if (confirmed)
                        form.submit();
                });
            });
        })
    </script>
@stop