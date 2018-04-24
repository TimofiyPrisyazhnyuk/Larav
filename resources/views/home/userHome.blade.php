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
                    <div class="col-md-6 float-left">
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
                    <div class="col-md-5 float-right">

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