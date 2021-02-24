@extends('layouts.admin')

@section('admincontent')
    <div class="row">
        <div class="col-12">
            {!! Form::label('tableSearch', 'Search', ['class' => 'form__label']) !!}
            {!! Form::text('tableSearch', ' ', ['class'=>"form__input", 'required', 'style'=>'width:20%;']) !!}
            <br>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalAddObject">Add New</button>
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
                        <th>Stock</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->sku}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->sale}}</td>
                            <td>{{$product->rate}}</td>
                            <td>{{count($product->items) > 0 ? count($product->items) : "Out of stock"}}</td>
                            <td style="width:10%"><a onclick='deleteObject("{{route('front.admin.deleteProduct', ['id'=>$product->id])}}")' class="btn btn-danger">Delete</a></td>
                        </tr>
                    @endforeach
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

    <div class="modal fade" id="modalAddObject" tabindex="-1" role="dialog" aria-labelledby="modalAddObjectLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => ['front.admin.addProduct'], 'files'=>true]) !!}
                        <div class="form-group">
                            <label for="productCategory">Category:</label>
                            <select class="js-example-basic-single form-control" id="productCategory" name="productCategory" required>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->id . " - " . $category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="productName">Product Name:</label>
                            <input type="text" class="form-control" id="productName" placeholder="Enter product name" name="productName"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="productDesc">Product Description:</label>
                            <textarea name="productDesc" id="productDesc" class="form-control" cols="30" rows="10" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="productPrice">Product Price:</label>
                            <input type="text" class="form-control" id="productPrice" placeholder="Enter product price" name="productPrice"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="productSale">Product Sale:</label>
                            <input type="text" class="form-control" id="productSale" placeholder="Enter product sale" name="productSale"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="productImage">Product Image:</label>
                            <input type="file" class="form-control-file" id="productImage" name="productImage" required>
                        </div>
                        <div class="form-group">
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
