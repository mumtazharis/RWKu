@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@stop

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login'))
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register'))
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset'))

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '')
    @php( $register_url = $register_url ? route($register_url) : '')
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '')
@else
    @php( $login_url = $login_url ? url($login_url) : '')
    @php( $register_url = $register_url ? url($register_url) : '')
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '')
@endif


@section('auth_body')
<br>
<br>
    @error('login_gagal')
        <div class="alert alert-warning alert-dissmissible fade show" role="alert">
            <span class="alert-inner--text"><strong>Warning!</strong> {{$message}}</span>
            <button type="button" class="close" data-dissmiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @enderror
    @error('logout')
        <div class="alert alert-warning alert-dissmissible fade show" role="alert">
            <span class="alert-inner--text"><strong>Warning!</strong> {{$message}}</span>
            <button type="button" class="close" data-dissmiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @enderror
    @error('password-diubah')
        <div class="alert alert-warning alert-dissmissible fade show" role="alert">
            <span class="alert-inner--text"><strong>Warning!</strong> {{$message}}</span>
            <button type="button" class="close" data-dissmiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @enderror
    <form action="{{url('proses_login')}}" method="POST">
        @csrf
        {{-- Username field --}}
        <div class="input-group mb-3">
            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" placeholder="Username" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>

            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password field --}}
            <div class="input-group mb-3">
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{__('adminlte::adminlte.password')}}">

                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock {{config('adminlte.classes_auth_icon', '')}}"></span>
                    </div>
                </div>

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>

        {{-- Login field --}}
        <div class="row">
            <div class="col-7">
            
            </div>

            <div class="col-5">
                <button type="submit" class="btn btn-block {{config('adminlte.classes_auth_btn', 'btn-flat btn-primary')}}">
                    <span class="fas fa-sign-in-alt"></span>
                    {{__('Login')}}
                </button>
            </div>
        </div>
    </form>
@stop

