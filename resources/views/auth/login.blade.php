<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap-reboot.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-grid.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('css/nouislider.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.mCustomScrollbar.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/paymentfont.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <!-- Favicons -->
    <link rel="icon" type="image/png" href="{{asset('icon/favicon-32x32.png')}}" sizes="32x32">
    <link rel="apple-touch-icon" href="{{asset('icon/favicon-32x32.png')}}">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Digital Gate">
    <title>TEMP</title>
</head>
<body>
<div class="sign section--full-bg" data-bg="{{asset("img/bg2.jpg")}}">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="sign__content">
                    <!-- authorization form -->
                    <form method="POST" action="{{ route('login') }}" class="sign__form">
                        @csrf
                        <a class="sign__logo" style="color:#007bff">
                            {{ __('Login') }}
                        </a>

                        <div class="sign__group">
                            <label for="email" class="col-md-4 col-form-label text-md-right"
                                   style="color:#fff">{{ __('E-mail') }}</label>
                            <input id="email" type="email"
                                   class="sign__input @error('email') is-invalid @enderror" name="email"
                                   value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert" style="color:red;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="sign__group">
                            <label for="password" class="col-md-4 col-form-label text-md-right"
                                   style="color:#fff">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                   class="sign__input @error('password') is-invalid @enderror" name="password"
                                   required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert" style="color:red;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <button class="sign__btn" type="submit">{{ __('Login') }}</button>

                        <span class="sign__text">Don't have account? <a href="{{route("register")}}">Sign up!</a></span>

                        @if (Route::has('password.request'))
                            <a class="sign__text" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </form>
                    <!-- end authorization form -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script src="{{asset('js/jquery-3.5.0.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('js/wNumb.js')}}"></script>
<script src="{{asset('js/nouislider.min.js')}}"></script>
<script src="{{asset('js/jquery.mousewheel.min.js')}}"></script>
<script src="{{asset('js/jquery.mCustomScrollbar.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
</body>
</html>
