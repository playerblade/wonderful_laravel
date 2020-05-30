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
            <div class="row">
                <div class="col-12">
                    <form action="{{route('orders.store')}}" method="POST">
                        @csrf
                        @foreach($articles as $article)
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <input hidden  type="number" name="user_id" value="{{ Auth::user()->id }}">
                                        <input hidden  type="number" name="article_id" value="{{ $article->id }}">
                                        <h3  class="d-inline-block d-sm-none"><input type="text" name="title" value="{{$article->articulo}}"></h3>
                                        <div  class="col-12">
                                            <img src="{{asset('/imagenes/imagenes_articulos/'.$article->image)}}" class="product-image" alt="Product Image">
                                        </div>
                                        <div class="col-12 product-image-thumbs">
{{--                                            <div class="product-image-thumb active"><img src="../../dist/img/prod-1.jpg" alt="Product Image"></div>--}}
{{--                                            <div class="product-image-thumb" ><img src="../../dist/img/prod-2.jpg" alt="Product Image"></div>--}}
{{--                                            <div class="product-image-thumb" ><img src="../../dist/img/prod-3.jpg" alt="Product Image"></div>--}}
{{--                                            <div class="product-image-thumb" ><img src="../../dist/img/prod-4.jpg" alt="Product Image"></div>--}}
{{--                                            <div class="product-image-thumb" ><img src="../../dist/img/prod-5.jpg" alt="Product Image"></div>--}}
                                            <a href="#" class="btn btn-block bg-gradient-primary btn-sm mt-2">Ver Mas Imagenes</a>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <h3 class="my-3">{{$article->articulo}}</h3>
                                        <h5><b>Fabricante: </b>{{$article->fabricante}}.</h5>
                                        @foreach ($stocks as $stock)
                                            <h5><b>Stock: </b>{{$stock->stock}}.</h5>
                                            <input hidden type="number" name="stocks" value="{{$stock->stock}}">
                                        @endforeach
                                        <p><b>Description: </b>{{$article->description}}.</p>
                                        <h4>Available Colors</h4>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            @foreach($colors as $color)
                                                <label class="btn btn-default text-center active">
                                                    <input type="radio" name="color_option" id="color_option1" autocomplete="off" checked="">
                                                    {{$color->name}}
                                                    <br>
                                                    <img class="img-circle fa-2x" style="width: 35px; height: 35px;" src="{{asset('/imagenes/imagenes_articulos/'.$color->image)}}" alt="">
                                                    <br> Cant.: {{$color->quantity}}
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
                                                            <option value="{{$color->image}}">
                                                                {{ $color->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div id="cant"></div>
                                            </div>
                                            <div id="cantidad" class="col-6">
                                                <h4>Cantidad</h4>
                                                <input type="number" name="quantity" class="form-control" required>
                                            </div>
                                            <div  class="col-6">
                                                {{--                                            space--}}
                                            </div>
                                        </div>
                                        {{--                                </form>--}}
                                        <div class="bg-gray py-2 px-3 mt-4">
                                            @foreach($prices as $price )
                                                @if($price->is_current == 1)
                                                    <h2 class="mb-0">
                                                        ${{$price->price}}
                                                    </h2>
                                                    <input hidden type="number" name="price_article_id" value="{{$price->id}}">
                                                    <input hidden type="number" name="price" value="{{$price->price}}">
                                                @endif
                                                @if($price->is_current == 0)
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
            <!-- /.row -->
            <div class="row">
                <div class="card-body">
                    <nav class="w-100">
                        <div class="nav nav-tabs" id="product-tab" role="tablist">
                            <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false"><h3>Raiting & Comentary</h3></a>
                        </div>
                    </nav>
                    <div class="tab-content p-3" id="nav-tabContent">
                        <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab">
                            <style>
                                labelstyle[type="radio"] {
                                    display: none;
                                }

                                .labelstyle {
                                    font-size: 35px;
                                    color: grey;
                                }

                                .clasificacion {
                                    direction: rtl;
                                    unicode-bidi: bidi-override;
                                }

                                labelstyle:hover,
                                labelstyle:hover ~ label {
                                    color: orange;
                                }

                                #inputstyle[type="radio"]:checked ~ label {
                                    color: orange;
                                }
                            </style>
                            @if($orders_validation)
                                <div class="post">
                                    <form action="{{ route('comentaries.store') }}" method="POST">
                                        @csrf
                                        <div id="raiting" class="small">
                                            <input hidden type="number" name="user_id" value="{{Auth::user()->id}}">
                                            {{--                                    <strong>Raiting</strong>--}}
                                            <p class="clasificacion">
                                                <input class="inputstyle" id="radio1" type="radio" name="estrellas" value="5">
                                                <label class="labelstyle" for="radio1">★</label>
                                                <input class="inputstyle" id="radio2" type="radio" name="estrellas" value="4">
                                                <label class="labelstyle" for="radio2">★</label>
                                                <input class="inputstyle" id="radio3" type="radio" name="estrellas" value="3">
                                                <label class="labelstyle" for="radio3">★</label>
                                                <input class="inputstyle" id="radio4" type="radio" name="estrellas" value="2">
                                                <label class="labelstyle" for="radio4">★</label>
                                                <input class="inputstyle" id="radio5" type="radio" name="estrellas" value="1">
                                                <label class="labelstyle" for="radio5">★</label>
                                            </p>
                                        </div>
                                        <div id="comentary" class="small">
                                            <p>
                                                <input hidden type="number" name="article_id" value="{{$articles[0]->id}}">
                                                {{--                                            <input hidden type="number" name="is_main" value="1">--}}
                                                {{--                                        <strong>Comentario</strong>--}}
                                                <textarea name="comment" id="" cols="3" rows="4" class="form-control" placeholder="Cuenta lo que te parecio el producto. ¿Qué recomiendas? ¿Por qué?"></textarea>
                                            </p>
                                            <div class="text-right">
                                                <button  class="btn btn-primary">Evaluar Producto</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="post">
                                    @foreach($commentaries as $commentary)
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="{{asset("/admin-lte/dist/img/user1-128x128.jpg")}}" alt="user image">
                                            <span class="username"> <a href="#">{{$commentary->full_name}}</a></span>
                                            <span class="description">Shared publicly - 7:45 PM today</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>
                                            {{$commentary->comment}}
                                            {{--                                        <button class="btn btn-default btn-sm"><i class="fa fa-edit"></i> </button>--}}
                                        </p>

                                        <p>
                                            <a href="{{ route('comentaries.edit',$commentary->id) }}" class="link-black text-sm" data-toggle="modal" data-target="#modal-commentary-edit{{$commentary->id}}"><i class="fas fa-edit mr-1"></i> Editar reseña</a>
                                        </p>

                                        {{--                            MODAL FOR EDIT FORM--}}
                                        <div class="modal fade" id="modal-commentary-edit{{$commentary->id}}">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content card-primary card-outline">
                                                    <form action="{{route('comentaries.update',$commentary->id)}}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body small">
                                                            <input hidden type="number" name="user_id" value="{{Auth::user()->id}}">
                                                            <!-- <strong>Raiting</strong>
                                                            <p class="clasificacion">
                                                                <input id="radio1" type="radio" name="estrellas" value="5">
                                                                <label class="labelTamanio" for="radio1">★</label>
                                                                <input id="radio2" type="radio" name="estrellas" value="4">
                                                                <label class="labelTamanio" for="radio2">★</label>
                                                                <input id="radio3" type="radio" name="estrellas" value="3">
                                                                <label class="labelTamanio" for="radio3">★</label>
                                                                <input id="radio4" type="radio" name="estrellas" value="2">
                                                                <label class="labelTamanio" for="radio4">★</label>
                                                                <input id="radio5" type="radio" name="estrellas" value="1">
                                                                <label class="labelTamanio" for="radio5">★</label>
                                                            </p> -->
                                                            <p>
                                                                <input hidden type="number" name="article_id" value="{{$articles[0]->id}}">
                                                                <strong>Comentario</strong>
                                                                <textarea name="comment" id="" cols="10" rows="5" class="form-control" placeholder="Cuenta lo que te parecio el producto. ¿Qué recomiendas? ¿Por qué?">{{$commentary->comment}}</textarea>
                                                            </p>

                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button  class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button  class="btn btn-primary">Evaluar Producto</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->

                                    @endforeach
                                </div>
                            @else
                                <h5 class="text-center" ><b>No puede evaluar este articulo porque aun no se le entrego!!!</b></h5>
                                <div class="post">
                                    @foreach($commentaries as $commentary)
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="{{asset("/admin-lte/dist/img/user1-128x128.jpg")}}" alt="user image">
                                            <span class="username"> <a href="#">{{$commentary->full_name}}</a></span>
                                            <span class="description">Shared publicly - 7:45 PM today</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>
                                            {{$commentary->comment}}
                                        </p>

                                        <p>
                                            <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v2</a>
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
    <br>
    <!-- /.card -->
@endsection
@section('script_cities')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#cities').on('change',function () {
                var city_id = $('#cities').val();
                if ($.trim(city_id) != ''){
                    $.get('/get_transport_fares',{city_id: city_id}, function (transport_fares) {
                        $('#transport_fare').empty();
                        // $('#transport_fare').append("<option value=''>Selecione una sub categoria</option>");
                        $.each(transport_fares, function (index , value){
                            $('#transport_fare').append("<option selected='selected' value='"+index+"'>"+value+"</option>");
                        }).done();
                    });
                }
            });
        });
    </script>
@endsection
@section('script_color_form')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#color').on('change',function () {
                var color = $('#color').val();
                if ($.trim(color.length) > 1){
                    $('#cantidad').hide();
                    console.log($.trim(color.length));
                }
            });
        });
    </script>
@endsection
@section('alert_validations')
    <script type="text/javascript">
        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000
            });
            // if exist some errors
            var msg = '{{Session::get('alert')}}';
            var exist = '{{Session::has('alert')}}';
            if (exist){
                Toast.fire({
                    type: 'error',
                    title: msg
                })
            }
        });
    </script>
@endsection
@section('script_raiting')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#comentary').hide();
            $('#raiting').on('change',function () {
                $('#comentary').show();
            });
        });
    </script>
@endsection
