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
                                   style="background: transparent;border: none;color: #fff;"  href="{{route('front.admin.viewItems')}}">Items</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   style="background: transparent;border: none;color: #fff;"  href="{{route('front.admin.viewProducts')}}">Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   style="background: transparent;border: none;color: #fff;"  href="{{route('front.admin.viewCategory')}}">Categories</a>
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
            Swal.fire(
                'Performed successfully!',
                '{{session()->get('successMessage')}}',
                'success'
            )
            @endif
        </script>
        <script>
            function deleteObject(path){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = path;
                    }
                })
            }
        </script>
    </section>

@endsection
