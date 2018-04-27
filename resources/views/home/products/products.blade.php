@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-md-8 ">
            <div class="navbar-brand"><h1>Products</h1></div>
            <a href="{{ url('home/create') }}">
                <button type="button" class="btn btn-success btn-md">Create Products</button>
            </a>
            <a href="{{ url('/home/category') }}" class="float-right">
                <button type="button" class="btn btn-warning btn-md">Category</button>
            </a>
            <hr>
        </div>

        @include('layouts.session')

        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead class="thead-dark">
                    @if($columnName)
                        <tr>
                            <th scope="col">№</th>
                            @foreach($columnName as $k => $v)
                                <th scope="col">{{ $v }}</th>
                            @endforeach
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $val)
                        <tr>
                            <th scope="row" bgcolor="#fff8dc">{{ $loop->iteration }}</th>
                            @foreach($columnName as $k => $v)
                                <td bgcolor="#ffe4c4" style="max-width:350px; word-wrap:break-word;">
                                    <b>
                                        {{ $val->$v }}
                                    </b>
                                </td>
                            @endforeach
                            <td bgcolor="#e9967a" width="150px">
                                <a href="/home/present/{{ $val->id }}">
                                    <button type="button" class="btn btn-info btn-sm">s</button>
                                </a>
                                <a href="/home/update/{{ $val->id }}">
                                    <button type="button" class="btn btn-warning btn-sm">u</button>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#uploadModal{{ $val->id }}">d
                                </button>

                                <div id="uploadModal{{ $val->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title text-danger">Delete This file:</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form -->
                                                <form method='post' action='{{url('/home/delete/' . $val->id) }}'
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <label for="">Delete product: {{ $val->name }}</label>
                                                    <input type='submit' class='btn btn-danger btn-sm float-right'
                                                           value='Delete'>
                                                </form>
                                                <!-- Preview-->
                                                <div id='preview'></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <td>
                                <div class="alert alert-warning">Products is missing!</div>
                            </td>
                        </tr>
                    @endif

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="float-right">
                    {{ $products->links() }}

                </div>
            </div>
        </div>
    </div>
@endsection