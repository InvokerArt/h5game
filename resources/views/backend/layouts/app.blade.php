<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'O2OMobile管理中心')</title>
    <!-- Meta -->
    <meta name="description" content="@yield('meta_description', 'O2OMobile管理中心')">
    <meta name="author" content="@yield('meta_author', 'btan')">
    @yield('meta')

    <link rel="shortcut icon" href="/favicon.ico"/>
    <!-- Styles -->
    @yield('before-styles-end')
    {!! Html::style(mix('css/backend/default.css'),['id'=>'style_color']) !!}
    {{--     {!! Html::style(mix('css/backend/components.css'),['id'=>'style_components']) !!} --}}
    @yield('after-styles-end')
    @yield('css')
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid @if(isset($_COOKIE['sidebar_status']) && $_COOKIE['sidebar_status'] == 'hide') page-sidebar-closed @endif">
    @include('backend.includes.partials.header')
    <div class="clearfix"></div>
    <!-- 容器开始 -->
    <div class="page-container">
        @include('backend.includes.partials.sidebar')
        <!-- 内容开始 -->
        <div class="page-content-wrapper">
            <div class="page-content">
                <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">Modal title</h4>
                            </div>
                            <div class="modal-body">
                                Widget settings form goes here
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn blue">Save changes</button>
                                <button type="button" class="btn default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                @include('backend.includes.partials.customizer')
                @include('backend.includes.partials.page-header')
                <h1 class="page-title">@yield('page-title')</h1>
                @include('backend.includes.partials.messages')
                <!-- 页面内容开始-->
                <div class="row">
                    <div class="col-md-12">
                        @yield('content')
                    </div>
                </div>
                <!-- 页面内容结束-->
            </div>
        </div>
        <!-- 内容结束 -->
        @include('backend.includes.partials.quickSidebar')
    </div>
    <!-- 容器结束 -->
    @include('backend.includes.partials.footer')
    <!-- JavaScripts -->
    <script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="{{asset('js/vendor/jquery/jquery-2.2.4.min.js')}}"><\/script>')</script>
    @yield('before-scripts-end')
    {!! HTML::script(mix('js/backend.js')) !!}
    @yield('after-scripts-end')
    @yield('js')
</body>
</html>