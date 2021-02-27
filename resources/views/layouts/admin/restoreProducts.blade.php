@extends('layouts.admin')

@section('admincontent')
    <div class="row">
        <div class="col-12">
            {!! Form::label('tableSearch', 'Search', ['class' => 'form__label']) !!}
            {!! Form::text('tableSearch', ' ', ['class'=>"form__input", 'required', 'style'=>'width:20%;']) !!}
            <br>
            <button type="button" class="btn btn-success unlockRestoring">Unlock Restoring</button>
            <div class="table-responsive table-responsive--border">
                <table id='profileTables'
                       class="table table-dark table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Sku</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Sale Price</th>
                        <th>Rate</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($products !== null && count($products) > 0)
                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->category === null ? "DELETED(" . $product->category_id . ")" : $product->category->name}}</td>
                                <td>{{$product->sku}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->sale}}</td>
                                <td>{{$product->rate}}</td>
                                <td style="width:10%">
                                    {!! Form::open(['route'=>'front.admin.restoreProducts', 'method'=>'post']) !!}
                                    <input type="hidden" name="id" value="{{$product->id}}">
                                    <input type="submit" class="btn btn-success restoreSubmitForm" value="Restore" disabled/>
                                    {!! Form::close() !!}
                                </td>
                                <td style="width:10%">
                                    {!! Form::open(['route'=>'front.admin.restoreProducts', 'method'=>'delete']) !!}
                                    <input type="hidden" name="id" value="{{$product->id}}">
                                    <input type="submit" class="btn btn-danger" value="Delete"/>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td><h3>No Data</h3></td></tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- paginator -->
        <div class="col-12">
            <div class="paginator">
                {{$products->links('vendor.pagination.custom')}}
            </div>
        </div>
        <!-- end paginator -->
    </div>
@endsection
