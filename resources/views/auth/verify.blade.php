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
<div class="sign section--full-bg authBg">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="sign__content">
                    <!-- authorization form -->
                    <div class="sign__form">
                        <a class="sign__logo" style="color:#007bff">
                            {{ __('Verify Your Email Address') }}
                        </a>
                        <div class="sign__group">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert" style="color:green">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif
                            <p style="color:#fff">
                                {{ __('Before proceeding, please check your email for a verification link.') }}
                                {{ __('If you did not receive the email') }},
                            </p>
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="sign__btn">{{ __('click here to request another') }}</button>
                            </form>
                        </div>
                    </div>
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
