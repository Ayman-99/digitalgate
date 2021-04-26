@extends('layouts.app')

@section('content')
    <!-- page title -->
    <section class="section section--first section--last section--head" data-bg="{{asset('img/web/bg-for-shop.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__wrap">
                        <!-- section title -->
                        <h2 class="section__title">Catalog <span>({{$products->total()}} products)</span></h2>
                        <!-- end section title -->

                        <!-- breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb" style="background: transparent;">
                                <li class="breadcrumb-item"><a href="{{route('front.home')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Shop</li>
                            </ol>
                        </nav>
                        <!-- end breadcrumb -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->

    <!-- section -->
    <section class="section section--last section--catalog">
        <div class="container">
            <!-- catalog -->
            <div class="row catalog">
                <!-- filter wrap -->
                <div class="col-12 col-lg-20">
                    <div class="row">
                        <div class="col-12">
                            <!-- filter -->
                            <form action="{{Request::url()}}" method="GET">
                                <div class="filter">
                                    <div class="filter__group">
                                        <label for="sort" class="filter__label">Sort by:</label>

                                        <div class="filter__select-wrap">
                                            <select name="sort" id="sort" class="filter__select">
                                                <option value="0" style="color:#000;">Newest</option>
                                                <option value="1" style="color:#000;">Oldest</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="filter__group">
                                        <label class="filter__label">Price:</label>
                                        <ul class="filter__checkboxes">
                                            <li>
                                                <input id="type5" type="radio" name="category" checked="" value="0">
                                                <label for="type5">Less than 5$</label>
                                            </li>
                                            <li>
                                                <input id="type5" type="radio" name="category" checked="" value="0">
                                                <label for="type5">Between 5$ - 10$</label>
                                            </li>
                                            <li>
                                                <input id="type5" type="radio" name="category" checked="" value="0">
                                                <label for="type5">Between 10$ - 20$</label>
                                            </li>
                                            <li>
                                                <input id="type5" type="radio" name="category" checked="" value="0">
                                                <label for="type5">Between 20$ - 40$</label>
                                            </li>
                                            <li>
                                                <input id="type5" type="radio" name="category" checked="" value="0">
                                                <label for="type5">More than 40$</label>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="filter__group">
                                        <label class="filter__label">Genres:</label>
                                        <ul class="filter__checkboxes">
                                            <li>
                                                <input id="type5" type="radio" name="category" checked="" value="0">
                                                <label for="type5">All</label>
                                            </li>
                                            @foreach(\Illuminate\Support\Facades\Cache::get('categories') as $category)
                                                <li>
                                                    <input id="{{$category->id}}" type="radio" name="category"
                                                           value="{{$category->id}}">
                                                    <label for="{{$category->id}}">{{$category->name}}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="filter__group">
                                        <button class="filter__btn" type="submit">APPLY FILTER</button>
                                    </div>
                                </div>
                            </form>
                            <!-- end filter -->
                        </div>
                    </div>
                </div>
                <!-- end filter wrap -->

                <!-- content wrap -->
                <div class="col-12 col-lg-80">
                    <div class="row">
                        @if(count($products))
                            @foreach($products as $product)
                                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                                    <div class="card">
                                        <a href="{{route('shop.product',['product'=>str_replace(' ', '-', $product->name)])}}" class="card__cover">
                                            <img src="{{asset("img/product/" . $product->image)}}" alt="{{$product->name}}">
                                        </a>

                                        <div class="card__title">
                                            <h3><a href="{{route('shop.product',['product'=>str_replace(' ', '-', $product->name)])}}">{{$product->name}}</a></h3>
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
                                        </div>

                                        <div class="card__actions">
                                            @if(count($product->items()->get()) < 1)
                                                <button class="card__buy" type="button" style="background-color: #dc3545;width:100%">Out of
                                                    stock
                                                </button>
                                            @else
                                                <button class="card__buy addToCart" type="button" data-product="{{$product->id}}" data-token="{{csrf_token()}}">Buy</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h2 style="color: #fff;">No data</h2>
                    @endif

                    <!-- paginator -->
                        <div class="col-12">
                            <div class="paginator">
                                {{$products->appends(request()->query->all())->links('vendor.pagination.custom')}}
                            </div>
                        </div>
                        <!-- end paginator -->
                    </div>
                </div>
                <!-- end content wrap -->
            </div>
            <!-- end catalog -->
        </div>
    </section>
    <!-- end section -->
@endsection
