@extends('layouts.app')

@section('content')
    <!-- page title -->
    <section class="section section--first section--last section--head"
             data-bg="{{asset('img/web/bg-for-contact.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__wrap">
                        <!-- section title -->
                        <h2 class="section__title">Search result ({{$products->total()}} products found)</h2>
                        <!-- end section title -->
                        <!-- breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb" style="background: transparent;">
                                <li class="breadcrumb-item"><a href="{{route('front.home')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Search</li>
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
    <section class="section">
        <div class="container">
            @if(count($products) > 0)
                <div class="row">
                    @foreach($products as $product)
                        <div class="card w-75" style="color:white;">
                            <div class="card-body">
                                <h5 class="card-title">{{$product->name}}</h5>
                                <p class="card-text">{{$product->description}}</p>
                                <a href="{{route('shop.product',['product'=>str_replace(' ', '-', $product->name)])}}"
                                   class="btn btn-primary">View</a>
                            </div>
                        </div>
                    @endforeach
                        <div class="col-12">
                            <div class="paginator">
                                {{$products->links('vendor.pagination.custom')}}
                            </div>
                        </div>
                </div>
            @else
                <h1 style="color:#fff; text-align:center">No Results</h1>
            @endif
        </div>
    </section>
    <!-- end section -->

    <!-- section -->
    <div class="section section--last">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="partners owl-carousel">
                        <a href="#" class="partners__img">
                            <img src="img/partners/3docean-light-background.png" alt="">
                        </a>

                        <a href="#" class="partners__img">
                            <img src="img/partners/activeden-light-background.png" alt="">
                        </a>

                        <a href="#" class="partners__img">
                            <img src="img/partners/audiojungle-light-background.png" alt="">
                        </a>

                        <a href="#" class="partners__img">
                            <img src="img/partners/codecanyon-light-background.png" alt="">
                        </a>

                        <a href="#" class="partners__img">
                            <img src="img/partners/photodune-light-background.png" alt="">
                        </a>

                        <a href="#" class="partners__img">
                            <img src="img/partners/themeforest-light-background.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end section -->
@endsection
