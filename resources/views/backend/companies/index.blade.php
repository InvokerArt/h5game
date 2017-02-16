@extends('backend.layouts.app')

@section('page-title')
    公司
@stop
@section('content')
<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="portlet-title">
        <div class="actions">
            <a href="{{ route(env('APP_BACKEND_PREFIX').'.companies.create') }}" class="btn green">
                <i class="fa fa-plus-square-o"></i>
                <span class="hidden-xs">添加公司</span>
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-container">
            <form method="POST" role="form">
                <table class="table table-striped table-bordered table-hover" id="companies-table">
                    <thead>
                    <tr role="row" class="heading">
                        <th class="check-column">
                            <input type="checkbox" class="group-checkable">
                        </th>
                        <th class="column-id">ID</th>
                        <th>公司名</th>
                        <th class="column-categories">公司类型</th>
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
                            <select name="role" class="form-control form-filter input-sm select2">
                                <option value="">请选择</option>
                                <option value="1">采购商</option>
                                <option value="2">供应商</option>
                                <option value="3">机构/单位</option>
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
                src: $('#companies-table'),
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
                        url: '{{ route(env('APP_BACKEND_PREFIX').".companies.get") }}'
                    },
                    columns: [
                        {data: 'ids', name: 'ids',"orderable": false,"searchable": false},
                        {data: 'id', name: 'id',"orderable": true,"searchable": true},
                        {data: 'name', name: 'name',"orderable": true,"searchable": true},
                        {data: 'role', name: 'role',"orderable": false,"searchable": true},
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