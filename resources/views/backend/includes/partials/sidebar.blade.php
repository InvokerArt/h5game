<!-- 侧边栏开始 -->
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <!-- 侧边菜单开始 -->
        <ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
            <li class="sidebar-search-wrapper hidden-xs">
                <!-- 快速搜索开始 -->
                {{-- <form class="sidebar-search sidebar-search-bordered sidebar-search-solid" action="extra_search.html" method="POST">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
                        </span>
                    </div>
                </form> --}}
                <!-- 快速搜索结束 -->
            </li>
            <li class="start {{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.dashboard'), 'active open') }}">
                <a href="{{ route(env('APP_BACKEND_PREFIX').'.dashboard') }}">
                    <i class="icon-home"></i>
                    <span class="title">首页</span>
                </a>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.news*') || if_route_pattern(env('APP_BACKEND_PREFIX').'.tag*') || if_route_pattern(env('APP_BACKEND_PREFIX').'.comments*'), 'active open') }}">
                <a href="javascript:;">
                    <i class="icon-pencil"></i>
                    <span class="title">行业资讯</span>
                    <span class="arrow{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.news*'), ' open') }}""></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ active_class(if_route_pattern([env('APP_BACKEND_PREFIX').'.news.index', env('APP_BACKEND_PREFIX').'.news.create', env('APP_BACKEND_PREFIX').'.news.edit'])) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.news.index') }}">资讯</a>
                    </li>
                    {{-- <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.news.comments*'), 'active open') }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.news.comments.index') }}">评论</a>
                    </li> --}}
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.tag*'), 'active open') }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.tag.index') }}">标签</a>
                    </li>
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.news.categories*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.news.categories.index') }}">分类</a>
                    </li>
                </ul>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.media.index'), 'active open') }}">
                <a href="{{ route(env('APP_BACKEND_PREFIX').'.media.index') }}">
                    <i class="icon-folder-alt"></i>
                    <span class="title">媒体库</span>
                </a>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.banner*'), 'active open') }}">
                <a href="javascript:;">
                    <i class="icon-screen-desktop"></i>
                    <span class="title">广告管理</span>
                    <span class="arrow{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.banner*'), ' open') }}"></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.banner.image*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.banner.image.index') }}">广告</a>
                    </li>
                    <li class="{{ active_class(if_route_pattern([env('APP_BACKEND_PREFIX').'.banner.index', env('APP_BACKEND_PREFIX').'.banner.create', env('APP_BACKEND_PREFIX').'.banner.edit'])) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.banner.index') }}">广告位</a>
                    </li>
                </ul>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.notification*'), 'active open') }}">
                <a href="{{ route(env('APP_BACKEND_PREFIX').'.notification.index') }}">
                    <i class="icon-bell"></i>
                    <span class="title">推送管理</span>
                </a>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.user*'), 'active open') }}">
                <a href="{{ route(env('APP_BACKEND_PREFIX').'.user.index') }}">
                    <i class="icon-people"></i>
                    <span class="title">会员管理</span>
                </a>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.access*'), 'active open') }}">
                <a href="javascript:;">
                    <i class="icon-user-following"></i>
                    <span class="title">管理员管理</span>
                    <span class="arrow{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.access*'), ' open') }}"></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.access.admin*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.access.admin.index') }}">管理员</a>
                    </li>
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.access.role*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.access.role.index') }}">角色管理</a>
                    </li>
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.access.permission*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.access.permission.index') }}">权限管理</a>
                    </li>
                </ul>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.feedback*'), 'active open') }}">
                <a href="{{ route(env('APP_BACKEND_PREFIX').'.feedback.index') }}">
                    <i class="icon-info"></i>
                    <span class="title">消息反馈</span>
                </a>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.faq*'), 'active open') }}">
                <a href="{{ route(env('APP_BACKEND_PREFIX').'.faq.index') }}">
                    <i class="icon-question"></i>
                    <span class="title">常见问题</span>
                </a>
            </li>
            @role(('root'))
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'log-viewer*'), 'active open') }} last">
                <a href="javascript:;">
                    <i class="icon-settings"></i>
                    <span class="title">系统管理</span>
                    <span class="arrow{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'log-viewer*'), ' open') }}"></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.log-viewer::dashboard') }}">主页</a>
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.log-viewer::logs.list') }}">日志</a>
                    </li>
                </ul>
            </li>
            @endauth
        </ul>
        <!-- 侧边菜单结束 -->
    </div>
</div>
<!-- 侧边栏结束