@extends('layouts.app')

@section('content')
    <!-- page title -->
    <section class="section section--first section--last section--head" data-bg="{{asset('img/bg.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="jumbotron text-center">
                        <h1 class="display-3">Sorry!</h1>
                        <p class="lead"><strong>Seems you cancelled the request</strong></p>
                        <hr>
                        <p>
                            Having trouble? <a href="">Contact us</a>
                        </p>
                        <p class="lead">
                            <a class="btn btn-primary btn-sm" href="https://bootstrapcreative.com/" role="button">Continue to homepage</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->
@endsection
