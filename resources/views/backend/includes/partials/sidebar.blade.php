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
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.news*') || if_route_pattern(env('APP_BACKEND_PREFIX').'.tags*') || if_route_pattern(env('APP_BACKEND_PREFIX').'.comments*'), 'active open') }}">
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
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.tags*'), 'active open') }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.tags.index') }}">标签</a>
                    </li>
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.news.categories*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.news.categories.index') }}">分类</a>
                    </li>
                </ul>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.exhibitions*'), 'active open') }}">
                <a href="javascript:;">
                    <i class="icon-globe"></i>
                    <span class="title">展会信息</span>
                    <span class="arrow{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.exhibitions*'), ' open') }}"></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ active_class(if_route_pattern([env('APP_BACKEND_PREFIX').'.exhibitions.index', env('APP_BACKEND_PREFIX').'.exhibitions.create', env('APP_BACKEND_PREFIX').'.exhibitions.edit'])) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.exhibitions.index') }}">展会</a>
                    </li>
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.exhibitions.categories*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.exhibitions.categories.index') }}">分类</a>
                    </li>
                </ul>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.media.index'), 'active open') }}">
                <a href="{{ route(env('APP_BACKEND_PREFIX').'.media.index') }}">
                    <i class="icon-folder-alt"></i>
                    <span class="title">媒体库</span>
                </a>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.banners*'), 'active open') }}">
                <a href="javascript:;">
                    <i class="icon-screen-desktop"></i>
                    <span class="title">广告管理</span>
                    <span class="arrow{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.banners*'), ' open') }}"></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.banners.image*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.banners.image.index') }}">广告</a>
                    </li>
                    <li class="{{ active_class(if_route_pattern([env('APP_BACKEND_PREFIX').'.banners.index', env('APP_BACKEND_PREFIX').'.banners.create', env('APP_BACKEND_PREFIX').'.banners.edit'])) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.banners.index') }}">广告位</a>
                    </li>
                </ul>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.topics*') || if_route_pattern(env('APP_BACKEND_PREFIX').'.replies*'), 'active open') }}">
                <a href="{{ route(env('APP_BACKEND_PREFIX').'.topics.index') }}">
                    <i class="icon-support"></i>
                    <span class="title">论坛管理</span>
                    <span class="arrow{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.topics*') || if_route_pattern(env('APP_BACKEND_PREFIX').'.replies*'), ' open') }}"></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ active_class(if_route_pattern([env('APP_BACKEND_PREFIX').'.topics.index', env('APP_BACKEND_PREFIX').'.topics.create', env('APP_BACKEND_PREFIX').'.topics.edit'])) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.topics.index') }}">话题</a>
                    </li>
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.replies*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.replies.index') }}">回复</a>
                    </li>
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.topics.categories*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.topics.categories.index') }}">分类</a>
                    </li>
                </ul>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.companies*') || if_route_pattern(env('APP_BACKEND_PREFIX').'.jobs*') || if_route_pattern(env('APP_BACKEND_PREFIX').'.joins*') || if_route_pattern(env('APP_BACKEND_PREFIX').'.certifications*') || if_route_pattern(env('APP_BACKEND_PREFIX').'.products*') || if_route_pattern(env('APP_BACKEND_PREFIX').'.demands*') || if_route_pattern(env('APP_BACKEND_PREFIX').'.supplies*'), 'active open') }}">
                <a href="javascript:;">
                    <i class="icon-briefcase"></i>
                    <span class="title">公司管理</span>
                    <span class="arrow{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.companies*') || if_route_pattern(env('APP_BACKEND_PREFIX').'.jobs*') || if_route_pattern(env('APP_BACKEND_PREFIX').'.joins*') || if_route_pattern(env('APP_BACKEND_PREFIX').'.certifications*') || if_route_pattern(env('APP_BACKEND_PREFIX').'.products*') || if_route_pattern(env('APP_BACKEND_PREFIX').'.demands*') || if_route_pattern(env('APP_BACKEND_PREFIX').'.supplies*'), ' open') }}"></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ active_class(if_route_pattern([env('APP_BACKEND_PREFIX').'.companies.index', env('APP_BACKEND_PREFIX').'.companies.create', env('APP_BACKEND_PREFIX').'.companies.edit'])) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.companies.index') }}">公司</a>
                    </li>
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.jobs*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.jobs.index') }}">招聘</a>
                    </li>
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.joins*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.joins.index') }}">加盟</a>
                    </li>
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.certifications*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.certifications.index') }}">认证</a>
                    </li>
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.products*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.products.index') }}">产品</a>
                    </li>
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.demands*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.demands.index') }}">需求</a>
                    </li>
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.supplies*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.supplies.index') }}">供应</a>
                    </li>
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.companies.categories*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.companies.categories.index', 'role=1') }}">分类</a>
                    </li>
                </ul>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.notifications*'), 'active open') }}">
                <a href="{{ route(env('APP_BACKEND_PREFIX').'.notifications.index') }}">
                    <i class="icon-bell"></i>
                    <span class="title">推送管理</span>
                </a>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.users*'), 'active open') }}">
                <a href="{{ route(env('APP_BACKEND_PREFIX').'.users.index') }}">
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
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.feedbacks*'), 'active open') }}">
                <a href="{{ route(env('APP_BACKEND_PREFIX').'.feedbacks.index') }}">
                    <i class="icon-info"></i>
                    <span class="title">消息反馈</span>
                </a>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.faqs*'), 'active open') }}">
                <a href="{{ route(env('APP_BACKEND_PREFIX').'.faqs.index') }}">
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