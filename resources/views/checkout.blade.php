@extends('layouts.app')

@section('content')
    <!-- page title -->
    <section class="section section--first section--last section--head" data-bg="img/bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__wrap">
                        <!-- section title -->
                        <h2 class="section__title">Checkout</h2>
                        <!-- end section title -->

                        <!-- breadcrumb -->
                        <ul class="breadcrumb">
                            <li class="breadcrumb__item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb__item breadcrumb__item--active">Checkout</li>
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->

    <!-- section -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <!-- cart -->
                    <div class="cart">
                        <div class="table-responsive">
                            <table class="cart__table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                {{$counter = 1}}
                                @foreach(Cart::instance('shopping')->content() as $row)
                                    <tr>
                                        <td>#{{$counter}}</td>
                                        <td>{{$row->model->name}}</td>
                                        <td><span class="cart__price">${{$row->price}}</span></td>
                                        <td>{{$row->qty}}</td>
                                        <td>
                                            <button class="cart__delete removeFromCart" type="button" data-product="{{$row->model->id}}" data-token="{{csrf_token()}}">
                                                <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512'
                                                     viewBox='0 0 512 512'>
                                                    <line x1='368' y1='368' x2='144' y2='144'
                                                          style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                                    <line x1='368' y1='144' x2='144' y2='368'
                                                          style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                    {{$counter++}}
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="cart__info">
                            <div class="cart__total">
                                <p>Total:</p>
                                <span>${{Cart::instance('shopping')->subtotal()}}</span>
                            </div>

                            <div class="cart__systems">
                                <i class="pf pf-paypal"></i>
                            </div>
                        </div>
                    </div>
                    <!-- end cart -->
                </div>

                <div class="col-12 col-lg-4">
                    <!-- checkout -->
                    <input type="text" class="form__input" value="{{Auth::user()->name}}" readonly>
                    <input type="text" class="form__input" value="{{Auth::user()->email}}" readonly>
                    {!! Form::open(['route' => 'front.pay', 'method'=>'post', 'class'=>'form form--checkout']) !!}
                        <button type="submit" class="form__btn">Order</button>
                    {!! Form::close() !!}
                    <!-- end checkout -->
                </div>
            </div>
        </div>
    </div>
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
