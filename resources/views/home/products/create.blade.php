@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col md-10">
                <nav class="navbar navbar-light bg-light">
                    <a class="navbar-brand" href="{{ url('/home/create') }}">
                        <button type="button" class="btn btn-secondary btn-lg">Create Products</button>
                    </a>
                    <a href="{{ url('/home/products') }}">
                        <button type="button" class="btn btn-info btn-sm">Products</button>
                    </a>
                </nav>

                @include('layouts.errors')

                @include('layouts.session')


                <form class="form-horizontal" action="{{ route('create_create') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="input1" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="input1" name="name" placeholder="Name"
                                   value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input2" class="col-sm-2 control-label">Text</label>
                        <div class="col-sm-6">
                            <textarea cols="70" id="input2" title="Text" rows="5"
                                      name="text">{{ old('text') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input4" class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="input4" name="price" placeholder="Price"
                                   value="{{ old('price') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input5" class="col-sm-2 control-label">Currency</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="input5" name="currency" placeholder="currency"
                                   value="{{ old('currency') }}">
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
                            <button type="submit" class="btn btn-success">CREATE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection