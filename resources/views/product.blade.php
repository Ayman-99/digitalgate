@extends('layouts.app')

@section('content')
    <section class="section section--first section--bg" data-bg="img/bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="details">
                        <div class="details__head">
                            <div class="details__cover">
                                <img src="{{asset('img/product/' . $product->image)}}" alt="cover">
                            </div>

                            <div class="details__wrap">
                                <h3 class="details__title">{{$product->name}}</h3>

                                <ul class="details__list">
                                    <li><span>Last update:</span> {{$product->created_at->diffForHumans()}}</li>
                                    <li><span>Genres:</span> {{$product->category->name}}</li>
                                </ul>

                                <div class="details__text">
                                    <p>{{$product->description}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="details__cart" style="height: auto;">
                            @if (Auth::check())
                                <div class="wrapper">
                                    <input type="radio" id="r1" name="rg1" value="5">
                                    <label for="r1">&#10038;</label>
                                    <input type="radio" id="r2" name="rg1" value="4">
                                    <label for="r2">&#10038;</label>
                                    <input type="radio" id="r3" name="rg1" value="3">
                                    <label for="r3">&#10038;</label>
                                    <input type="radio" id="r4" name="rg1" value="2">
                                    <label for="r4">&#10038;</label>
                                    <input type="radio" id="r5" name="rg1" value="1">
                                    <label for="r5">&#10038;</label>
                                    <input type="hidden" name="product" value="{{$product->id}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                </div>
                            @endif
                            <span class="details__cart-title">PRICE</span>
                            <div class="details__price">
                                @if($product->sale == 0)
                                    <span>${{$product->price}}</span>
                                @else
                                    <span>${{$product->sale}}</span><s>${{$product->price}}</s>
                                    <b>{{round(100 * ($product->price - $product->sale) / $product->price)}}% OFF</b>
                                @endif
                            </div>

                            <div class="details__actions">
                                @if(count($product->items()->get()) < 1)
                                    <button class="card__buy" type="button"
                                            style="background-color: #dc3545;width:100%">Out of
                                        stock
                                    </button>
                                @else
                                    <button class="details__buy addToCart" type="button" data-product="{{$product->id}}"
                                            data-token="{{csrf_token()}}">Buy now
                                    </button>
                                @endif
                                <button class="details__favorite" type="button">
                                    <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512'
                                         viewBox='0 0 512 512'>
                                        <path
                                            d='M352.92,80C288,80,256,144,256,144s-32-64-96.92-64C106.32,80,64.54,124.14,64,176.81c-1.1,109.33,86.73,187.08,183,252.42a16,16,0,0,0,18,0c96.26-65.34,184.09-143.09,183-252.42C447.46,124.14,405.68,80,352.92,80Z'
                                            style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                    </svg>
                                    Add to cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->

    <!-- section -->
    <section class="section section--last">
        <div class="container">
            <div class="row">
                <!-- title -->
                <div class="col-12">
                    <div class="section__title-wrap">
                        <h2 class="section__title">You may also like</h2>

                        <div class="section__nav-wrap">
                            <a href="catalog.html" class="section__view">View All</a>

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
            @foreach($getRecommendation as $recommended)
                <div class="card">
                    <a href="details.html" class="card__cover">
                        <img src="{{asset('img/product/' . $recommended->image)}}" alt="">
                    </a>

                    <div class="card__title">
                        <h3><a href="">{{$recommended->name}}</a></h3>
                        <div class="list__price">
                            @if($recommended->sale == 0)
                                <span>${{$recommended->price}}</span>
                            @else
                                <span>${{$recommended->sale}}</span>
                                <s>${{$recommended->price}}</s>
                                <b>{{round(100 * ($recommended->price - $recommended->sale) / $recommended->price)}}
                                    % OFF</b>
                            @endif
                        </div>
                    </div>

                    <div class="card__actions">
                        <button class="card__buy" type="button">Buy</button>

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
        </div>
        <!-- end carousel -->
    </section>
    <!-- end section -->
@endsection
