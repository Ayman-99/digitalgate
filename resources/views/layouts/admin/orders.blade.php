@extends('layouts.admin')

@section('admincontent')

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
                                <strong id="userNameToDisplay"></strong>
                            </div>
                            <div id="userEmailToDisplay"></div>
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
                    modal.find('#userNameToDisplay').text(t.userName);
                    modal.find('#userEmailToDisplay').text(t.userEmail);
                },
                error: function (t, e, s) {
                    console.log("error " + t.status);
                },
            });
        })
    </script>
@endsection
