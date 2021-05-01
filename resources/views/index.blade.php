@extends('layouts.app')

@section('content')
    <!-- home -->
    <section class="section section--bg section--first authBg">
        <div class="container">
            <div class="row">
                <!-- title -->
                <div class="col-12">
                    <div class="section__title-wrap">
                        <h2 class="section__title section__title--title"><b>Best games</b> of this month</h2>

                        <div class="section__nav-wrap">
                            <button class="section__nav section__nav--bg section__nav--prev" type="button"
                                    data-nav="#carousel0">
                                <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'>
                                    <polyline points='328 112 184 256 328 400'
                                              style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px'/>
                                </svg>
                            </button>

                            <button class="section__nav section__nav--bg section__nav--next" type="button"
                                    data-nav="#carousel0">
                                <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'>
                                    <polyline points='184 112 328 256 184 400'
                                              style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px'/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- end title -->
            </div>
        </div>

        <!-- carousel -->
        <div class="owl-carousel section__carousel section__carousel--big" id="carousel0">
            @foreach($topRate as $product)
                <div class="card card--big">
                    <a href="{{route('shop.product',['product'=>str_replace(' ', '-', $product->name)])}}"
                       class="card__cover">
                        <img src="{{asset('img/product/' . $product->image)}}" alt="{{$product->name}}">
                    </a>

                    <div class="card__wrap">
                        <div class="card__title">
                            <h3>
                                <a href="{{route('shop.product',['product'=>str_replace(' ', '-', $product->name)])}}">{{$product->name}}</a>
                            </h3>
                        </div>

                        <ul class="card__list">
                            <li><span>Category:</span> {{$product->category->name}}</li>
                        </ul>
                        <div class="card__price">
                            @if($product->category->sale == 0)
                                <span>${{$product->price}}</span>
                            @else
                                <span>${{$product->price - ($product->category->sale_value/100) * $product->price}}</span>
                                <s>${{$product->price}}</s>
                                <b>{{$product->category->sale_value}}
                                    % OFF</b>
                            @endif
                        </div>

                        <div class="card__actions">
                            @if(count($product->items()->get()) < 1)
                                <button class="card__buy" type="button" style="background-color: #dc3545;width:100%">Out
                                    of
                                    stock
                                </button>
                            @else
                                <button class="card__buy addToCart" type="button" data-product="{{$product->id}}"
                                        data-token="{{csrf_token()}}">Buy
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- end carousel -->
    </section>
    <!-- end home -->

    <!-- section -->
    <section class="section">
        <div class="container">
            <div class="row">
                <!-- title -->
                <div class="col-12">
                    <div class="section__title-wrap">
                        <h2 class="section__title">Recently Added</h2>

                        <div class="section__nav-wrap">
                            <a href="{{route('shop.home')}}" class="section__view">View All</a>

                            <button class="section__nav section__nav--prev" type="button" data-nav="#carousel1">
                                <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'>
                                    <polyline points='328 112 184 256 328 400'
                                              style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px'/>
                                </svg>
                            </button>

                            <button class="section__nav section__nav--next" type="button" data-nav="#carousel1">
                                <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'>
                                    <polyline points='184 112 328 256 184 400'
                                              style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px'/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- end title -->
            </div>
        </div>

        <!-- carousel -->
        <div class="owl-carousel section__carousel section__carousel--catalog" id="carousel1">
            <!-- card -->
            @foreach($recentAdded as $product)
                <div class="card">
                    <a href="{{route('shop.product',['product'=>str_replace(' ', '-', $product->name)])}}"
                       class="card__cover">
                        <img src="{{asset('img/product/' . $product->image)}}" alt="{{$product->name}}">
                    </a>
                    <div class="card__title">
                        <h3>
                            <a href="{{route('shop.product',['product'=>str_replace(' ', '-', $product->name)])}}">{{$product->name}}</a>
                        </h3>
                        <div class="list__price">
                            @if($product->category->sale == 0)
                                <span>${{$product->price}}</span>
                            @else
                                <span>${{$product->price - ($product->category->sale_value/100) * $product->price}}</span>
                                <s>${{$product->price}}</s>
                                <b>{{$product->category->sale_value}}
                                    % OFF</b>
                            @endif
                        </div>
                    </div>

                    <div class="card__actions">
                        @if(count($product->items()->where('activated','=','0')->get()) < 1)
                            <button class="card__buy" type="button" style="background-color: #dc3545;width:100%">Out of
                                stock
                            </button>
                        @else
                            <button class="card__buy addToCart" type="button" data-product="{{$product->id}}"
                                    data-token="{{csrf_token()}}">Buy
                            </button>
                        @endif
                    </div>
                </div>
        @endforeach

        <!-- end card -->
        </div>
        <!-- end carousel -->
    </section>
    <!-- end section -->

    <!-- section -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="row">
                        <div class="col-12">
                            <!-- title -->
                            <div class="section__title-wrap">
                                <h2 class="section__title section__title--small">Recently Updated</h2>

                                <div class="section__nav-wrap">
                                    <a href="{{route('shop.home')}}" class="section__view">View All</a>
                                </div>
                            </div>
                            <!-- end title -->

                            <!-- cards -->
                            <ul class="list list--mb">
                                @foreach($lastUpdate as $product)
                                    <li class="list__item">
                                        <a href="{{route('shop.product',['product'=>str_replace(' ', '-', $product->name)])}}"
                                           class="list__cover">
                                            <img src="{{asset('img/product/' . $product->image)}}"
                                                 alt="{{$product->name}}">
                                        </a>

                                        <div class="list__wrap">
                                            <h3 class="list__title">
                                                <a href="{{route('shop.product',['product'=>str_replace(' ', '-', $product->name)])}}">{{$product->name}}</a>
                                            </h3>

                                            <div class="list__price">
                                                @if($product->category->sale == 0)
                                                    <span>${{$product->price}}</span>
                                                @else
                                                    <span>${{$product->price - ($product->category->sale_value/100) * $product->price}}</span>
                                                    <s>${{$product->price}}</s>
                                                    <b>{{$product->category->sale_value}}
                                                        % OFF</b>
                                                @endif
                                            </div>

                                            @if(count($product->items()->where('activated','=','0')->get()) < 1)
                                                <button class="list__buy" type="button" style="background-color: #dc3545;width: 19%">Out of
                                                    stock
                                                </button>
                                            @else
                                                <button class="list__buy addToCart" type="button" data-product="{{$product->id}}"
                                                        data-token="{{csrf_token()}}">Buy
                                                </button>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <!-- end cards -->
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="row">
                        <div class="col-12">
                            <!-- title -->
                            <div class="section__title-wrap">
                                <h2 class="section__title section__title--small">For You</h2>

                                <div class="section__nav-wrap">
                                    <a href="#" class="section__view">View All</a>
                                </div>
                            </div>
                            <!-- end title -->

                            <!-- cards -->
                            <ul class="list list--mb">
                                @foreach($getRecommendation as $product)
                                    <li class="list__item">
                                        <a href="{{route('shop.product',['product'=>str_replace(' ', '-', $product->name)])}}"
                                           class="list__cover">
                                            <img src="{{asset('img/product/' . $product->image)}}"
                                                 alt="{{$product->name}}">
                                        </a>

                                        <div class="list__wrap">
                                            <h3 class="list__title">
                                                <a href="{{route('shop.product',['product'=>str_replace(' ', '-', $product->name)])}}">{{$product->name}}</a>
                                            </h3>

                                            <div class="list__price">
                                                @if($product->category->sale == 0)
                                                    <span>${{$product->price}}</span>
                                                @else
                                                    <span>${{$product->price - ($product->category->sale_value/100) * $product->price}}</span>
                                                    <s>${{$product->price}}</s>
                                                    <b>{{$product->category->sale_value}}
                                                        % OFF</b>
                                                @endif
                                            </div>

                                            @if(count($product->items()->where('activated','=','0')->get()) < 1)
                                                <button class="list__buy" type="button" style="background-color: #dc3545;width: 19%">Out of
                                                    stock
                                                </button>
                                            @else
                                                <button class="list__buy addToCart" type="button" data-product="{{$product->id}}"
                                                        data-token="{{csrf_token()}}">Buy
                                                </button>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <!-- end cards -->
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="row">
                        <div class="col-12">
                            <!-- title -->
                            <div class="section__title-wrap">
                                <h2 class="section__title section__title--small">Common Products</h2>

                                <div class="section__nav-wrap">
                                    <a href="{{route('shop.home')}}" class="section__view">View All</a>
                                </div>
                            </div>
                            <!-- end title -->

                            <!-- cards -->
                            <ul class="list">
                                @foreach($randomly as $product)
                                    <li class="list__item">
                                        <a href="{{route('shop.product',['product'=>str_replace(' ', '-', $product->name)])}}"
                                           class="list__cover">
                                            <img src="{{asset('img/product/' . $product->image)}}"
                                                 alt="{{$product->name}}">
                                        </a>

                                        <div class="list__wrap">
                                            <h3 class="list__title">
                                                <a href="{{route('shop.product',['product'=>str_replace(' ', '-', $product->name)])}}">{{$product->name}}</a>
                                            </h3>

                                            <div class="list__price">
                                                @if($product->category->sale == 0)
                                                    <span>${{$product->price}}</span>
                                                @else
                                                    <span>${{$product->price - ($product->category->sale_value/100) * $product->price}}</span>
                                                    <s>${{$product->price}}</s>
                                                    <b>{{$product->category->sale_value}}
                                                        % OFF</b>
                                                @endif
                                            </div>
                                            @if(count($product->items()->where('activated','=','0')->get()) < 1)
                                                <button class="list__buy" type="button" style="background-color: #dc3545;width: 19%">Out of
                                                    stock
                                                </button>
                                            @else
                                                <button class="list__buy addToCart" type="button" data-product="{{$product->id}}"
                                                        data-token="{{csrf_token()}}">Buy
                                                </button>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <!-- end cards -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
@endsection
