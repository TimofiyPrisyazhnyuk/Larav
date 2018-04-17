@extends('shop.layouts.shop')


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





