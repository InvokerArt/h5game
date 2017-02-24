@extends('frontend.layouts.app')

@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="card" style="margin-top: 25px;">
            <div class="card-header">重置密码</div>
            <div class="card-block offset-md-3 col-md-6">
                <div class="card-text">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ Form::open(['route' => 'frontend.auth.password.reset', 'class' => 'form-horizontal']) }}

                    <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            {{ Form::label('email', '邮箱', ['class' => 'control-label']) }}
                            {{-- <p class="form-control-static">{{ $email }}</p> --}}
                            {{ Form::input('hidden', 'email', $email, ['class' => 'form-control']) }}
                        </div>

                    <div class="form-group">
                        {{ Form::label('password', '新密码', ['class' => 'control-label']) }}
                        {{ Form::input('password', 'password', null, ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('password_confirmation', '确认新密码', ['class' => 'control-label']) }}
                        {{ Form::input('password', 'password_confirmation', null, ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::submit('确定', ['class' => 'btn btn-primary']) }}
                    </div>

                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
@endsection
