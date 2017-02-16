@if ($breadcrumbs)
    <ul class="page-breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!$breadcrumb->last)
                <li>
                    @if($breadcrumb->first)
                        <i class="fa fa-home"></i>
                        <i class="fa fa-angle-right"></i>
                    @else
                        <i class="fa fa-angle-right"></i>
                    @endif
                    <a href="{!! $breadcrumb->url !!}">
                        {!! $breadcrumb->title !!}
                    </a>
                </li>
            @else
                <li class="active">
                    @if($breadcrumb->first)
                        <i class="fa fa-home"></i>
                        <i class="fa fa-angle-right"></i>
                    @else
                        <i class="fa fa-angle-right"></i>
                    @endif
                    {!! $breadcrumb->title !!}
                </li>
            @endif
        @endforeach
    </ul>
    <div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="更改仪表盘日期范围">
            <i class="icon-calendar"></i>&nbsp;
            <span class="thin uppercase hidden-xs"></span>&nbsp;
            <i class="fa fa-angle-down"></i>
        </div>
    </div>
@endif