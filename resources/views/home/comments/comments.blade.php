@extends('layouts.app')










@section('content')
    <div class="container">
        <div class="col-md-12">

            @include('layouts.session')

            <div class="jumbotron row">
                @if($commentsToId )
                    @foreach($commentsToId as $comment)
                        <div class="page-header col-md-10">
                            <hr>
                            <div>
                                <h3 class="text-secondary">
                                    <b class="text-success">{{ $comment->name }}</b>
                                </h3>
                                <small class="text-secondary pull-right">{{ $comment->created_at }}</small>
                            </div>
                            <div class="well" style="word-wrap: break-word;">
                                <p>{{ $comment->comment }}</p>
                            </div>
                            <div class="alert alert-warning">
                                <p>В целом : {{ $comment->finally }}</p>
                            </div>
                            <div class="alert alert-danger">
                                <p> Product id: {{ $comment->products->id }} , Product name: {{ $comment->products->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-2 float-right " style="top:80px;">
                            <form method='post'
                                  action={{ url('/home/comment/change/'. $comment->id) }}>
                                @csrf
                                <button class="btn btn-success btn-lg">
                                    ADD
                                </button>
                            </form>
                            <hr>
                            <form method='post'
                                  action={{ url('/home/comment/delete/'. $comment->id) }}>
                                @csrf
                                <button class="btn btn-danger btn-lg">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-warning">
                        <p>Not Comments .</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection