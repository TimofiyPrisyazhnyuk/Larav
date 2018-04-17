@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class=" col-md-3 alert alert-success">
                <h1>Category</h1>
            </div>

            {{-- Create new Category--}}
            <div class=" col-md-3 btn-group">
                <a href="#">
                    <button class="btn-success btn-lg" data-toggle="modal" data-target="#modalSubscriptionForm">
                        AddCategory
                    </button>
                </a>
            </div>

            <div class="modal fade" id="modalSubscriptionForm" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title w-100 font-weight-bold">Create Category</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body mx-3">
                            <form method='post' action='{{ url('/home/category/create') }}'>
                                @csrf
                                <div class="form-group">
                                    <label for="example">Name: </label>
                                    <input type="text" class="form-control" name="name" placeholder="Category name">
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{--End Create Category--}}
            <div class=" col-md-3 btn-group">
                <a href="{{ url('/home/products') }}">
                    <button class="btn-warning btn-lg">Products</button>
                </a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                @include('layouts.errors')

                @include('layouts.session')

                <table class="table">
                    <thead class="thead-dark">
                    @if($columnName != null)
                        <tr>
                            @foreach($columnName as $name => $item)
                                <th>
                                    <div class="alert alert-info">
                                        {{ $item }}
                                    </div>
                                </th>
                            @endforeach
                            <th>
                                <div class="alert alert-danger">Options</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($category as $k => $v)
                        <tr>
                            <td width="50px">
                                <div class="alert alert-dark">
                                    {{ $v['id']}}
                                </div>
                            </td>
                            <td width="600px">
                                <div class="alert alert-dark" style="word-wrap: break-word;">
                                    {{ $v['name'] }}
                                </div>
                            </td>

                            <td width="50px">
                                {{-- Create new Category--}}
                                <button class="btn-warning btn-sm" data-toggle="modal"
                                        data-target="#modalSubscriptionForm{{ $v['id']}}">Upd
                                </button>
                                <div class="modal fade" id="modalSubscriptionForm{{ $v['id'] }}" tabindex="-1"
                                     role="dialog"
                                     aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header text-center">
                                                <h4 class="modal-title w-100 font-weight-bold">Update
                                                    Category: {{ $v['name'] }}</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body mx-3">
                                                <form method='post'
                                                      action='{{ url('/home/category/update/'. $v['id']) }}'>
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="example">Name: </label>
                                                        <input type="text" class="form-control" name="name"
                                                               value="{{ $v['name'] }}"
                                                               placeholder="Category name">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-danger btn-sm" data-toggle="modal"
                                        data-target="#modal1{{ $v['id']}}">Del
                                </button>
                                <div class="modal fade" id="modal1{{ $v['id']}}" tabindex="-1"
                                     role="dialog"
                                     aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header text-center">
                                                <h4 class="modal-title w-100 font-weight-bold">Delete
                                                    Category: {{ $v['name'] }}</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body mx-3">
                                                <form method='post'
                                                      action={{ url('/home/category/delete/'. $v['id']) }}>
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Delete:</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--End Create Category--}}
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <td>
                                <div class="alert alert-warning"> Not Categories!</div>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection