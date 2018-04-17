@extends('shop.layouts.shop')

@section('header')
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href=""><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                                <li><a href=""><i class="fa fa-envelope"></i> info@domain.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                                <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                                <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->

        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="/"><img src="{{ url('images/home/logo.png') }}" alt=""/></a>
                        </div>
                        <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa"
                                        data-toggle="dropdown">
                                    USA
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="">Canada</a></li>
                                    <li><a href="">UK</a></li>
                                </ul>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa"
                                        data-toggle="dropdown">
                                    DOLLAR
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="">Canadian Dollar</a></li>
                                    <li><a href="">Pound</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href=""><i class="fa fa-user"></i> Account</a></li>
                                <li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
                                <li><a href=""><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                <li><a href="{{ url('/cart') }}" class="active"><i class="fa fa-shopping-cart"></i> Cart</a>
                                </li>
                                <li><a href="{{ url('/login') }}"><i class="fa fa-lock"></i> Login</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->

        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                    data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="">Products</a></li>
                                        <li><a href="">Product Details</a></li>
                                        <li><a href="">Checkout</a></li>
                                        <li><a href="{{ url('/cart') }}" class="active">Cart</a></li>
                                        <li><a href="{{ url('/login') }}">Login</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="">Blog List</a></li>
                                        <li><a href="">Blog Single</a></li>
                                    </ul>
                                </li>
                                <li><a href="">404</a></li>
                                <li><a href="{{ url('/contact') }}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right">
                            <input type="text" placeholder="Search"/>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->
@endsection

@section('left-sidebar')

@endsection

@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                @if(isset($products) && $totalPrice)
                    <table class="table table-condensed">
                        <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description"></td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $key => $val)
                            <tr>
                                <td class="cart_product">
                                    @if((File::exists("uploads/images/".$val['item']->image)) && $val['item']->image != null)
                                        <img src="{{ url('uploads/images/' . $val['item']->image) }}"
                                             style="width: 160px; height: 170px; ">
                                    @else
                                        <img src="{{ url('uploads/images/default.png') }}"
                                             style="width: 160px; height: 170px">
                                    @endif
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{ $val['item']->name }}</a></h4>
                                    <p>Web ID: {{ $val['item']->id }}</p>
                                </td>
                                <td class="cart_price">
                                    <p>{{ $val['item']->price . ' ' . $val['item']->currency   }}</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up"
                                           href="{{ url(url('/cart/plusItem/'.$val['item']->id)) }}"> + </a>
                                        <input class="cart_quantity_input" type="text" name="quantity"
                                               value="{{ $val['quantity'] }}" autocomplete="off" size="2">
                                        <a class="cart_quantity_down"
                                           href="{{ url(url('/cart/minusItem/'.$val['item']->id)) }}"> - </a>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">{{ $val['price'] . ' ' . $val['item']->currency }}</p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete"
                                       href="{{ url('/cart/delete/'.$val['item']->id) }}"><i
                                                class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="alert alert-danger pull-right" role="alert">
                        <h3>Total Price: {{ $totalPrice . ' ' . $val['item']->currency }}</h3>
                    </div>
                @else
                    <div class="alert alert-warning"><h2> You not add product to cart</h2></div>
                @endif
            </div>
        </div>
    </section> <!--/#cart_items-->


    <section id="do_action">
        <div class="container">
            <div class="heading">
                <div class="alert">
                    <h1 class="text-success">Оформить заказ</h1>
                </div>
                <p>Внимание!<br>
                    Заказывая доставку товара сторонними курьерскими службами (Нова пошта, Мист Экспресс )
                    - при получении обязательно проверяйте наличие всего товара в заказе, а так же его внешний вид.
                </p>
            </div>
            <div class="row">

                @include('layouts.errors')

                @include('layouts.session')


                <form action="{{ url('/cart/saveOrder') }}" method="post" class="col-sm-12">
                    @csrf
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="example">Name:</label>
                            <input type="text" class="form-control" name="name" id="example" value="{{ old('name') }}"
                                   placeholder="Your name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address:</label>
                            <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                                   aria-describedby="emailHelp" placeholder="Enter email" value="{{ old('email') }}">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                anyone else.
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="example2">PhoneNumber:</label>
                            <input type="tel" class="form-control" name="phone" id="example2" value="{{ old('phone') }}"
                                   placeholder="PhoneNumber">
                        </div>
                        <div class="form-group">
                            <label for="example3">City:</label>
                            <input type="text" class="form-control" name="city" value="{{ old('city') }}" id="example3"
                                   placeholder="City">
                        </div>
                        <div class="form-group">
                            <label for="example4">Delivery Method:</label>
                            <select title="Delivery Method" name="deliveryMethod">
                                <option>Самовывоз товара из выставочных залов по адресам:
                                    Киев, ул. Ярославская, 57
                                </option>
                                <option>
                                    Доставка курьером по адресу: (оговаривается с менеджером ).
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="total_area">
                            <ul>
                                <li>Количество слотов
                                    <span class="text-success"> 
                                        @if(isset($totalQty))
                                            {{ $totalQty }}
                                        @endif
                                    </span>
                                </li>
                                <hr>
                                <li>Общая сума:
                                    <span class="text-danger"> 
                                        @if(isset($totalPrice) && $val)
                                            {{ $totalPrice . ' ' . $val['item']->currency }}
                                        @endif
                                    </span>
                                </li>
                                <hr>
                                <li>К оплате:
                                    <span class="text-danger">
                                         @if(isset($totalPrice) && $val)
                                            {{ $totalPrice . ' ' . $val['item']->currency }}
                                        @endif
                                    </span>
                                </li>
                            </ul>
                            <div class="alert alert-secondary">
                                <button type="submit" class="btn-lg btn-success center-block"> To order</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section><!--/#do_action-->
@endsection