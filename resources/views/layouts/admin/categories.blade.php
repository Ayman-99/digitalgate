@extends('layouts.admin')

@section('admincontent')
    <div class="row">
        <div class="col-12">
            {!! Form::label('tableSearch', 'Search', ['class' => 'form__label']) !!}
            {!! Form::text('tableSearch', ' ', ['class'=>"form__input", 'required', 'style'=>'width:20%;']) !!}
            <br>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalAddObject">Add New
            </button>
            <div class="table-responsive table-responsive--border">
                <table id='profileTables'
                       class="table table-dark table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th># Of products</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{count($category->products)}}</td>
                            <td style="width:10%">
                                <button type="button" class="btn btn-info update" data-toggle="modal"
                                        data-target="#modalUpdateObject" data-id="{{$category->id}}" data-whatever="{{$category->name}}">Update
                                </button>
                            </td>
                            <td style="width:10%"><a onclick='deleteObject("{{route('front.admin.deleteCategory', ['id'=>$category->id])}}")' class="btn btn-danger">Delete</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- paginator -->
        <div class="col-12">
            <div class="paginator">
                {{$categories->links('vendor.pagination.custom')}}
            </div>
        </div>
        <!-- end paginator -->
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
                    {!! Form::open(['route' => ['front.admin.addCategory']]) !!}
                    <div class="form-group">
                        <label for="name">Category Name:</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name"
                               required>
                        <input type="hidden" class="form-control" name="categoryName"
                               required>
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
                    {!! Form::open(['route' => ['front.admin.updateCategory']]) !!}
                    <div class="form-group">
                        <label for="name">Category Name:</label>
                        <input name="_method" type="hidden" value="PUT">
                        <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name"
                               required>
                        <input type="hidden" class="form-control" id="categoryId" name="category_id"
                               required>
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
