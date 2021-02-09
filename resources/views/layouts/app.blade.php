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

@include('layouts.partials.header')

@yield('content')

<!-- footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footer__navs">
                    <div class="footer__nav footer__nav--1">
                        <div class="footer__title"><svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><polygon points='336 320 32 320 184 48 336 320' style='fill:none;stroke-linejoin:round;stroke-width:32px'/><path d='M265.32,194.51A144,144,0,1,1,192,320' style='fill:none;stroke-linejoin:round;stroke-width:32px'/></svg> <span>GG.template</span></div>

                        <nav class="footer__list">
                            <a href="about.html">About Us</a>
                            <a href="catalog.html">Catalog</a>
                            <a href="news.html">News</a>
                            <a href="faq.html">Help Center</a>
                            <a href="contacts.html">Contacts</a>
                        </nav>
                    </div>

                    <div class="footer__nav footer__nav--2">
                        <div class="footer__title"><svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><path d='M467.51,248.83c-18.4-83.18-45.69-136.24-89.43-149.17A91.5,91.5,0,0,0,352,96c-26.89,0-48.11,16-96,16s-69.15-16-96-16a99.09,99.09,0,0,0-27.2,3.66C89,112.59,61.94,165.7,43.33,248.83c-19,84.91-15.56,152,21.58,164.88,26,9,49.25-9.61,71.27-37,25-31.2,55.79-40.8,119.82-40.8s93.62,9.6,118.66,40.8c22,27.41,46.11,45.79,71.42,37.16C487.1,399.86,486.52,334.74,467.51,248.83Z' style='fill:none;stroke-miterlimit:10;stroke-width:32px'/><circle cx='292' cy='224' r='20'/><path d='M336,288a20,20,0,1,1,20-19.95A20,20,0,0,1,336,288Z'/><circle cx='336' cy='180' r='20'/><circle cx='380' cy='224' r='20'/><line x1='160' y1='176' x2='160' y2='272' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/><line x1='208' y1='224' x2='112' y2='224' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/></svg> <span>Games</span></div>

                        <nav class="footer__list footer__list--double">
                            <a href="#">Dota 2</a>
                            <a href="#">StarCraft 2</a>
                            <a href="#">CS:GO</a>
                            <a href="#">League of Legends</a>
                            <a href="#">Battlegrounds</a>
                        </nav>

                        <nav class="footer__list footer__list--double">
                            <a href="#">Call of Duty</a>
                            <a href="#">Hearthstone</a>
                            <a href="#">Halo</a>
                            <a href="#">Vainglory</a>
                            <a href="#">World of Tanks</a>
                        </nav>
                    </div>

                    <div class="footer__nav footer__nav--3">
                        <div class="footer__title"><svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><line x1='176' y1='416' x2='176' y2='480' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/><path d='M80,32H272a32,32,0,0,1,32,32V476a4,4,0,0,1-4,4H48a0,0,0,0,1,0,0V64A32,32,0,0,1,80,32Z' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/><path d='M320,192H432a32,32,0,0,1,32,32V480a0,0,0,0,1,0,0H304a0,0,0,0,1,0,0V208A16,16,0,0,1,320,192Z' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/><path d='M98.08,431.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,98.08,431.87Z'/><path d='M98.08,351.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,98.08,351.87Z'/><path d='M98.08,271.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,98.08,271.87Z'/><path d='M98.08,191.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,98.08,191.87Z'/><path d='M98.08,111.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,98.08,111.87Z'/><path d='M178.08,351.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,178.08,351.87Z'/><path d='M178.08,271.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,178.08,271.87Z'/><path d='M178.08,191.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,178.08,191.87Z'/><path d='M178.08,111.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,178.08,111.87Z'/><path d='M258.08,431.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,258.08,431.87Z'/><path d='M258.08,351.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,258.08,351.87Z'/><path d='M258.08,271.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,258.08,271.87Z'/><ellipse cx='256' cy='176' rx='15.95' ry='16.03' transform='translate(-49.47 232.56) rotate(-45)'/><path d='M258.08,111.87a16,16,0,1,1,13.79-13.79A16,16,0,0,1,258.08,111.87Z'/><path d='M400,400a16,16,0,1,0,16,16,16,16,0,0,0-16-16Z'/><path d='M400,320a16,16,0,1,0,16,16,16,16,0,0,0-16-16Z'/><path d='M400,240a16,16,0,1,0,16,16,16,16,0,0,0-16-16Z'/><path d='M336,400a16,16,0,1,0,16,16,16,16,0,0,0-16-16Z'/><path d='M336,320a16,16,0,1,0,16,16,16,16,0,0,0-16-16Z'/><path d='M336,240a16,16,0,1,0,16,16,16,16,0,0,0-16-16Z'/></svg> <span>For partners</span></div>

                        <nav class="footer__list">
                            <a href="#">Affiliate program</a>
                            <a href="#">Selling on GG.template</a>
                            <a href="#">Terms and conditions</a>
                            <a href="#">Privacy policy</a>
                            <a href="#">Marketing Partnership</a>
                        </nav>

                        <div class="footer__contacts">
                            <a class="footer__link" href="tel:+18092345678">+1 (809) 234-56-78</a>
                            <a class="footer__link" href="mailto:support@gg.template">support@gg.template</a>

                            <div class="footer__social">
                                <a class="fb" href="#"><svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><path d='M455.27,32H56.73A24.74,24.74,0,0,0,32,56.73V455.27A24.74,24.74,0,0,0,56.73,480H256V304H202.45V240H256V189c0-57.86,40.13-89.36,91.82-89.36,24.73,0,51.33,1.86,57.51,2.68v60.43H364.15c-28.12,0-33.48,13.3-33.48,32.9V240h67l-8.75,64H330.67V480h124.6A24.74,24.74,0,0,0,480,455.27V56.73A24.74,24.74,0,0,0,455.27,32Z'/></svg></a>
                                <a class="inst" href="#"><svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><path d='M349.33,69.33a93.62,93.62,0,0,1,93.34,93.34V349.33a93.62,93.62,0,0,1-93.34,93.34H162.67a93.62,93.62,0,0,1-93.34-93.34V162.67a93.62,93.62,0,0,1,93.34-93.34H349.33m0-37.33H162.67C90.8,32,32,90.8,32,162.67V349.33C32,421.2,90.8,480,162.67,480H349.33C421.2,480,480,421.2,480,349.33V162.67C480,90.8,421.2,32,349.33,32Z'/><path d='M377.33,162.67a28,28,0,1,1,28-28A27.94,27.94,0,0,1,377.33,162.67Z'/><path d='M256,181.33A74.67,74.67,0,1,1,181.33,256,74.75,74.75,0,0,1,256,181.33M256,144A112,112,0,1,0,368,256,112,112,0,0,0,256,144Z'/></svg></a>
                                <a class="tw" href="#"><svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><path d='M496,109.5a201.8,201.8,0,0,1-56.55,15.3,97.51,97.51,0,0,0,43.33-53.6,197.74,197.74,0,0,1-62.56,23.5A99.14,99.14,0,0,0,348.31,64c-54.42,0-98.46,43.4-98.46,96.9a93.21,93.21,0,0,0,2.54,22.1,280.7,280.7,0,0,1-203-101.3A95.69,95.69,0,0,0,36,130.4C36,164,53.53,193.7,80,211.1A97.5,97.5,0,0,1,35.22,199v1.2c0,47,34,86.1,79,95a100.76,100.76,0,0,1-25.94,3.4,94.38,94.38,0,0,1-18.51-1.8c12.51,38.5,48.92,66.5,92.05,67.3A199.59,199.59,0,0,1,39.5,405.6,203,203,0,0,1,16,404.2,278.68,278.68,0,0,0,166.74,448c181.36,0,280.44-147.7,280.44-275.8,0-4.2-.11-8.4-.31-12.5A198.48,198.48,0,0,0,496,109.5Z'/></svg></a>
                                <a class="vk" href="#"><svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><path d='M484.7,132c3.56-11.28,0-19.48-15.75-19.48H416.58c-13.21,0-19.31,7.18-22.87,14.86,0,0-26.94,65.6-64.56,108.13-12.2,12.3-17.79,16.4-24.4,16.4-3.56,0-8.14-4.1-8.14-15.37V131.47c0-13.32-4.06-19.47-15.25-19.47H199c-8.14,0-13.22,6.15-13.22,12.3,0,12.81,18.81,15.89,20.84,51.76V254c0,16.91-3,20-9.66,20-17.79,0-61-66.11-86.92-141.44C105,117.64,99.88,112,86.66,112H33.79C18.54,112,16,119.17,16,126.86c0,13.84,17.79,83.53,82.86,175.77,43.21,63,104.72,96.86,160.13,96.86,33.56,0,37.62-7.69,37.62-20.5V331.33c0-15.37,3.05-17.93,13.73-17.93,7.62,0,21.35,4.09,52.36,34.33C398.28,383.6,404.38,400,424.21,400h52.36c15.25,0,22.37-7.69,18.3-22.55-4.57-14.86-21.86-36.38-44.23-62-12.2-14.34-30.5-30.23-36.09-37.92-7.62-10.25-5.59-14.35,0-23.57-.51,0,63.55-91.22,70.15-122' style='fill-rule:evenodd'/></svg></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="footer__wrap">
                    <a class="footer__logo" href="index.html">
                        <img src="img/logo.svg" alt="">
                    </a>

                    <span class="footer__copyright">© 2020 GG.template <br> Create by <a href="https://themeforest.net/user/dmitryvolkov/portfolio" target="_blank">Dmitry Volkov</a></span>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->

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
