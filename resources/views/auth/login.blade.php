{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Force Ranking :: PTPN GROUP</title>

    <link rel="stylesheet" href="{{ asset('template/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('template/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/horizontal-layout-light/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('template/images/holding-favicon.png') }}" type="image/x-icon">
    <style>
        .gambar {
            background: url("{{ asset('template/images/bg-login2.jpeg') }}");
            background-size: cover;
        }
    </style>
</head>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                <div class="row flex-grow">
                    <div class="col-lg-6 d-flex align-items-center justify-content-center">
                        <div class="auth-form-transparent text-left p-3">
                            <div class="brand-logo">
                                <img src="{{ asset('template/images/holding.png') }}" alt="logo">
                            </div>
                            <h4>DISTRIBUSI PENILAIAN KINERJA</h4>
                            <h6 class="font-weight-light">Masukkan Username dan Password Anda !</h6>
                            <form class="pt-3" action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="ti-user text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control form-control-lg border-left-0 @error('email') is-invalid @enderror" name="email" placeholder="Email atau ID SAP" autofocus required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="ti-lock text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="password" class="form-control form-control-lg border-left-0" name="password" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="my-3">
                                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">LOGIN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 gambar d-flex flex-row">
                        <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2020  Perkebunan Nusantara Group.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('template/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('template/js/off-canvas.js') }}"></script>
    <script src="{{ asset('template/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('template/js/template.js') }}"></script>
    <script src="{{ asset('template/js/settings.js') }}"></script>
    <script src="{{ asset('template/js/todolist.js  ') }}"></script>
</body>
</html>