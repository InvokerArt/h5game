@extends('backend.layouts.app')

@section('content')
<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="portlet-title">
        <div class="actions">
            <a href="{{ route(env('APP_BACKEND_PREFIX').'.users.create') }}" class="btn green btn-info">
                <i class="fa fa-plus"></i>
                <span class="hidden-xs">新建</span>
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-container">
            <table class="table table-striped table-bordered table-hover" id="users-table">
                <thead>
                <tr role="row" class="heading">
                    <th class="check-column">
                        <input type="checkbox" class="group-checkable">
                    </th>
                    <th class="column-id">ID</th>
                    <th>手机号</th>
                    <th>用户名</th>
                    <th>邮箱</th>
                    <th class="column-date">注册时间</th>
                    <th class="column-actions">操作</th>
                </tr>
                <tr role="row" class="filter">
                    <td>
                    </td>
                    <td>
                        <input type="text" class="form-control form-filter input-sm" name="id">
                    </td>
                    <td>
                        <input type="text" class="form-control form-filter input-sm" name="mobile">
                    </td>
                    <td>
                        <input type="text" class="form-control form-filter input-sm" name="username">
                    </td>
                    <td>
                        <input type="text" class="form-control form-filter input-sm" name="email">
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
                src: $('#users-table'),
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
                        url: '{{ route(env("APP_BACKEND_PREFIX").".users.get") }}',
                    },
                    columns: [
                        {data: 'ids', name: 'ids',"orderable": false,"searchable": false},
                        {data: 'id', name: 'id',"orderable": true,"searchable": true},
                        {data: 'mobile', name: 'mobile',"orderable": true,"searchable": true},
                        {data: 'username', name: 'username',"orderable": true,"searchable": true},
                        {data: 'email', name: 'email',"orderable": true,"searchable": true},
                        {data: 'created_at', name: 'created_at',"orderable": true,"searchable": true},
                        {data: 'actions', name: 'actions', orderable: false, searchable: false}
                    ],
                    "lengthMenu": [[20, 40, 100, -1], [20, 40, 100, "全部"]],
                    "order": [
                        ['1', "desc"]
                    ],
                    "pageLength": 20,
                }
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
                var text = (link.attr('data-trans-text')) ? link.attr('data-trans-text') : "你确定要删除这个项目吗？";

                swal({
                    title: title,
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