@extends('frontend.layouts.app')

@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="card" style="margin-top: 25px;">
            <div class="card-header">登录</div>
            <div class="card-block offset-md-3 col-md-6">
                <div class="card-text">
                    {{ Form::open(['route' => 'frontend.auth.login', 'class' => 'form-horizontal']) }}
                    @include('frontend.includes.partials.messages')
                    <div class="form-group">
                        {{ Form::label('email', '邮箱', ['class' => 'form-control-label']) }}
                        {{ Form::input('email', 'email', null, ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('password', '密码', ['class' => 'form-control-label']) }}
                        {{ Form::input('password', 'password', null, ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                {{ Form::checkbox('remember') }} 记住密码
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::submit('登录', ['class' => 'btn btn-primary', 'style' => 'margin-right:15px']) }}
                        {{ link_to_route('frontend.auth.password.reset', '忘记密码？') }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection