<!-- header -->
<header class="header">
    <div class="header__wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="header__content">
                        <button class="header__menu" type="button">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <a class="header__logo">
                            <img style="margin-top: 17px;" src="{{asset('img/web/log.png')}}" alt="LOGO">
                        </a>
                        <ul class="header__nav">
                            <li class="header__nav-item">
                                <a class="header__nav-link" href="{{route('front.home')}}">Home</a>
                            </li>
                            <li class="header__nav-item">
                                <a class="header__nav-link" href="{{route('shop.home')}}">Shop</a>
                            </li>
                            <li class="header__nav-item">
                                <a class="header__nav-link" href="{{route('front.contact')}}">Contact us</a>
                            </li>
                            <li class="header__nav-item">
                                <a class="header__nav-link" href="">Privacy Policy</a>
                            </li>
                        </ul>

                        <div class="header__actions">
                            @if (Auth::guest())
                                <a href="{{ route('login') }}" class="header__login">
                                    <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512'
                                         viewBox='0 0 512 512'>
                                        <path
                                            d='M192,176V136a40,40,0,0,1,40-40H392a40,40,0,0,1,40,40V376a40,40,0,0,1-40,40H240c-22.09,0-48-17.91-48-40V336'
                                            style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                        <polyline points='288 336 368 256 288 176'
                                                  style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                        <line x1='80' y1='256' x2='352' y2='256'
                                              style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                    </svg>
                                    <span>Login</span>
                                </a>
                                <a href="{{ route('register') }}" class="header__login">
                                    <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512'
                                         viewBox='0 0 512 512'>
                                        <path
                                            d='M192,176V136a40,40,0,0,1,40-40H392a40,40,0,0,1,40,40V376a40,40,0,0,1-40,40H240c-22.09,0-48-17.91-48-40V336'
                                            style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                        <polyline points='288 336 368 256 288 176'
                                                  style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                        <line x1='80' y1='256' x2='352' y2='256'
                                              style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                    </svg>
                                    <span>Register</span>
                                </a>
                            @else
                                <ul class="navbar-nav">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="dropdown"
                                           data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
                                        <div class="dropdown-menu" aria-labelledby="dropdown">
                                            <a class="dropdown-item"
                                               href="{{route("front.profile.home",['name'=>Auth::user()->name,'tab'=>"settings"])}}">Profile</a>
                                            @if(Auth::user()->role == "Admin")
                                                <a class="dropdown-item"
                                                   href="{{route("front.admin.viewUsers")}}">Admin</a>
                                                <a class="dropdown-item"
                                                   href="{{route("front.admin.clearCache")}}">Clear Cache</a>
                                            @endif
                                            <a class="dropdown-item" href="{{route("logout")}}">Logout</a>
                                        </div>
                                    </li>
                                </ul>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header__wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="header__content">
                        <form action="#" class="header__form">
                            <input type="text" class="header__input" placeholder="I'm searching for...">
                            <select class="header__select">
                                <option value="0">All Categories</option>
                                @foreach(\Illuminate\Support\Facades\Cache::get('categories') as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            <button class="header__btn" type="button">
                                <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'>
                                    <path d='M221.09,64A157.09,157.09,0,1,0,378.18,221.09,157.1,157.1,0,0,0,221.09,64Z'
                                          style='fill:none;stroke-miterlimit:10;stroke-width:32px'/>
                                    <line x1='338.29' y1='338.29' x2='448' y2='448'
                                          style='fill:none;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/>
                                </svg>
                            </button>
                        </form>

                        <div class="header__actions header__actions--2">
                            <a href="" class="header__link">
                                <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'>
                                    <path
                                        d='M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z'
                                        style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                </svg>
                                <span>Favorites</span>
                            </a>

                            <a href="{{route('front.checkout')}}" class="header__link">
                                <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'>
                                    <circle cx='176' cy='416' r='16'
                                            style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                    <circle cx='400' cy='416' r='16'
                                            style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                    <polyline points='48 80 112 80 160 352 416 352'
                                              style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                    <path d='M160,288H409.44a8,8,0,0,0,7.85-6.43l28.8-144a8,8,0,0,0-7.85-9.57H128'
                                          style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                </svg>
                                <span>$<span id="userBalance" style="display:inline;">{{Cart::instance('shopping')->subtotal()}}</span></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- end header -->
