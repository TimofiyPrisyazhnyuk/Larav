@extends('shop.layouts.shop')

@section('search')
    <div class="float-right">
        <form class="navbar-form navbar-right" role="search" action="{{ url('/') }}" method="post">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="search" value="" placeholder="Найти">
            </div>
            <button type="submit" class="fa fa-search "></button>
        </form>
    </div>
@endsection

@section('left-sidebar')
    <div class="left-sidebar">
        <h2>Каталог</h2>
        <div class="panel-heading">
            <ul class="nav nav-pills nav-stacked">

                <li class="active"><a href="{{ url('/') }}">Все</a></li>
                @foreach($category as $cat)
                    <li><a href="/{{ $cat['id'] }}">{{ $cat['name'] }}</a></li>
                @endforeach

            </ul>
        </div>
    </div>
@endsection


@section('content')
    @include('shop.layouts.content')
@endsection

@section('js')
@endsection



