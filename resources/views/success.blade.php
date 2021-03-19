@extends('layouts.app')

@section('content')
    <!-- page title -->
    <section class="section section--first section--last section--head" data-bg="{{asset('img/bg.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="jumbotron text-center">
                        @if(isset($flag) && isset($status) && $flag == 1)
                            <h1 class="display-3">Thank You!</h1><p><strong>Your order now is {{$status}}</strong></p>
                            <p class="lead"><strong>Please check your email</strong> for further instructions.</p>
                            <hr>
                        @elseif(isset($flag) && $flag == 2)
                            <h1 class="display-3">Something wrong happened!</h1>
                            <p class="lead"><strong>Please contact our support</strong> for further information</p>
                            <hr>
                        @endif
                        <p>
                            Having trouble? <a href="">Contact us</a>
                        </p>
                        <p class="lead">
                            <a class="btn btn-primary btn-sm" href="{{route('front.home')}}" role="button">Continue to
                                homepage</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->
@endsection
