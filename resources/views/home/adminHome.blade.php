@extends('layouts.app')

@section('content')
    <div class="container">
        @if($user != false)
            <div class=" col-md-6 alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <strong>Welcome to your account:</strong> {{ $user->name }}
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-5 float-left">
                        <div class="jumbotron">
                            <article class="scrollspy-example">
                                <h3 id="bast" class="text-info">About Us</h3>
                                <div class="alert alert-warning">
                                    <strong>Name: {{ $user->name }}</strong>
                                </div>
                                <div class="alert alert-dark">
                                    <strong>Email: {{ $user->email }}</strong>
                                </div>
                                <div class="alert alert-primary">
                                    <strong>Login: {{ $user->login }}</strong>
                                </div>
                                <p>Long story short...</p>
                                <p>(That is all).</p>
                                <h4 id="brogan">Products</h4>
                                <p>We have all sorts of products, including, but not limited to:</p>
                                <ul>
                                    <li>Boots</li>
                                    <li>Shoes</li>
                                    <li>Socks</li>
                                </ul>
                            </article>
                        </div>
                    </div>
                    <div class="col-md-7 float-right">
                        @ability('admin,manager', 'create-product,edit-user')
                        <div class="alert alert-secondary"><h3 class="text-danger">Control Panel:</h3></div>
                        <div class="alert">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-6 col-md-6">
                                        <a href={{ url('/home/products') }}>
                                            <button type="button" class="btn btn-danger btn-lg"> Products:</button>
                                        </a>
                                        <hr>
                                        <a href="{{ url('/home/category') }}">
                                            <button type="button" class="btn btn-warning btn-lg">Category</button>
                                        </a>
                                        <hr>
                                        <a href="{{ url('/home/cart') }}">
                                            <button type="button" class="btn btn-dark btn-lg">Cart</button>
                                        </a>
                                    </div>
                                    <div class="col-xs-6 col-md-6">
                                        @role('admin')
                                        <a href="{{ url('/home/comment') }}">
                                            <button type="button" class="btn btn-secondary btn-lg">Comment</button>
                                        </a>
                                        <a href="{{ url('/home/users') }}">
                                            <button type="button" class="btn btn-info btn-lg">Users</button>
                                        </a>
                                        @endrole
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endability
                </div>
            </div>
        @else
            <div class="alert alert-danger">
                <h2>Warning download your account information</h2>
            </div>
        @endif
    </div>

@endsection
