@extends('layouts.app')

@section('content')
    <!-- page title -->
    <section class="section section--first section--last section--head" data-bg="{{asset("img/web/bg-for-profile.jpg")}}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__wrap">
                        <!-- section title -->
                        <h2 class="section__title">Profile</h2>
                        <!-- end section title -->

                        <!-- breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb" style="background: transparent;">
                                <li class="breadcrumb-item"><a href="{{route('front.home')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
    <section class="section section--last">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="profile">
                        <ul class="nav nav-tabs profile__tabs" id="profile__tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{app('request')->input('tab') === "settings" ? 'active' : ''}}"
                                   data-toggle="tab"
                                   style="background: transparent;border: none;color: #fff;" href="#tab-2" role="tab"
                                   aria-controls="tab-2"
                                   aria-selected="true">Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{app('request')->input('tab') === "orders" ? 'active' : ''}}"
                                   style="background: transparent;border: none;color: #fff;"
                                   data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1"
                                   aria-selected="false">My purchases</a>
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
                <div class="tab-pane fade {{app('request')->input('tab') === "orders" ? 'show active' : ''}}" id="tab-1"
                     role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive table-responsive--border">
                                <table class="display DataTableToDisplay" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Transaction</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->transaction}}</td>
                                            <td>{{$order->total}}$</td>
                                            <td>{{$order->status}}</td>
                                            <td>{{$order->created_at->diffForHumans()}}</td>
                                            <td>
                                                <button type="button" class="btn btn-info" data-toggle="modal"
                                                        data-target="#invoice" data-whatever="{{$order->id}}">Details
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Transaction</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade {{app('request')->input('tab') === "settings" ? 'show active' : ''}}"
                     id="tab-2" role="tabpanel">
                    <div class="row">
                        <!-- details form -->
                        <div class="col-12 col-lg-6">
                            {!! Form::open(['route'=>['front.profile.update', Auth::user()->name], 'method'=>'put']) !!}
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="form__title">Profile details</h4>
                                </div>
                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                    {!! Form::label('name', 'Username', ['class' => 'form__label']) !!}
                                    {!! Form::text('name', Auth::user()->name, ['class'=>"form__input", 'required']) !!}
                                </div>
                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                    {!! Form::label('email', 'Email', ['class' => 'form__label']) !!}
                                    {!! Form::email('email', Auth::user()->email, ['class'=>"form__input", 'required']) !!}
                                </div>

                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                    {!! Form::label('confPass', 'Confirm Password', ['class' => 'form__label']) !!}
                                    {!! Form::password('confPass', ['class'=>"form__input", 'required']) !!}
                                </div>
                                <div class="col-12">
                                    <button class="form__btn" type="submit">Update</button>
                                </div>
                            </div>
                            <br>
                            {!! Form::close() !!}
                            @if (count($errors) > 0 && Session::has('updateDataFlag'))
                                <div class="alert alert-danger alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    @foreach ($errors->all() as $error)
                                        <strong>* </strong> {{ $error }}.<br>
                                    @endforeach
                                </div>
                            @elseif(Session::has('messageUpdateData'))
                                <div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong></strong> {{ Session::get('messageUpdateData') }}.<br>
                                </div>
                            @endif
                        </div>
                        <!-- end details form -->

                        <!-- password form -->
                        <div class="col-12 col-lg-6">
                            {!! Form::open(['route'=> ['front.profile.updatePassword', 'name'=>Auth::user()->name], 'method'=>'PUT']) !!}
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="form__title">Change password</h4>
                                </div>
                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                    {!! Form::label('oldpass','Old Password', ['class'=>'form__label']) !!}
                                    {!! Form::password('oldpass',['class'=>'form__input', 'required'=>'']) !!}
                                </div>
                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                    {!! Form::label('newpass','New Password', ['class'=>'form__label']) !!}
                                    {!! Form::password('newpass',['class'=>'form__input', 'required'=>'']) !!}
                                </div>
                                <div class="col-12">
                                    <button class="form__btn" type="submit">Change</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                            <br>
                            @if (count($errors) > 0 && Session::has('updatePasswordFlag'))
                                <div class="alert alert-danger alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    @foreach ($errors->all() as $error)
                                        <strong>* </strong> {{ $error }}.<br>
                                    @endforeach
                                </div>
                            @elseif(Session::has('messageUpdatePassword'))
                                <div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('messageUpdatePassword') }}.<br>
                                </div>
                            @endif
                        </div>
                        <!-- end password form -->
                    </div>
                </div>
            </div>
            <!-- end content tabs -->
        </div>
    </section>
    <!-- end section -->
    <div class="modal fade " id="invoice" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="OrderInvoice">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h6 class="mb-3">From:</h6>
                            <div>
                                <strong>Digital Gate</strong>
                            </div>
                            <div>Email: info@digitalgate.com</div>
                        </div>

                        <div class="col-sm-6">
                            <h6 class="mb-3">To:</h6>
                            <div>
                                <strong>{{Auth::user()->name}}</strong>
                            </div>
                            <div>Email: {{Auth::user()->email}}</div>
                        </div>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Items</th>
                                <th class="right">Unit Cost</th>
                                <th class="right">Total</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-5">
                        </div>
                        <div class="col-lg-4 col-sm-5 ml-auto">
                            <table class="table table-clear">
                                <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="right" id="invSubTotal"></td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Discount</strong>
                                    </td>
                                    <td class="right" id="invDiscount"></td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="right">
                                        <strong id="invTotal"></strong>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#invoice').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('whatever')
            var modal = $(this)
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{Auth::check() ? route("front.profile.order",['name'=>Auth::user()->name]) : ""}}",
                type: "POST",
                async: !1,
                cache: !0,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "order_id": recipient
                },
                success: function (t) {
                    modal.find('.table-striped tbody').html(t.body)
                    modal.find('#invSubTotal').text(t.subTotal)
                    modal.find('#invDiscount').text(t.discount)
                    modal.find('#invTotal').text(t.total)
                },
                error: function (t, e, s) {
                    alert(t.responseText);
                    console.log("error " + t.status);
                },
            });
        })
    </script>
@endsection
