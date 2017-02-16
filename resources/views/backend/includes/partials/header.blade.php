<!-- 头部开始 -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- LOGO开始 -->
        <div class="page-logo">
            <a href="/admin">
                <img src="{!! asset('images/logo.png') !!}" alt="logo" class="logo-default"/>环保降解袋
            </a>
            <!-- 侧边栏切换开关开始 -->
            <div class="menu-toggler sidebar-toggler">
                <span></span>
            </div>
            <!-- 侧边栏切换结束 -->
        </div>
        <!-- LOGO结束 -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- END TODO DROPDOWN -->
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <li class="dropdown dropdown-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <span class="username"> {{ auth('admin')->user()->name }} </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route(env('APP_BACKEND_PREFIX').'.auth.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="icon-lock"></i>
                                退出
                            </a>
                            <form id="logout-form" action="{{ route(env('APP_BACKEND_PREFIX').'.auth.logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                <!-- END QUICK SIDEBAR TOGGLER -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- 头部结束 -->