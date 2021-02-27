@extends('layouts.admin')

@section('admincontent')
    <div class="row">
        <div class="col-12">
            {!! Form::label('tableSearch', 'Search', ['class' => 'form__label']) !!}
            {!! Form::text('tableSearch', ' ', ['class'=>"form__input", 'required', 'style'=>'width:20%;']) !!}
            <br>
            <div class="table-responsive table-responsive--border">
                <table id='profileTables'
                       class="table table-dark table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Value</th>
                        <th>Activated</th>
                        <th>Order ID</th>
                        <th>Deleted</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($items !== null && count($items) > 0)
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
                                <td style="width:10%">
                                    {!! Form::open(['route'=>'front.admin.restoreItems', 'method'=>'delete']) !!}
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>
                                <h3>No Data</h3>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- paginator -->
        <div class="col-12">
            <div class="paginator">
                {{$items->links('vendor.pagination.custom')}}
            </div>
        </div>
        <!-- end paginator -->
    </div>
@endsection
