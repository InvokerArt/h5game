@extends('frontend.layouts.app')

@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="card" style="margin-top: 25px;">
            <div class="card-header">忘记密码</div>
            <div class="card-block offset-md-3 col-md-6">
                <div class="card-text">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ Form::open(['route' => 'frontend.auth.password.email', 'class' => 'form-horizontal']) }}

                    <div class="form-group">
                        {{ Form::label('email', '邮箱', ['class' => 'control-label']) }}
                            {{ Form::input('email', 'email', null, ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                            {{ Form::submit('重置', ['class' => 'btn btn-primary']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection