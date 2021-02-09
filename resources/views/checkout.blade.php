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
                                    <th>Product</th>
                                    <th>Title</th>
                                    <th>Platform</th>
                                    <th>Price</th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td>
                                        <div class="cart__img">
                                            <img src="img/cards/8.jpg" alt="">
                                        </div>
                                    </td>
                                    <td>Baldur's Gate: Enhanced Edition</td>
                                    <td>PC</td>
                                    <td><span class="cart__price">$19.99</span></td>
                                    <td><button class="cart__delete" type="button"><svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><line x1='368' y1='368' x2='144' y2='144' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/><line x1='368' y1='144' x2='144' y2='368' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/></svg></button></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="cart__img">
                                            <img src="img/cards/3.jpg" alt="">
                                        </div>
                                    </td>
                                    <td>Dandara: Trials of Fear Edition</td>
                                    <td>Playstation</td>
                                    <td><span class="cart__price">$7.99</span></td>
                                    <td><button class="cart__delete" type="button"><svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><line x1='368' y1='368' x2='144' y2='144' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/><line x1='368' y1='144' x2='144' y2='368' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/></svg></button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="cart__info">
                            <div class="cart__total">
                                <p>Total:</p>
                                <span>$27.98</span>
                            </div>

                            <div class="cart__systems">
                                <i class="pf pf-visa"></i>
                                <i class="pf pf-mastercard"></i>
                                <i class="pf pf-paypal"></i>
                            </div>
                        </div>
                    </div>
                    <!-- end cart -->
                </div>

                <div class="col-12 col-lg-4">
                    <!-- checkout -->
                    <form action="#" class="form form--checkout">
                        <input type="text" class="form__input" placeholder="John Doe">
                        <input type="text" class="form__input" placeholder="gg@template.buy">
                        <input type="text" class="form__input" placeholder="+1 (234) 567 - 89 - 00">
                        <button type="button" class="form__btn">Complete</button>
                    </form>
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
