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
                        <th>#</th>
                        <th>Name</th>
                        <th># Of products</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($categories !== null && count($categories) > 0)
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{count($category->products)}}</td>
                                <td style="width:10%">
                                    {!! Form::open(['route'=>'front.admin.restoreCategories', 'method'=>'post']) !!}
                                    <input type="hidden" name="id" value="{{$category->id}}">
                                    <button type="submit" class="btn btn-success">Restore</button>
                                    {!! Form::close() !!}
                                </td>
                                <td style="width:10%">
                                    {!! Form::open(['route'=>'front.admin.restoreCategories', 'method'=>'delete']) !!}
                                    <input type="hidden" name="id" value="{{$category->id}}">
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
                {{$categories->links('vendor.pagination.custom')}}
            </div>
        </div>
        <!-- end paginator -->
    </div>
@endsection
