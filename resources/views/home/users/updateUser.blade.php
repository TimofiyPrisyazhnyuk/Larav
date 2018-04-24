@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.session')
        @if($user != false)
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-7 float-left">
                        <div class="jumbotron">
                            <h2 class="text-danger">User №:{{ $user->id }}</h2>
                            <article class="scrollspy-example">
                                <hr>
                                <div class="alert">
                                    <h4 class="text-warning">User id: {{ $user->id }}</h4>
                                </div>
                                <hr>
                                <div class="alert">
                                    <h4 class="text-warning">User name: {{ $user->name }}</h4>
                                </div>
                                <hr>
                                <div class="alert">
                                    <h4 class="text-secondary">Email: {{ $user->email }}</h4>
                                </div>
                                <hr>
                                <div class="alert">
                                    <h4 class="text-secondary">Login: {{ $user->login }}</h4>
                                </div>
                                <hr>
                                <div class="alert" style="word-break: break-all">
                                    <h4 class="text-dark">Password: {{ $user->password }}</h4>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="col-md-5 float-right">
                        <div class="alert alert-success">
                            <h4 class="text-success">User Permissions</h4>
                            <ul>
                                @if($userPermissions != false)
                                    @foreach($userPermissions as $item)
                                        <li class="text-danger">{{ $item }}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5 float-right">
                        <div class="alert alert-dark">
                            <h4 class="text-success">User Role</h4>
                            <ul>
                                @if($userRole != false)
                                    @foreach($userRole as $item)
                                        <li class="text-danger">{{ $item->name }}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5 float-right">
                        <div class="alert alert-danger">
                            <h4 class="text-secondary">Add Role to this user:</h4>
                            <form action="{{ url('/home/users/addRole/' . $user->id  ) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    @if($role != false)
                                        <label for="sel1">Select Role:</label>
                                        <select class="form-control" name="role" id="sel1">
                                            @foreach($role as $item)
                                                <option>{{ $item->name  }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-warning">Add Role</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-5 float-right">
                        <div class="alert alert-warning">
                            <h4 class="text-danger">Delete Role:</h4>
                            <form action="{{ url('/home/users/deleteRole/' . $user->id  ) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    @if($userRole != false)
                                        <label for="sel1">Select Role:</label>
                                        @foreach($userRole as $item)
                                            <div class="radio">
                                                <label><input type="radio" value="{{ $item->id }}"
                                                              name="roleId">{{ $item->name }}</label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-danger">Delete Role</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        @else
            <div class="alert alert-danger">
                <h2>Warning download your account information</h2>
            </div>
        @endif
    </div>

@endsection