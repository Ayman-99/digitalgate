@extends('layouts.admin')

@section('admincontent')
    <div class="row">
        <div class="col-12">
            <div class="table-responsive table-responsive--border">
                <table class="display DataTableToDisplay" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Sku</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Sale Price</th>
                        <th>Rate</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
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
                                <input type="submit" class="btn btn-success" value="Restore"/>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Sku</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Sale Price</th>
                        <th>Rate</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
