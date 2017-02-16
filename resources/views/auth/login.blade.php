<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'O2Ousername管理中心')</title>
    <!-- Meta -->
    <meta name="description" content="@yield('meta_description', 'O2Ousername管理中心')">
    <meta name="author" content="@yield('meta_author', 'btan')">
    @yield('meta')

    <link rel="shortcut icon" href="favicon.ico"/>
    <!-- Styles -->
    @yield('before-styles-end')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/global/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/global/vendor/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
    @yield('after-styles-end')
    @yield('css')
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class=" login">
    <div class="logo">
        <a href="/">
            <img src="{{ asset('images/logo-big.png') }}" alt=""> 
        </a>
    </div>
    <div class="content">
        <form class="login-form" role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <h3 class="form-title">登录</h3>
            <div class="alert alert-danger{{ $errors->has('username') || $errors->has('password') ? '' : ' hide' }}">
                <button type="button" class="close" data-dismiss="alert"></button>
                <ul>
                    @if ($errors->first('username')) 
                        <li>{{ $errors->first('username') }}</li> 
                    @endif

                    @if ($errors->first('password')) 
                        <li>{{ $errors->first('password') }}</li>
                    @endif
                </ul>
            </div>
            <div class="form-group">
                <label for="username" class="control-label visible-ie8 visible-ie9">账户</label>

                <div class="input-icon">
                    <i class="fa fa-user"></i>
                    <input id="username" type="username" class="form-control" name="username" placeholder="手机号/会员名/邮箱" value="{{ old('username') }}" autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="control-label visible-ie8 visible-ie9">密码</label>

                <div class="input-icon">
                    <i class="fa fa-lock"></i>
                    <input id="password" type="password" class="form-control" name="password" placeholder="密码">
                </div>
            </div>

            <div class="form-actions">
                <label class="checkbox">
                    <div class="checker">
                        <span>
                            <input type="checkbox" name="remember" value="">
                        </span>
                    </div> 记住我
                </label>
                <a id="forget-password" class="pull-right" href="{{ url('/password/reset') }}">忘记密码？</a>
            </div>

            <div class="form-group">
                <button type="submit" class="btn green btn-block">
                    登录
                </button>
            </div>

            <div class="create-account">
                <p> 没有账户？&nbsp;
                    <a id="register-btn" href="{{ url('/register') }}">立即注册</a>
                </p>
            </div>
        </form>
    </div>

    <!-- JavaScripts -->
    <script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="{{asset('js/vendor/jquery/jquery-2.2.4.min.js')}}"><\/script>')</script>
    <script>
        $(function(){
            $('.close').click(function(){
                $(this).parent('.display-show').hide();
            })
        })
    </script>
</body>
</html>