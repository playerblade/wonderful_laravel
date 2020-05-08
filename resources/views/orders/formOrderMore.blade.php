@extends('layouts.client.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> Welcome To Wonderful <small>Version 1.0</small></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Cliente</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Default box -->
    <div class="container">
        <div class="card card-primary card-outline">
            <form action="{{route('storeMoreArticles')}}" method="POST">
                @csrf
                @foreach($articles as $article)
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <input hidden  type="number" name="user_id" value="{{ Auth::user()->id }}">
                                <input hidden  type="number" name="article_id" value="{{ $article->id }}">
                                {{--                                <h3  class="d-inline-block d-sm-none">{{$article->articulo}}</h3>--}}
                                <h3  class="d-inline-block d-sm-none"><input type="text" name="title" value="{{$article->articulo}}"></h3>
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
                                    @foreach($colors as $color)
                                        <label class="btn btn-default text-center active">
                                            <input type="radio" name="color_option" id="color_option1" autocomplete="off" checked="">
                                            {{$color->name}}
                                            <br>
                                            {{--                                            <i class="fas fa-circle fa-2x text-green"></i>--}}
                                            <img class="img-circle fa-2x" style="width: 35px; height: 35px;" src="{{asset('/imagenes/imagenes_articulos/'.$color->image)}}" alt="">
                                            <br> Cant.: {{$color->quantity}}
                                            <input hidden type="number" name="quantity_total" value="{{$color->quantity}}">
                                        </label>
                                    @endforeach
                                </div>
                                {{--                                <form action="">--}}
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <h4>Escoge un Color</h4>
                                        <div class="select2-purple">
                                            <select id="color" class="select2" name="color_article[]"   multiple="multiple" data-placeholder="Select a Color" data-dropdown-css-class="select2-purple" style="width: 100%;" required>
                                                @foreach ($colors as $color)
                                                    <option value="{{ $color->image }}">
                                                        {{ $color->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div id="cantidad" class="col-6">
                                        <h4>Cantidad</h4>
                                        <input type="number" name="quantity" class="form-control">
                                    </div>
                                    <div id="cantidad_article" class="col-6">

                                    </div>
                                </div>
                                {{--                                </form>--}}
                                <div class="bg-gray py-2 px-3 mt-4">
                                    @foreach($prices as $price )
                                        @if($price->current == 1)
                                            <h2 class="mb-0">
                                                ${{$price->price}}
                                            </h2>
                                            <input hidden type="number" name="price_article_id" value="{{$price->id}}">
                                            <input hidden type="number" name="price" value="{{$price->price}}">
                                        @endif
                                        @if($price->current == 0)
                                            <h4 class="mt-0">
                                                <small>Ex Tax: <strike>${{$price->price}}</strike> </small>
                                            </h4>
                                        @endif
                                    @endforeach
                                </div>

                                <div class="mt-4">
                                    <div class="btn btn-primary btn-lg btn-flat">
                                        <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                        <button class="btn btn-primary">Add to Cart</button>
                                        <input hidden type="number" name="order_id" value="{{$orders[0]->order_id}}">
                                    </div>
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
@section('script_color_form')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#color').on('change',function () {
                var color = $('#color').val();
                if ($.trim(color.length) > 1){
                    $('#cantidad').hide();
                    console.log($.trim(color.length));
                    // $('#cantidad_article').append("<h4>Total De Articulos</h4>\n" +
                    //     "                  <input type='number' value='"+$.trim(color.length)+"' class='form-control'>\n" +
                    //     "                  ");
                    //
                }
            });
        });
    </script>
@endsection
