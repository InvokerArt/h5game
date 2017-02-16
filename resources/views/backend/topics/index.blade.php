@extends('backend.layouts.app')

@section('content')
<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="portlet-title">
        <div class="actions">
            <a href="{{ route(env('APP_BACKEND_PREFIX').'.topics.create') }}" class="btn green">
                <i class="fa fa-plus-square-o"></i>
                <span class="hidden-xs">添加话题</span>
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-container">
            <form method="POST" role="form">
                <table class="table table-striped table-bordered table-hover" id="topics-table">
                    <thead>
                    <tr role="row" class="heading">
                        <th class="check-column">
                            <input type="checkbox" class="group-checkable">
                        </th>
                        <th class="column-id">ID</th>
                        <th>标题</th>
                        <th class="column-author">用户</th>
                        <th class="column-category">分类</th>
                        <th class="column-excellent">推荐</th>
                        <th class="column-blocked">屏蔽</th>
                        <th class="column-reply">回复</th>
                        <th class="column-vote">点赞</th>
                        <th class="column-date">发布日期</th>
                        <th class="column-actions">操作</th>
                    </tr>
                    <tr role="row" class="filter">
                        <td>
                        </td>
                        <td>
                            <input type="text" class="form-control form-filter input-sm" name="id">
                        </td>
                        <td>
                            <input type="text" class="form-control form-filter input-sm" name="title">
                        </td>
                        <td>
                            <input type="text" class="form-control form-filter input-sm" name="username">
                        </td>
                        <td>
                            <select name="category" class="form-control form-filter input-sm select2">
                                <option value="">请选择</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="is_excellent" class="form-control form-filter input-sm select2">
                                <option value="">请选择</option>
                                <option value="yes"> 是 </option>
                                <option value="no"> 否 </option>
                            </select>
                        </td>
                        <td>
                            <select name="is_blocked" class="form-control form-filter input-sm select2">
                                <option value="">请选择</option>
                                <option value="yes"> 是 </option>
                                <option value="no"> 否 </option>
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                            <div class="input-group date margin-bottom-5">
                                <input type="text" class="form-control form-filter input-sm date-timepicker" readonly="" name="created_from" placeholder="开始时间">
                                <span class="input-group-btn">
                                    <button class="btn btn-sm default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                            <div class="input-group date">
                                <input type="text" class="form-control form-filter input-sm date-timepicker" readonly="" name="created_to" placeholder="结束时间">
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
@stop

@section('js')
    <script>
        $(function() {
            $.fn.dataTableExt.oStdClasses.sWrapper = "dataTables_wrapper";
            var grid = new Datatable();
            grid.init({
                src: $('#topics-table'),
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
                        url: '{{ route(env('APP_BACKEND_PREFIX').".topics.get") }}'
                    },
                    columns: [
                        {data: 'ids', name: 'ids',"orderable": false,"searchable": false},
                        {data: 'id', name: 'id',"orderable": true,"searchable": true},
                        {data: 'title', name: 'title',"orderable": true,"searchable": true},
                        {data: 'username', name: 'username',"orderable": false,"searchable": true},
                        {data: 'category', name: 'category',"orderable": false,"searchable": true},
                        {data: 'is_excellent', name: 'is_excellent',"orderable": false,"searchable": true},
                        {data: 'is_blocked', name: 'is_blocked',"orderable": false,"searchable": true},
                        {data: 'reply_count', name: 'reply_count',"orderable": true,"searchable": false},
                        {data: 'vote_count', name: 'vote_count',"orderable": true,"searchable": false},
                        {data: 'created_at', name: 'created_at',"orderable": true,"searchable": true},
                        {data: 'actions', name: '', orderable: false, searchable: false}
                    ],
                    "lengthMenu": [[20, 40, 100, -1], [20, 40, 100, "全部"]],
                    "order": [
                        [1, "desc"]
                    ],
                    "pageLength": 20
                }
            });
            
            $(document).ajaxComplete(function(){
                Customer.addDeleteForms();
            });

        })
    </script>
@stop