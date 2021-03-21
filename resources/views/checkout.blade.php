@extends('layouts.app')

@section('content')
    <!-- page title -->
    <section class="section section--first section--last section--head authBg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__wrap">
                        <!-- section title -->
                        <h2 class="section__title">Checkout</h2>
                        <!-- end section title -->

                        <!-- breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb" style="background: transparent;">
                                <li class="breadcrumb-item"><a href="{{route('front.home')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
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
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    @if(session()->has('discount'))
                        <div id="checkoutalert" class="alert alert-primary" role="alert">
                            You added ${{session()->get('discount')}} discount for this order!
                        </div>
                    @elseif(Auth::user()->balance > 1.00)
                        <div id="checkoutalert" class="alert alert-primary" role="alert">
                            You can add ${{Auth::user()->balance}} discount for this order, <a class="addDiscount"
                                                                                               data-token="{{csrf_token()}}"
                                                                                               data-discount="{{Auth::user()->balance}}"
                                                                                               style="color:green;">click
                                here to add</a>
                        </div>
                    @endif
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
                                            <button class="cart__delete removeFromCart" type="button"
                                                    data-product="{{$row->model->id}}" data-token="{{csrf_token()}}">
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
                    <input type="email" class="form__input" value="{{Auth::user()->email}}" readonly>
                    <div class="card card-cascade card-ecommerce wider shadow p-3 mb-5" style="color:#fff;">
                        <!--Card Body-->
                        <div class="card-body card-body-cascade">
                            <!--Card Description-->
                            <div class="card2decs">
                                <p class="heading1"><strong>Details</strong></p>
                                <p class="subtotal" id="checkoutSubtotal">Subtotal<span
                                        class="float-right text1">${{Cart::instance('shopping')->subtotal()}}</span></p>
                                <p class="subtotal">Discount<span class="float-right text1"
                                                                  id="checkoutDiscount">${{session()->has('discount') ? session()->get('discount') : 0}}</span>
                                </p>
                                <p class="total"><strong>Total</strong><span class="float-right totalText1">$<span
                                            class="totalText2"
                                            id="checkoutTotal">{{(Cart::instance('shopping')->subtotal() - (session()->has('discount') ? session()->get('discount') : 0))}}</span></span>
                                </p>
                            </div>
                            {!! Form::open(['route' => 'front.pay', 'method'=>'post']) !!}
                            <button type="submit" class="form__btn"><img
                                    src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-large.png"
                                    alt="Check out with PayPal"/></button>
                            {!! Form::close() !!}
                        </div>
                    </div>
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
