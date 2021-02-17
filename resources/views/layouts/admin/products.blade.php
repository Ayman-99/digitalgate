<div class="row">
    <div class="col-12">
        {!! Form::label('tableSearch', 'Search', ['class' => 'form__label']) !!}
        {!! Form::text('tableSearch', ' ', ['class'=>"form__input", 'required', 'style'=>'width:20%;']) !!}
        <br>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalAddProduct">Add New</button>
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
                        <td>{{count($product->items) > 0 ? $product->items : "Out of stock"}}</td>
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

<div class="modal fade" id="modalAddProduct" tabindex="-1" role="dialog" aria-labelledby="modalAddProductLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
