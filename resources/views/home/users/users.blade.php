@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-md-8 ">
            <div class="navbar-brand"><h1>Users</h1></div>
            <hr>
        </div>
    </div>
    <div class="container-fluid">
        @include('layouts.session')

        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead class="thead-dark">
                    @if($userColumnName)
                        <tr>
                            <th scope="col">№</th>
                            @foreach($userColumnName as $k => $v)
                                <th scope="col">{{ $v }}</th>
                            @endforeach
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($user as $val)
                        <tr>
                            <th scope="row" bgcolor="#fff8dc">{{ $loop->iteration }}</th>
                            @foreach($userColumnName as $k => $v)
                                <td bgcolor="#ffe4c4" style="max-width:350px; word-wrap:break-word;">
                                    <b>
                                        {{ $val->$v }}
                                    </b>
                                </td>
                            @endforeach
                            <td bgcolor="#e9967a" width="150px">
                                <a href="/home/users/update/{{ $val->id }}">
                                    <button type="button" class="btn btn-warning btn-sm">update</button>
                                </a>
                                <a href="/home/users/delete/{{ $val->id }}">
                                    <button type="button" class="btn btn-danger btn-sm">delete</button>
                                </a>

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
    </div>
@endsection