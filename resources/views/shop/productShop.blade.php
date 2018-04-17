@extends('shop.layouts.shop')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-9">
                    <h2 class="text-success">{{ $productToId['name'] }}</h2>
                    <div class="alert alert-default text-info">
                        <h4>Вас интересует бытовая техника, компьютеры, софт или товары для активного отдыха? Все это вы
                            можете купить прямо сейчас, сэкономив уйму времени! Интернет-магазин!!
                        </h4>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-7 ">

                @include('layouts.ifPhoto')

                <hr>
                <div class="row">
                    <h4 class="text-danger">Name: </h4>
                    <strong class="text-success">{{ $productToId['name'] }}</strong>
                </div>
                <hr>
                <div class="row">
                    <h4 class="text-danger">Text: </h4>
                    <b class="text-success col-md-10"
                       style="word-break: break-all;">{{ $productToId['text'] }}</b>
                </div>
                <hr>
                <div class="row">
                    <h4 class="text-danger">Guarantee: </h4>
                    <p class="text-warning col-md-10">На товары в нашем магазине предоставляется гарантия,
                        подтверждающая
                        обязательства по отсутствию в
                        товаре заводских дефектов. Гарантия предоставляется на срок от 2-х недель до 99 месяцев в
                        зависимости от сервисной политики производителя.
                    </p>
                </div>
                <hr>
                <div class="row">
                    <h4 class="text-danger">Payment: </h4>
                    <p class="text-info col-md-8">Наличными, Безналичными, Кредит, Visa/MasterCard, Мгновенная
                        рассрочка,
                        WebMoney, Приват2
                    </p>
                </div>
                <hr>
                <div class="row ">
                    <h4 class="text-danger">Price: </h4>
                    <strong class="text-success "
                            style="word-break: break-all;">{{ $productToId['price'] . ' ' . $productToId['currency'] }}</strong>
                </div>
                <hr>
                <div class="col-md-10">
                    <a href="{{ url('/cart/add/'. $productToId['id']) }}"
                       class="btn btn-success">
                        <h2 class="text-center">Вкорзину <i class="fa fa-shopping-cart fa-1x"></i></h2>
                    </a>
                    <hr>
                </div>
            </div>


            <div class="col md-4">
                <div class="alert-warning col-md-4">
                    <h1>Hello, world!</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, aspernatur assumenda atque
                        deserunt dolores fugiat harum impedit iure iusto nam numquam, omnis placeat quidem voluptates,
                        voluptatum. Accusantium aliquam, dolor dolorum explicabo illum iusto labore maiores nihil
                        pariatur quae quas, quibusdam saepe sit vitae voluptate.</p>
                    <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
                </div>
            </div>
        </div>
    </div>

    <div class="alert alert-info">
        <h3>Поделитесь своим мнением с нами !!!</h3>
        <p>Отзывы пользователей помогают нам менять дизайн наших продуктов, улучшать наши политики и устранять
            технические проблемы.</p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="alert alert-primary">
                    <h3> Оставить коментарий: </h3>
                </div>
                <p class="text-info">Your comments:</p>

                @include('layouts.errors')

                <form role="form" action="{{ url('/product/comments/' . $productToId['id']) }}" method="post"
                      class="col-md-5">
                    @csrf
                    <div class="form-group">
                        <input name="name" type="text" class="form-control" placeholder="Имя"/>
                    </div>
                    <div class="form-group">
                        <textarea name="comment" class="form-control" rows="5" placeholder="Сообщение"></textarea>
                    </div>
                    <div class="form-group">
                        <label><input type="radio" name="finally" value="good"> Доволен</label>
                        <label><input type="radio" name="finally" value="not good"> Не доволен</label>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-info" value="Отправить"/>
                    </div>
                </form>
                <div class="col-md-7">
                    <h3 class="text-warning">But if you have any offers how to improve anything I've described or if you
                        just want to leave
                        feedback please post you comments on my site.</h3>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        @include('layouts.session')

                        <div class="text-primary">
                            <h2 class="text-center">Comments:</h2>
                        </div>

                        <div class="col-md-12">
                            <div class="jumbotron row">

                                @if($commentsToId )
                                    @foreach($commentsToId as $comment)
                                        @foreach($comment as $key => $value)
                                            <div class="page-header col-md-10">
                                                <div>
                                                    <h3 class="text-secondary">
                                                        <b class="text-success">{{ $value->name }}</b>
                                                    </h3>
                                                    <small class="text-secondary pull-right">{{ $value->created_at }}</small>
                                                </div>
                                                <div class="well" style="word-wrap: break-word;">
                                                    <p>{{ $value->comment }}</p>
                                                </div>
                                                <div class="alert alert-warning">
                                                    <p>В целом : {{ $value->finally }}</p>
                                                </div>
                                            </div>

                                        @endforeach
                                    @endforeach
                                @else
                                    <div class="alert alert-warning">
                                        <p>Not Comments .</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection