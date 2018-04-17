@extends('shop.layouts.shop')

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