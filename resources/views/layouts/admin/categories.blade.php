@extends('layouts.admin')

@section('admincontent')
    <div class="row">
        <div class="col-12">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalAddObject">Add New
            </button>
            <button type="button" class="btn btn-danger unlockDeletingCategories">Unlock Deleting</button>
            <div class="table-responsive table-responsive--border">
                <table class="display DataTableToDisplay" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th># Of products</th>
                        <th>Visible</th>
                        <th>On Sale</th>
                        <th>Action 1</th>
                        <th>Action 2</th>
                        <th>Set sale</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($categories !== null && count($categories) > 0)
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{count($category->products)}}</td>
                                <td>{{$category->visible == 0 ? "No" : "Yes"}}</td>
                                <td>{{$category->sale == 0 ? "No" : "Yes(" . $category->sale_value . "%)"}}</td>
                                <td style="width:10%">
                                    <button type="button" class="btn btn-info update" data-toggle="modal"
                                            data-target="#modalUpdateObject" data-id="{{$category->id}}"
                                            data-whatever="{{$category->name}}">Update
                                    </button>
                                </td>
                                <td style="width:10%">
                                    {!! Form::open(['route'=>'front.admin.categories', 'method'=>'delete']) !!}
                                    <input type="hidden" name="id" value="{{$category->id}}">
                                    <input type="submit" class="btn btn-danger deletingCategorySubmitForm"
                                           value="Delete" disabled/>
                                    {!! Form::close() !!}
                                </td>
                                <td style="width:10%">
                                    <a onclick="addSale({{$category->id}})" class="btn btn-success">+</a>
                                    <a href="{{route('front.admin.categories.disable',['id' => $category->id])}}"
                                       class="btn btn-danger">-</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th># Of products</th>
                        <th>Visible</th>
                        <th>On Sale</th>
                        <th>Action 1</th>
                        <th>Action 2</th>
                        <th>Set sale</th>
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
                    {!! Form::open(['route' => ['front.admin.categories']]) !!}
                    <div class="form-group">
                        <label for="name">Category Name:</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name"
                               required>
                        <label for="name">Category Visbility:</label>
                        <select class="form-control" name="categoryVisible">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        @if(session()->get('fromMethod') === "addCategory")
                            @foreach ($errors->all() as $error)
                                <div class="feedback" style="color:#FF0000">* {{$error}}</div>
                            @endforeach
                        @endif
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
                    {!! Form::open(['route' => ['front.admin.categories']]) !!}
                    <div class="form-group">
                        <label for="name">Category Name:</label>
                        <input name="_method" type="hidden" value="PUT">
                        <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name"
                               required>
                        <input type="hidden" class="form-control" id="categoryId" name="category_id"
                               required>
                        <label for="name">Category Visbility:</label>
                        <select class="form-control" name="categoryVisible">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        @if(session()->get('fromMethod') === "updateCategory")
                            @foreach ($errors->all() as $error)
                                <div class="feedback" style="color:#FF0000">* {{$error}}</div>
                            @endforeach
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <script>
        function addSale(category) {
            val = prompt("Please enter sale value between (1 to 99)", "");
            url = "{{route('front.admin.categories.enable',['id' => $category->id])}}";
            window.location.href = url + "&val=" + val;
        }

        $('#modalUpdateObject').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('whatever')
            var modal = $(this)
            if (typeof recipient !== 'undefined') {
                modal.find('#name').val(recipient)
                modal.find('#categoryId').val(button.data('id'))
            }
        })
    </script>
    @if($errors->any())
        {{session()->get('fromMethod')}}
        @if(session()->get('fromMethod') === "addCategory")
            @foreach ($errors->all() as $error)
                <script>
                    $('#modalAddObject').modal('show')
                </script>
                @break
            @endforeach
        @else
            @foreach ($errors->all() as $error)
                <script>
                    $('#modalUpdateObject').modal('show')
                </script>
                @break
            @endforeach
        @endif
    @endif
@endsection
