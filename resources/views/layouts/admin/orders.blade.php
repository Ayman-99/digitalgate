<div class="row">
    <div class="col-12">
        {!! Form::label('tableSearch', 'Search', ['class' => 'form__label']) !!}
        {!! Form::text('tableSearch', ' ', ['class'=>"form__input", 'required', 'style'=>'width:20%;']) !!}
        <div class="table-responsive table-responsive--border">
            <table id='profileTables'
                   class="table table-dark table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Transaction</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Created</th>
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
            </table>
        </div>
    </div>

    <!-- paginator -->
    <div class="col-12">
        <div class="paginator">
            {{$users->links('vendor.pagination.custom')}}
        </div>
    </div>
    <!-- end paginator -->
</div>
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
