@extends('backend.layouts.app')

@section('content')
<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="portlet-title">
        <div class="actions">
            <a href="{{ route(env('APP_BACKEND_PREFIX').'.replies.create') }}" class="btn green">
                <i class="fa fa-plus-square-o"></i>
                <span class="hidden-xs">添加回复</span>
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-container">
            <form method="POST" role="form">
                <table class="table table-striped table-bordered table-hover" id="replies-table">
                    <thead>
                    <tr role="row" class="heading">
                        <th class="check-column">
                            <input type="checkbox" class="group-checkable">
                        </th>
                        <th class="column-id">ID</th>
                        <th class="column-author">用户</th>
                        <th>回复</th>
                        <th class="column-response">回复至</th>
                        <th class="column-blocked">屏蔽</th>
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
                            <input type="text" class="form-control form-filter input-sm" name="username">
                        </td>
                        <td>
                            <input type="text" class="form-control form-filter input-sm" name="content">
                        </td>
                        <td>
                            <input type="text" class="form-control form-filter input-sm" name="title">
                        </td>
                        <td>
                            <select name="is_blocked" class="form-control form-filter input-sm select2">
                                <option value="">请选择</option>
                                <option value="yes"> 是 </option>
                                <option value="no"> 否 </option>
                            </select>
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
                src: $('#replies-table'),
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
                        url: '{{ route(env('APP_BACKEND_PREFIX').".replies.get") }}'
                    },
                    columns: [
                        {data: 'ids',"orderable": false,"searchable": false},
                        {data: 'id',"orderable": true,"searchable": true},
                        {data: 'username',"orderable": false,"searchable": true},
                        {data: 'content',"orderable": true,"searchable": true},
                        {data: 'title',"orderable": true,"searchable": true},
                        {data: 'is_blocked', name: 'is_blocked',"orderable": false,"searchable": true},
                        {data: 'created_at',"orderable": true,"searchable": true},
                        {data: 'actions', orderable: false, searchable: false}
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