@extends('layouts.admin')

@section('admincontent')
    <div class="row">
        <div class="col-12">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalAddObject">Add New
            </button>
            <button type="button" class="btn btn-danger unlockDeletingProducts">Unlock Deleting</button>
            <div class="table-responsive table-responsive--border">
                <table class="display DataTableToDisplay" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Sku</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Rate</th>
                        <th>Stock</th>
                        <th>Action 1</th>
                        <th>Action 2</th>
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
                            <td>{{$product->rate}}</td>
                            <td>{{count($product->items->where('activated','=','0')) > 0 ? count($product->items) : "Out of stock"}}</td>
                            <td style="width:10%">
                                <button type="button" class="btn btn-info update" data-toggle="modal"
                                        data-target="#modalUpdateObject" data-id="{{$product->id}}"
                                        data-name="{{$product->name}}" data-price="{{$product->price}}">Update
                                </button>
                            </td>
                            <td style="width:10%">
                                {!! Form::open(['route'=>'front.admin.products', 'method'=>'delete']) !!}
                                <input type="hidden" name="id" value="{{$product->id}}">
                                <input type="submit" class="btn btn-danger deletingProductsSubmitForm" value="Delete" disabled />
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
                        <th>Rate</th>
                        <th>Stock</th>
                        <th>Action 1</th>
                        <th>Action 2</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Add new</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => ['front.admin.products'], 'files'=>true]) !!}
                    <div class="form-group">
                        <label for="productCategory">Category:</label>
                        <select class="js-example-basic-single form-control" id="productCategory" name="productCategory"
                                required>
                            @foreach(\Illuminate\Support\Facades\Cache::get('categories') as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="productName">Product Name:</label>
                        <input type="text" class="form-control" id="productName" placeholder="Enter product name"
                               name="productName"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="productDesc">Product Description:</label>
                        <textarea name="productDesc" id="productDesc" class="form-control" cols="30" rows="10"
                                  required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="productPrice">Product Price:</label>
                        <input type="text" class="form-control" id="productPrice" placeholder="Enter product price"
                               name="productPrice"
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
    <div class="modal fade" id="modalUpdateObject" tabindex="-1" role="dialog" aria-labelledby="modalUpdateObjectLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUpdateObjectLabel">Update item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => ['front.admin.products'], 'method'=>'put']) !!}
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="productCategory2">Category:</label>
                        <select class="js-example-basic-single form-control" id="productCategory2" name="productCategory"
                                required>
                            @foreach(\Illuminate\Support\Facades\Cache::get('categories') as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="productName">Product Name:</label>
                        <input type="text" class="form-control" id="product_name" placeholder="Enter product name"
                               name="productName"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="productPrice">Product Price:</label>
                        <input type="text" class="form-control" id="product_price" placeholder="Enter product price"
                               name="productPrice"
                               required>
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
    <script>
        $('#modalUpdateObject').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var price = button.data('price')
            var modal = $(this)
            if (typeof id !== 'undefined') {
                modal.find('#product_id').val(id)
                modal.find('#product_name').val(name)
                modal.find('#product_price').val(price)
            }
        })
    </script>
    @if($errors->any())
        {{session()->get('fromMethod')}}
        @if(session()->get('fromMethod') === "updateProduct")
            @foreach ($errors->all() as $error)
                <script>
                    $('#modalUpdateObject').modal('show')
                </script>
                @break
            @endforeach
        @else
            @foreach ($errors->all() as $error)
                <script>
                    $('#modalAddObject').modal('show')
                </script>
                @break
            @endforeach
        @endif
    @endif
@endsection
