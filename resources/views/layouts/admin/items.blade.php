<div class="row">
    <div class="col-12">
        {!! Form::label('tableSearch', 'Search', ['class' => 'form__label']) !!}
        {!! Form::text('tableSearch', ' ', ['class'=>"form__input", 'required', 'style'=>'width:20%;']) !!}
        <br>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalAddItem">Add New</button>
        <div class="table-responsive table-responsive--border">
            <table id='profileTables'
                   class="table table-dark table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Value</th>
                    <th>Activated</th>
                    <th>Order ID</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{$item->product->name}}</td>
                        <td>{{$item->value}}</td>
                        <td>{{$item->activated === 1 ? "Yes" : "No"}}</td>
                        <td>{{$item->activated === 1 ? "#" . $item->order->id : "-1"}}</td>
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

<div class="modal fade" id="modalAddItem" tabindex="-1" role="dialog" aria-labelledby="modalAddItemLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/action_page.php" class="was-validated">
                    <div class="form-group">
                        <label for="product">Product:</label>
                        <select class="js-example-basic-single form-control" id="product" name="product" required>
                            @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->id . " - " . $product->name}}</option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="key">Key:</label>
                        <input type="text" class="form-control" id="key" placeholder="Enter serial key" name="key"
                               required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
