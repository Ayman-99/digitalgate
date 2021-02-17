@extends('layouts.app')

@section('content')
    <!-- page title -->
    <section class="section section--first section--last section--head" data-bg="{{asset("img/bg.jpg")}}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__wrap">
                        <!-- section title -->
                        <h2 class="section__title">Profile</h2>
                        <!-- end section title -->

                        <!-- breadcrumb -->
                        <ul class="breadcrumb" style="background:transparent;">
                            <li class="breadcrumb__item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb__item breadcrumb__item--active">Profile</li>
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->

    <!-- section -->
    <section class="section section--last">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="profile">
                        <ul class="nav nav-tabs profile__tabs" id="profile__tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{app('request')->input('tab') === "users" ? 'active' : ''}}"
                                   style="background: transparent;border: none;color: #fff;"
                                   data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1"
                                   aria-selected="false">Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{app('request')->input('tab') === "orders" ? 'active' : ''}}"
                                   style="background: transparent;border: none;color: #fff;"
                                   data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2"
                                   aria-selected="false">Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{app('request')->input('tab') === "products" ? 'active' : ''}}"
                                   style="background: transparent;border: none;color: #fff;"
                                   data-toggle="tab" href="#tab-3" role="tab" aria-controls="tab-3"
                                   aria-selected="false">Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{app('request')->input('tab') === "items" ? 'active' : ''}}"
                                   style="background: transparent;border: none;color: #fff;"
                                   data-toggle="tab" href="#tab-4" role="tab" aria-controls="tab-4"
                                   aria-selected="false">Items</a>
                            </li>
                        </ul>
                        <a class="profile__logout" href="{{route('logout')}}">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <!-- content tabs -->
            <div class="tab-content">
                <div class="tab-pane fade {{app('request')->input('tab') === "users" ? 'show active' : ''}}" id="tab-1"
                     role="tabpanel">
                    @include('layouts.admin.users')
                </div>
                <div class="tab-pane fade {{app('request')->input('tab') === "orders" ? 'show active' : ''}}" id="tab-2"
                     role="tabpanel">
                    @include('layouts.admin.orders')
                </div>
                <div class="tab-pane fade {{app('request')->input('tab') === "products" ? 'show active' : ''}}" id="tab-3"
                     role="tabpanel">
                    @include('layouts.admin.products')
                </div>
                <div class="tab-pane fade {{app('request')->input('tab') === "items" ? 'show active' : ''}}" id="tab-4"
                     role="tabpanel">
                    @include('layouts.admin.items')
                </div>
            </div>
            <!-- end content tabs -->
        </div>
    </section>
@endsection
