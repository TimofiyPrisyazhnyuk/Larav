<div class="col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Последние товары</h2>
        @foreach($products as $product)
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <a href="{{ url('/product/'. $product->id) }}">

                                @if((File::exists("uploads/images/".$product->image)) && $product->image != null)
                                    <img src="{{ url('uploads/images/'. $product->image ) }}"
                                         style="width: 260px; height: 260px; ">
                                @else
                                    <img src="{{ url('uploads/images/default.png') }}"
                                         style="width: 260px; height: 260px">
                                @endif

                            </a>
                            {{--<img src="" alt="" />--}}
                            <h2>{{  $product->price . ' ' . $product->currency }}</h2>
                            <p>{{ $product->name }}</p>
                            <a href="{{url('/cart/add/'. $product->id) }}" class="btn btn-default add-to-cart"><i
                                        class="fa fa-shopping-cart"></i>В корзину</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div><!--features_items-->
    <div class="recommended_items"><!--recommended_items-->
        <h2 class="title text-center">Рекомендуемые товары</h2>
        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    @foreach($recommendProducts as $recommend)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <a href="{{ url('/product/'. $recommend['id']) }}">

                                            @if((File::exists("uploads/images/".$recommend['image'])) && $recommend['image'] != null)
                                                <img src="{{ url('uploads/images/' . $recommend['image']) }}"
                                                     style="width: 200px; height: 200px">
                                            @else
                                                <img src="{{ url('uploads/images/default.png') }}"
                                                     style="width: 200px; height: 200px">
                                            @endif

                                        </a>
                                        <h2>{{ $recommend['price'] . ' ' . $recommend['currency'] }}</h2>
                                        <p> {{ $recommend['name'] }}</p>
                                        <a href="{{ url('/cart/add/'. $recommend['id']) }}"
                                           class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>
                                            Вкорзину
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="item">
                    @foreach($recommendProducts as $recommend)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <a href="{{ url('/product/'. $recommend['id']) }}">

                                            @if((File::exists("uploads/images/".$recommend['image'])) && $recommend['image'] != null)
                                                <img src="{{ url('uploads/images/' . $recommend['image']) }}"
                                                     style="width: 200px; height: 200px">
                                            @else
                                                <img src="{{ url('uploads/images/default.png') }}"
                                                     style="width: 200px; height: 200px">
                                            @endif

                                            <h2>{{ $recommend['price'] . ' ' . $recommend['currency'] }}</h2>
                                            <p> {{ $recommend['name'] }}</p>
                                            <a href="{{ url('/cart/add/'. $recommend['id']) }}"
                                               class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>В
                                                корзину</a>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div><!--/recommended_items-->

</div>