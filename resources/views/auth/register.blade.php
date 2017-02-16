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
        <form class="register-form" role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}
            <h3>注册</h3>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="control-label visible-ie8 visible-ie9">用户名</label>

                <div class="input-icon">
                    <i class="fa fa-user"></i>
                    <input id="name" type="text" class="form-control" placeholder="用户名" name="name" value="{{ old('name') }}" autofocus>
                </div>
                @if ($errors->has('name'))
                    <span class="help-block">
                        {{ $errors->first('name') }}
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label visible-ie8 visible-ie9">邮箱</label>

                <div class="input-icon">
                    <i class="fa fa-envelope"></i>
                    <input id="email" type="email" class="form-control" placeholder="邮箱" name="email" value="{{ old('email') }}">
                </div>
                @if ($errors->has('email'))
                    <span class="help-block">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                <label for="mobile" class="control-label visible-ie8 visible-ie9">手机</label>

                <div class="input-icon">
                    <i class="fa fa-mobile"></i>
                    <input id="mobile" type="tel" class="form-control" placeholder="手机" name="mobile" value="{{ old('mobile') }}">
                </div>

                <span class="help-block">
                    防止垃圾帐号(同一手机只能注册一个帐号)
                </span>
                @if ($errors->has('mobile'))
                    <span class="help-block">
                        {{ $errors->first('mobile') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                {!! Geetest::render() !!}
            </div>

            <div class="form-group{{ $errors->has('verifyCode') ? ' has-error' : '' }}">
                <label for="verifyCode" class="control-label visible-ie8 visible-ie9">手机验证码</label>
                <div class="row">
                    <div class="col-xs-7">
                        <div class="input-icon">
                            <i class="fa fa-check"></i>
                            <input id="verifyCode" type="text" class="form-control" placeholder="手机验证码" name="verifyCode">
                        </div>
                        @if ($errors->has('verifyCode'))
                            <span class="help-block">
                                {{ $errors->first('verifyCode') }}
                            </span>
                        @endif
                    </div>
                    <div class="col-xs-5">
                        <span class="help-block">
                            <a href="javascript:;" class="js-send">点击发送验证码</a>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="control-label visible-ie8 visible-ie9">密码</label>

                <div class="input-icon">
                    <i class="fa fa-lock"></i>
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
                    <i class="fa fa-check"></i>
                    <input id="password-confirm" type="password" class="form-control" placeholder="确认密码" name="password_confirmation">
                </div>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        {{ $errors->first('password_confirmation') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn green btn-block">
                    注册
                </button>
            </div>
        </form>
    </div>

    <!-- JavaScripts -->
    <script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="{{asset('js/vendor/jquery/jquery-2.2.4.min.js')}}"><\/script>')</script><script src="{{ asset('js/laravel-sms.js') }}"></script>
    <script>
        var captchaPass = false;
        $('.js-send').sms({
            //laravel csrf token
            token       : "{{csrf_token()}}",
            //请求间隔时间
            interval    : 60,
            //请求参数
            requestData : {
                //手机号
                mobile : function () {
                    return $('input[name=mobile]').val();
                },
                //手机号的检测规则
                mobile_rule : 'check_mobile_unique'
            }
        });
    </script>
</body>
</html>
