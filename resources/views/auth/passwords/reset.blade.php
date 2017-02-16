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
        <form class="forget-form" role="form" method="POST" action="{{ url('/password/reset') }}">
            {{ csrf_field() }}
            <input type="hidden" name="token" value="{{ $token }}">

            <h3>重置密码</h3>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label visible-ie8 visible-ie9">邮箱</label>

                <div class="input-icon">
                    <input id="email" type="email" class="form-control" placeholder="邮箱" name="email" value="{{ $email or old('email') }}" autofocus>
                </div>

                @if ($errors->has('email'))
                    <span class="help-block">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="control-label visible-ie8 visible-ie9">密码</label>

                <div class="input-icon">
                    <input id="password" type="password" class="form-control" placeholder="密码" name="password">
                </div>

                @if ($errors->has('password'))
                    <span class="help-block">
                        {{ $errors->first('password') }}
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password-confirm" class="control-label visible-ie8 visible-ie9">确认密码</label>
                <div class="input-icon">
                    <input id="password-confirm" type="password" class="form-control" placeholder="确认密码" name="password_confirmation">
                </div>

                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        {{ $errors->first('password_confirmation') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-block green">
                    重置
                </button>
            </div>
        </form>
    </div>
</body>
</html>
                    