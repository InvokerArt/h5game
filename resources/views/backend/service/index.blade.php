@extends('backend.layouts.app')
@section('page_title')
    服务管理
@stop
@section('content')
<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="portlet-title">
        <div class="caption">
            服务
        </div>
        <div class="actions">
            <a href="javascript:;" class="btn btn-circle btn-info">
                <i class="fa fa-plus"></i>
                <span class="hidden-xs">新建</span>
            </a>
            <div class="btn-group">
                <a class="btn btn-circle btn-default dropdown-toggle" href="javascript:;" data-toggle="dropdown">
                    <i class="fa fa-share"></i>
                    <span class="hidden-xs">工具</span>
                    <i class="fa fa-angle-down"></i>
                </a>
                <div class="dropdown-menu pull-right">
                    <li>
                        <a href="javascript:;"> Export to Excel </a>
                    </li>
                    <li>
                        <a href="javascript:;"> Export to CSV </a>
                    </li>
                    <li class="divider"></li>
                </div>
            </div>
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-container">
            <div class="table-actions-wrapper">
                <span>
                </span>
                <select class="table-group-action-input form-control input-inline input-small input-sm">
                    <option value="">Select...</option>
                    <option value="Cancel">Cancel</option>
                    <option value="Cancel">Hold</option>
                    <option value="Cancel">On Hold</option>
                    <option value="Close">Close</option>
                </select>
                <button class="btn btn-sm yellow table-group-action-submit"><i class="fa fa-check"></i> Submit</button>
            </div>
            <table class="table table-striped table-bordered table-hover" id="service-table">
                <thead>
                <tr role="row" class="heading">
                    <th width="2%">
                        <input type="checkbox" class="group-checkable">
                    </th>
                    <th>ID</th>
                    <th>服务名字</th>
                    <th>服务图标</th>
                    <th>排序号</th>
                    <th>时间</th>
                    <th>操作</th>
                </tr>
                <tr role="row" class="filter">
                    <td>
                    </td>
                    <td>
                        <input type="text" class="form-control form-filter input-sm" name="ids">
                    </td>
                    <td>
                        <input type="text" class="form-control form-filter input-sm" name="name">
                    </td>
                    <td>
                    </td>
                    <td>
                        <div class="margin-bottom-5">
                            <input type="text" class="form-control form-filter input-sm" name="usort_from" placeholder="从"> 
                        </div>
                        <input type="text" class="form-control form-filter input-sm" name="usort_to" placeholder="到"> 
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
                            <button class="btn btn-sm green btn-outline filter-submit margin-bottom"><i class="fa fa-search"></i>搜索</button>
                        </div>
                        <button class="btn btn-sm red btn-outline filter-cancel"><i class="fa fa-times"></i>重置</button>
                    </td>
                </tr>
                </thead>
            </table>
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
                src: $('#service-table'),
                dataTable: {
                    // processing: true,
                    // serverSide: true,
                    // bFilter: false,
                    // bStateSave: true,
                    // filterApplyAction: "filter",
                    // filterCancelAction: "filter_cancel",
                    // resetGroupActionInputOnSuccess: true,
                    // orderCellsTop: true,
                    // pagingType: "bootstrap_extended",
                    // autoWidth: false,
                    // dom: "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r><'table-responsive't><'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                    ajax: {
                        url: '{{ route("admin.service.get") }}',
                    },
                    columns: [
                        {data: 'id', name: 'services.id',"orderable": false,"searchable": false},
                        {data: 'ids', name: 'services.ids',"orderable": true,"searchable": true},
                        {data: 'name', name: 'services.name',"orderable": true,"searchable": true},
                        {data: 'imgurl', name: 'services.imgurl',"orderable": false,"searchable": false},
                        {data: 'usort', name: 'services.usort',"orderable": true,"searchable": true},
                        {data: 'created_at', name: 'services.created_at',"orderable": true,"searchable": true},
                        {data: 'actions', name: 'actions', orderable: false, searchable: false}
                    ],
                    "language": {
                        //"url": "/js/vendor/datatables/language/Chinese.json"
                    },
                    "lengthMenu": [[20, 40, 100, -1], [20, 40, 100, "全部"]],
                    "order": [
                        [1, "desc"]
                    ],
                    "pageLength": 20,
                }
            });
        })
    </script>
@stop