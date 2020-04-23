@extends('welcome.app')
@section('content')
    <!-- Default box -->
    <div class="container">
        <div class="card card-primary card-outline">
            <form action="{{route('orders.store')}}" method="POST">
                @csrf
                @foreach($articles as $article)
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <h3 name="hola" class="d-inline-block d-sm-none">{{$article->articulo}}</h3>
                                <div  class="col-12">
                                    <img src="{{asset('/imagenes/imagenes_articulos/'.$article->image)}}" class="product-image" alt="Product Image">
                                </div>
                                <div class="col-12 product-image-thumbs">
                                    <div class="product-image-thumb active"><img src="../../dist/img/prod-1.jpg" alt="Product Image"></div>
                                    <div class="product-image-thumb" ><img src="../../dist/img/prod-2.jpg" alt="Product Image"></div>
                                    <div class="product-image-thumb" ><img src="../../dist/img/prod-3.jpg" alt="Product Image"></div>
                                    <div class="product-image-thumb" ><img src="../../dist/img/prod-4.jpg" alt="Product Image"></div>
                                    <div class="product-image-thumb" ><img src="../../dist/img/prod-5.jpg" alt="Product Image"></div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <h3 class="my-3">{{$article->articulo}}</h3>
                                <p><b>Description: </b>{{$article->description}}.</p>

                                <hr>
                                <h4>Available Colors</h4>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-default text-center active">
                                        <input type="radio" name="color_option" id="color_option1" autocomplete="off" checked="">
                                        Green
                                        <br>
                                        <i class="fas fa-circle fa-2x text-green"></i>
                                    </label>
                                    <label class="btn btn-default text-center">
                                        <input type="radio" name="color_option" id="color_option2" autocomplete="off">
                                        Blue
                                        <br>
                                        <i class="fas fa-circle fa-2x text-blue"></i>
                                    </label>
                                    <label class="btn btn-default text-center">
                                        <input type="radio" name="color_option" id="color_option3" autocomplete="off">
                                        Purple
                                        <br>
                                        <i class="fas fa-circle fa-2x text-purple"></i>
                                    </label>
                                    <label class="btn btn-default text-center">
                                        <input type="radio" name="color_option" id="color_option4" autocomplete="off">
                                        Red
                                        <br>
                                        <i class="fas fa-circle fa-2x text-red"></i>
                                    </label>
                                    <label class="btn btn-default text-center">
                                        <input type="radio" name="color_option" id="color_option5" autocomplete="off">
                                        Orange
                                        <br>
                                        <i class="fas fa-circle fa-2x text-orange"></i>
                                    </label>
                                </div>

                                {{--                        <h4 class="mt-3">Size <small>Please select one</small></h4>--}}
                                {{--                        <div class="btn-group btn-group-toggle" data-toggle="buttons">--}}
                                {{--                            <label class="btn btn-default text-center">--}}
                                {{--                                <input type="radio" name="color_option" id="color_option1" autocomplete="off">--}}
                                {{--                                <span class="text-xl">S</span>--}}
                                {{--                                <br>--}}
                                {{--                                Small--}}
                                {{--                            </label>--}}
                                {{--                            <label class="btn btn-default text-center">--}}
                                {{--                                <input type="radio" name="color_option" id="color_option1" autocomplete="off">--}}
                                {{--                                <span class="text-xl">M</span>--}}
                                {{--                                <br>--}}
                                {{--                                Medium--}}
                                {{--                            </label>--}}
                                {{--                            <label class="btn btn-default text-center">--}}
                                {{--                                <input type="radio" name="color_option" id="color_option1" autocomplete="off">--}}
                                {{--                                <span class="text-xl">L</span>--}}
                                {{--                                <br>--}}
                                {{--                                Large--}}
                                {{--                            </label>--}}
                                {{--                            <label class="btn btn-default text-center">--}}
                                {{--                                <input type="radio" name="color_option" id="color_option1" autocomplete="off">--}}
                                {{--                                <span class="text-xl">XL</span>--}}
                                {{--                                <br>--}}
                                {{--                                Xtra-Large--}}
                                {{--                            </label>--}}
                                {{--                        </div>--}}

                                <div class="bg-gray py-2 px-3 mt-4">
                                    <h2 class="mb-0">
                                        $80.00
                                    </h2>
                                    <h4 class="mt-0">
                                        <small>Ex Tax: $80.00 </small>
                                    </h4>
                                </div>

                                <div class="mt-4">
                                    <div class="btn btn-primary btn-lg btn-flat">
                                        <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                        <button class="btn btn-primary">Add to Cart</button>
                                    </div>
                                    <div class="btn btn-default btn-lg btn-flat">
                                        <i class="fas fa-heart fa-lg mr-2"></i>
                                        Add to Wishlist
                                    </div>
                                </div>

                                <div class="mt-4 product-share">
                                    <a href="#" class="text-gray">
                                        <i class="fab fa-facebook-square fa-2x"></i>
                                    </a>
                                    <a href="#" class="text-gray">
                                        <i class="fab fa-twitter-square fa-2x"></i>
                                    </a>
                                    <a href="#" class="text-gray">
                                        <i class="fas fa-envelope-square fa-2x"></i>
                                    </a>
                                    <a href="#" class="text-gray">
                                        <i class="fas fa-rss-square fa-2x"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                @endforeach
            </form>
        </div>
    </div>
    <br>
    <!-- /.card -->
@endsection
