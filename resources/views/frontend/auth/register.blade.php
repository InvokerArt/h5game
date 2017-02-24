@extends('frontend.layouts.app')

@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="card" style="margin-top: 25px;">
            <div class="card-header">注册</div>
            <div class="card-block offset-md-3 col-md-6">
                <div class="card-text">
                    {{ Form::open(['route' => 'frontend.auth.register', 'class' => 'form-horizontal']) }}
                    @include('frontend.includes.partials.messages')
                    <div class="form-group">
                        {{ Form::label('name', '用户名', ['class' => 'control-label']) }}
                        {{ Form::input('name', 'name', null, ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('email', '邮箱', ['class' => 'control-label']) }}
                        {{ Form::input('email', 'email', null, ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('password', '密码', ['class' => 'control-label']) }}
                        {{ Form::input('password', 'password', null, ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('password_confirmation', '确认密码', ['class' => 'control-label']) }}
                        {{ Form::input('password', 'password_confirmation', null, ['class' => 'form-control']) }}
                    </div>

                    @if (config('access.captcha.registration'))
                        <div class="form-group">
                                {!! Form::captcha() !!}
                                {{ Form::hidden('captcha_status', 'true') }}
                        </div>
                    @endif

                    <div class="form-group">
                            {{ Form::submit('注册', ['class' => 'btn btn-primary']) }}
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after-scripts')
    @if (config('access.captcha.registration'))
        {!! Captcha::script() !!}
    @endif
@stop