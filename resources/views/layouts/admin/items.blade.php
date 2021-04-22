@extends('layouts.admin')

@section('admincontent')
    <div class="row">
        <div class="col-12">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalAddObject">Add New
            </button>
            <button type="button" class="btn btn-danger unlockDeletingItems">Unlock Deleting</button>

            <div class="table-responsive table-responsive--border">
                <table class="display DataTableToDisplay" style="width:100%">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Value</th>
                        <th>Activated</th>
                        <th>Order ID</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($items) > 0)
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item->product === null ? "DELETED(" . $item->product_id . ")" : $item->product->name}}</td>
                                <td>{{$item->value}}</td>
                                <td>{{$item->activated === 1 ? "Yes" : "No"}}</td>
                                <td>{{$item->activated === 1 ? "#" . $item->order->id : "-1"}}</td>
                                @if($item->activated === 0)
                                    <td style="width:10%">
                                        {!! Form::open(['route'=>'front.admin.items', 'method'=>'delete']) !!}
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <button type="submit" class="btn btn-danger deletingItemsSubmitForm" disabled>
                                            Delete
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Product</th>
                        <th>Value</th>
                        <th>Activated</th>
                        <th>Order ID</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAddObject" tabindex="-1" role="dialog" aria-labelledby="modalAddObjectLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddObjectLabel">Add new item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => ['front.admin.items', 'method'=>'post']]) !!}
                    <div class="form-group">
                        <label for="product">Product:</label>
                        <select class="js-example-basic-single form-control" id="product" name="product" required>
                            @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->id . " - " . $product->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="key">Key:</label>
                        <input type="text" class="form-control" id="key" placeholder="Enter serial key" name="key"
                               required>
                        @foreach ($errors->all() as $error)
                            <div class="feedback" style="color:#FF0000">* {{$error}}</div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @foreach ($errors->all() as $error)
        <script>
            $('#modalAddObject').modal('show')
        </script>
        @break
    @endforeach
@endsection
