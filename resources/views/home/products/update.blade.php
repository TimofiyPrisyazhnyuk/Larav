@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col md-10">
                <nav class="navbar navbar-light bg-light">
                    <h1 calss="text-warning">Update Products №: {{ $id }}</h1>
                    <a class="navbar-brand" href="{{ url('/home/update/' . $id) }}">
                        <button type="button" class="btn btn-warning btn-sm">Update</button>
                    </a>
                    <a href="{{ url('/home/products') }}">
                        <button type="button" class="btn btn-info btn-sm">Products</button>
                    </a>
                    <a href="{{ url('/home/present/' . $id) }}">
                        <button type="button" class="btn btn-success btn-sm">Show</button>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                            data-target="#uploadModal{{ $id }}">Delete
                    </button>

                    <div id="uploadModal{{ $id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title text-danger">Delete This file:</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form -->
                                    <form method='post' action={{ url('/home/delete/'. $id) }}
                                            enctype="multipart/form-data">
                                        @csrf
                                        <label for="">Delete product: {{ $getUpdatesData->name }}</label>
                                        <input type='submit' class='btn btn-danger btn-sm float-right' value='Delete'>
                                    </form>
                                    <!-- Preview-->
                                    <div id='preview'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <hr>

                @include('layouts.errors')

                @include('layouts.session')

                @include('layouts.ifPhoto')

                {{--Add Photos--}}
                <div class="float-right">
                    <button type="button" class="btn btn-dark btn-lg" data-toggle="modal"
                            data-target="#uploadModal">Add Photos
                    </button>
                </div>
                <hr>
                <!-- Modal -->
                <div id="uploadModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title text-danger">Upload Image file:</h4>
                            </div>
                            <div class="modal-body">
                                <!-- Form -->
                                <form method='post' action={{ url('/home/present/upload/'. $id) }}
                                        enctype="multipart/form-data">
                                    @csrf
                                    Select file : <input type='file' name='file' id='file' class='form-control'><br>
                                    <input type='submit' class='btn btn-info' value='Upload' id='upload'>
                                </form>
                                <!-- Preview-->
                                <div id='preview'></div>
                            </div>
                        </div>
                    </div>
                </div>


                <form class="form-horizontal" action="{{ url('/home/update/upload/' . $id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="input1" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="input1" name="name" placeholder="Name"
                                   value="{{ $getUpdatesData['name'] }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input2" class="col-sm-2 control-label">Text</label>
                        <div class="col-sm-6">
                            <textarea cols="70" id="input2" title="Text" rows="5"
                                      name="text">{{ $getUpdatesData['text'] }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input4" class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="input4" name="price" placeholder="Price"
                                   value="{{ $getUpdatesData['price'] }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input5" class="col-sm-2 control-label">Currency</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="input5" name="currency"
                                   placeholder="currency"
                                   value="{{ $getUpdatesData['currency'] }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Category_id</label>
                        <select class="selectpicker" title="category" name="category_id">
                            @foreach($category_id as $category)
                                <option>{{ $category }}</option>
                            @endforeach
                        </select>

                        <label class="control-label">User_id</label>
                        <select class="selectpicker" title="users" name="user_id">
                            @foreach($user_id as $user)
                                <option>{{ $user }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-info">UPDATE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection