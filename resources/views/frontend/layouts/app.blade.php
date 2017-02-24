<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico"/>
    <title>{{ app_name() }}</title>
    <meta name="keywords" content="H5游戏,最新H5游戏,免费游戏">
    <meta name="descriptions" content="H5游戏平台是国内H5游戏最全最好玩的门户网站">
    <!-- Styles -->
    <link href="{{ mix('css/frontend/app.css') }}" rel="stylesheet">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-light bg-faded rounded navbar-toggleable-md">
            <div class="container">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleContainer" aria-controls="navbarsExampleContainer" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">{{ app_name() }}</a>
                <div class="collapse navbar-collapse" id="navbarsExampleContainer">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/') }}">首页 <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                    <ul class="nav justify-content-end navbar-nav">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">登录</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/register') }}">注册</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        退出
                                    </a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @yield('content')
                </div>
            </div>
        </div>

        <!-- JavaScripts -->
        <script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
        <script src="{{ asset('js/frontend/bootstrap.min.js') }}"></script>
        @yield('js')
    </div>
</body>
</html>
