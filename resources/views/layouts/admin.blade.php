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
                        <ul class="nav profile__tabs">
                            <li class="nav-item">
                                <a class="nav-link"
                                   style="background: transparent;border: none;color: #fff;" href="{{route('front.admin.viewUsers')}}">Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   style="background: transparent;border: none;color: #fff;"  href="{{route('front.admin.viewOrders')}}">Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   style="background: transparent;border: none;color: #fff;"  href="{{route('front.admin.items')}}">Items</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   style="background: transparent;border: none;color: #fff;"  href="{{route('front.admin.products')}}">Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   style="background: transparent;border: none;color: #fff;"  href="{{route('front.admin.categories')}}">Categories</a>
                            </li>
                            <li>
                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Recycle Bin
                                </button>
                                <div id="recyclebindrop" class="dropdown-menu" style="background-color: #1b222e;">
                                    <a class="dropdown-item" href="{{route('front.admin.restoreProducts')}}">Restore Prdoucts</a>
                                    <a class="dropdown-item" href="{{route('front.admin.restoreCategories')}}">Restore Categories</a>
                                    <a class="dropdown-item" href="{{route('front.admin.restoreItems')}}">Restore Items</a>
                                </div>
                            </li>
                        </ul>
                        <a class="profile__logout" href="{{route('logout')}}">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
           @yield('admincontent')
        </div>
        <script>
            @if(session()->has('successMessage'))
            Swal.fire({
                title: 'Performed successfully!',
                html: '{{session()->get('successMessage')}}',
                icon: 'success'
            })
            @endif
        </script>
    </section>
@endsection
