@extends('backend.layouts.app')

@section('content')
<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="portlet-title">
        <div class="actions">
            <a href="{{ route(env('APP_BACKEND_PREFIX').'.access.permission.create') }}" class="btn green btn-info">
                <i class="fa fa-plus"></i>
                <span class="hidden-xs">新建</span>
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-container">
            <table class="table table-striped table-bordered table-hover" id="roles-table">
                <thead>
                <tr role="row" class="heading">
                    <th>权限代码</th>
                    <th>权限名称</th>
                    <th>权限描述</th>
                    <th>操作</th>
                </tr>
                <tr role="row" class="filter">
                    <td>
                        <input type="text" class="form-control form-filter input-sm" name="name">
                    </td>
                    <td>
                        <input type="text" class="form-control form-filter input-sm" name="display_name">
                    </td>
                    <td>
                        <input type="text" class="form-control form-filter input-sm" name="description">
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
                src: $('#roles-table'),
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
                        url: '{{ route(env('APP_BACKEND_PREFIX').".access.permission.get") }}',
                    },
                    columns: [
                        {data: 'name', "orderable": true,"searchable": true},
                        {data: 'display_name', "orderable": false,"searchable": false},
                        {data: 'description', "orderable": true,"searchable": true},
                        {data: 'actions', orderable: false, searchable: false}
                    ],
                    "lengthMenu": [[20, 40, 100, -1], [20, 40, 100, "全部"]],
                    "order": [
                        [0, "desc"]
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
                var text = (link.attr('data-trans-text')) ? link.attr('data-trans-text') : "你确定要删除这个权限吗？";

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