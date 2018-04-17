@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col md-10">
                <nav class="navbar navbar-light bg-light">
                    <div class="pull-right" aria-label="Basic example">
                        <a class="navbar-brand" href="{{ url('/home/create') }}">
                            <h1>Product №:{{ $id }}</h1>
                        </a>
                        <a href="{{ url('/home/products') }}">
                            <button type="button" class="btn btn-info btn-sm">Products</button>
                        </a>
                        <a href=" {{ url('/home/update/' . $id) }}">
                            <button type="button" class="btn btn-warning btn-sm">Update</button>
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
                                        <form method='post' action='{{ url('/home/delete/' . $id) }}'
                                              enctype="multipart/form-data">
                                            @csrf
                                            <label for="">Delete product: {{ $productToId['name'] }}</label>
                                            <input type='submit' class='btn btn-danger btn-sm float-right'
                                                   value='Delete'>
                                        </form>
                                        <!-- Preview-->
                                        <div id='preview'></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--Add Photos--}}
                    <div class="pull-right">
                        <button type="button" class="btn btn-dark btn-lg" data-toggle="modal"
                                data-target="#uploadModal">Add Photos
                        </button>
                    </div>

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
                                    <form method='post' action='{{url('/home/present/upload/' . $id) }}'
                                          enctype="multipart/form-data">
                                        @csrf
                                        Select file : <input type='file' name='file' id='file' class='form-control'><br>
                                        <input type='submit' class='btn btn-info' value='Upload'>
                                    </form>
                                    <!-- Preview-->
                                    <div id='preview'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                @include('layouts.errors')

                @include('layouts.session')

                <div class="alert alert-dark">
                    <div class="thumbnail">

                        @include('layouts.ifPhoto')

                        <hr>
                        <div class="caption col-md-12">
                            <b class="text-danger">Name: </b>
                            <strong class="text-success">{{ $productToId->name }}</strong>
                        </div>
                        <hr>
                        <div class="caption col-md-12">
                            <b class="text-danger">Text: </b>
                            <strong class="text-success col-md-10"
                                    style="word-break: break-all;">{{ $productToId->text }}</strong>
                        </div>
                        <hr>
                        <div class="caption col-md-12">
                            <b class="text-danger">Price: </b>
                            <strong class="text-success col-md-10"
                                    style="word-break: break-all;">{{ $productToId->price }}</strong>
                        </div>
                        <hr>
                        <div class="caption col-md-12">
                            <b class="text-danger">Currency: </b>
                            <strong class="text-success col-md-10"
                                    style="word-break: break-all;">{{ $productToId->currency }}</strong>
                        </div>
                        <hr>
                        <div class="caption col-md-12">
                            <b class="text-danger">Category_id: </b>
                            <strong class="text-success col-md-10"
                                    style="word-break: break-all;">{{ $productToId->category_id }}</strong>
                        </div>
                        <hr>
                        <div class="caption col-md-12">
                            <b class="text-danger">User_id: </b>
                            <strong class="text-success col-md-10"
                                    style="word-break: break-all;">{{ $productToId->user_id }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
