@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="container">
            <div class="text-center">
                <div class="alert alert-success"><h3>Admin panel :)</h3></div>

                <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group">
                        <a href={{ url('/home/products') }}>
                            <button type="button" class="btn btn-primary btn-lg">Products:</button>
                        </a>
                        <a href="{{ url('/home/category') }}">
                            <button type="button" class="btn btn-warning btn-lg">Category</button>
                        </a>
                    </div>
                    <div class="btn-group-lg">
                        <a href="{{ url('/home/cart') }}">
                            <button type="button" class="btn btn-dark btn-lg">Cart</button>
                        </a>
                        <button type="button" class="btn btn-danger">Button 5</button>
                        <button type="button" class="btn btn-info">Button 6</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
