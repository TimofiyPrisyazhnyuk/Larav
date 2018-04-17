@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class=" col-md-3 alert alert-success">
                <h1>Cart</h1>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                @include('layouts.errors')

                @include('layouts.session')

                @if(isset($cartColumnName) && $cartOrders != null)
                    <table class="table col-md-12">
                        <thead class="thead-dark">
                        <tr>
                            @foreach($cartColumnName as $name => $item)
                                <th>
                                    <small class="text-success">{{ $item }}</small>
                                </th>
                            @endforeach

                            <th>
                                <small class="text-info">OrderProduct</small>
                            </th>
                            <th>
                                <small class="text-danger">Options</small>
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($cartOrders as $order)
                            <tr>
                                @foreach($order as $item)
                                    <td width="200px">
                                        <small class="text-secondary" style="word-wrap: break-word;">
                                            {{ $item }}
                                        </small>
                                    </td>
                                @endforeach
                                <td>
                                    @foreach($orderProduct as $productCart)
                                        @if($order['id'] == $productCart->cart_id)
                                            <small class="text-secondary">
                                                <b>IdProduct: </b>{{ ($productCart['product_id']) }}</small><br>
                                            <small class="text-secondary"><b>Price: </b>{{ ($productCart['price']) }}
                                            </small><br>
                                            <small class="text-secondary">
                                                <b>Quantity: </b>{{ ($productCart['quantity']) }}</small><br>
                                            <br>
                                        @endif
                                    @endforeach
                                </td>
                                <td width="50px">
                                    <button class="btn-danger btn-sm" data-toggle="modal"
                                            data-target="#modal1{{ $order['id']}}">Del
                                    </button>
                                    <div class="modal fade" id="modal1{{ $order['id']}}" tabindex="-1"
                                         role="dialog"
                                         aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header text-center">
                                                    <h4 class="modal-title w-100 font-weight-bold">Delete
                                                        Order: {{ $order['id'] }}</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body mx-3">
                                                    <form method='post'
                                                          action={{ url('/home/cart/delete/'. $order['id']) }}>
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Delete:</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-danger">
                        <h2 class="text-warning">Not OrderCart !</h2>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection