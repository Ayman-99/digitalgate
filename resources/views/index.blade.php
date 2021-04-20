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
                    <a href="" class="card__cover">
                        <img src="{{asset('img/product/' . $product->image)}}" alt="{{$product->name}}">
                    </a>

                    <div class="card__wrap">
                        <div class="card__title">
                            <h3><a href="">{{$product->name}}</a></h3>
                        </div>

                        <ul class="card__list">
                            <li><span>Category:</span> {{$product->category->name}}</li>
                        </ul>
                        <div class="card__price">
                            @if($product->sale == 0)
                                <span>${{$product->price}}</span>
                            @else
                                <span>${{$product->sale}}</span><s>${{$product->price}}</s>
                                <b>{{round(100 * ($product->price - $product->sale) / $product->price)}}% OFF</b>
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
                            <button class="card__favorite" type="button">
                                <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'>
                                    <path
                                        d='M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z'
                                        style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                </svg>
                            </button>
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
                    <a class="card__cover">
                        <img src="{{asset('img/product/' . $product->image)}}" alt="{{$product->name}}">
                    </a>
                    <div class="card__title">
                        <h3><a href="">{{$product->name}}</a></h3>
                        <div class="list__price">
                            @if($product->sale == 0)
                                <span>${{$product->price}}</span>
                            @else
                                <span>${{$product->sale}}</span><s>${{$product->price}}</s>
                                <b>{{round(100 * ($product->price - $product->sale) / $product->price)}}
                                    % OFF</b>
                            @endif
                        </div>
                    </div>

                    <div class="card__actions">
                        @if(count($product->items()->get()) < 1)
                            <button class="card__buy" type="button" style="background-color: #dc3545;width:100%">Out of
                                stock
                            </button>
                        @else
                            <button class="card__buy addToCart" type="button" data-product="{{$product->id}}"
                                    data-token="{{csrf_token()}}">Buy
                            </button>
                        @endif
                        <button class="card__favorite" type="button">
                            <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'>
                                <path
                                    d='M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z'
                                    style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                            </svg>
                        </button>
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
                                @for($i = 0; $i < 3; $i++ )
                                    @if(count($randomly[$i]->items()->get()) > 1)
                                        <li class="list__item">
                                            <a href="#" class="list__cover">
                                                <img src="{{asset('img/product/' . $lastUpdate[$i]->image)}}"
                                                     alt="{{$lastUpdate[$i]->name}}">
                                            </a>

                                            <div class="list__wrap">
                                                <h3 class="list__title">
                                                    <a href="#">{{$lastUpdate[$i]->name}}</a>
                                                </h3>

                                                <div class="list__price">
                                                    @if($lastUpdate[$i]->sale == 0)
                                                        <span>${{$lastUpdate[$i]->price}}</span>
                                                    @else
                                                        <span>${{$lastUpdate[$i]->sale}}</span>
                                                        <s>${{$lastUpdate[$i]->price}}</s>
                                                        <b>{{round(100 * ($lastUpdate[$i]->price - $lastUpdate[$i]->sale) / $lastUpdate[$i]->price)}}
                                                            % OFF</b>
                                                    @endif
                                                </div>

                                                <button class="list__buy" type="button">
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512'
                                                         viewBox='0 0 512 512'>
                                                        <line x1='256' y1='112' x2='256' y2='400'
                                                              style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                                        <line x1='400' y1='256' x2='112' y2='256'
                                                              style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </li>
                                    @endif
                                @endfor
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
                                    @if(count($product->items()->get()) >= 1)
                                        <li class="list__item">
                                            <a href="#" class="list__cover">
                                                <img src="{{asset('img/product/' . $product->image)}}"
                                                     alt="{{$product->name}}">
                                            </a>

                                            <div class="list__wrap">
                                                <h3 class="list__title">
                                                    <a href="#">{{$product->name}}</a>
                                                </h3>

                                                <div class="list__price">
                                                    @if($product->sale == 0)
                                                        <span>${{$product->price}}</span>
                                                    @else
                                                        <span>${{$product->sale}}</span>
                                                        <s>${{$product->price}}</s>
                                                        <b>{{round(100 * ($product->price - $product->sale) / $product->price)}}
                                                            % OFF</b>
                                                    @endif
                                                </div>

                                                <button class="list__buy" type="button">
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512'
                                                         viewBox='0 0 512 512'>
                                                        <line x1='256' y1='112' x2='256' y2='400'
                                                              style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                                        <line x1='400' y1='256' x2='112' y2='256'
                                                              style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </li>
                                    @endif
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
                                @for($i = 0; $i < 3; $i++ )
                                    @if(count($randomly[$i]->items()->get()) > 1)
                                        <li class="list__item">
                                            <a href="#" class="list__cover">
                                                <img src="{{asset('img/product/' . $randomly[$i]->image)}}"
                                                     alt="{{$randomly[$i]->name}}">
                                            </a>

                                            <div class="list__wrap">
                                                <h3 class="list__title">
                                                    <a href="#">{{$randomly[$i]->name}}</a>
                                                </h3>

                                                <div class="list__price">
                                                    @if($randomly[$i]->sale == 0)
                                                        <span>${{$randomly[$i]->price}}</span>
                                                    @else
                                                        <span>${{$randomly[$i]->sale}}</span>
                                                        <s>${{$randomly[$i]->price}}</s>
                                                        <b>{{round(100 * ($randomly[$i]->price - $randomly[$i]->sale) / $randomly[$i]->price)}}
                                                            % OFF</b>
                                                    @endif
                                                </div>

                                                <button class="list__buy" type="button">
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512'
                                                         viewBox='0 0 512 512'>
                                                        <line x1='256' y1='112' x2='256' y2='400'
                                                              style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                                        <line x1='400' y1='256' x2='112' y2='256'
                                                              style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </li>
                                    @endif
                                @endfor
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
