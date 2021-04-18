@extends('layouts.admin')

@section('admincontent')
    <div class="row">
        <div class="col-12">
            <div class="table-responsive table-responsive--border">
                <table class="display DataTableToDisplay" style="width:100%">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Value</th>
                        <th>Activated</th>
                        <th>Order ID</th>
                        <th>Deleted</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{$item->product === null ? "DELETED(" . $item->product_id . ")" : $item->product->name}}</td>
                            <td>{{$item->value}}</td>
                            <td>{{$item->activated === 1 ? "Yes" : "No"}}</td>
                            <td>{{$item->activated === 1 ? "#" . $item->order->id : "-1"}}</td>
                            <td>{{$item->deleted_at->diffForHumans()}}</td>
                            <td style="width:10%">
                                {!! Form::open(['route'=>'front.admin.restoreItems', 'method'=>'post']) !!}
                                <input type="hidden" name="id" value="{{$item->id}}">
                                <button type="submit" class="btn btn-success">Restore</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Product</th>
                        <th>Value</th>
                        <th>Activated</th>
                        <th>Order ID</th>
                        <th>Deleted</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
