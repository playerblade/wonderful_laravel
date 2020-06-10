@extends('layouts.client.app')
@section('content')

    <style>
        #form {
  width: 250px;
  margin: 0 auto;
  height: 50px;
}

#form p {
  text-align: center;
}

#form label {
  font-size: 20px;
}

input[type="radio"] {
  display: none;
}

label {
  color: grey;
  font-size: 50px;
}

.clasificacion {
  direction: rtl;
  unicode-bidi: bidi-override;
}

label:hover,
label:hover ~ label {
  color: orange;
}

input[type="radio"]:checked ~ label {
  color: orange;
}
    </style>
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
                                            <a href="#" class="btn btn-block bg-gradient-primary btn-sm mt-2">Ver Mas Imagenes</a>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="row  ">
                                            <div class="col-sm-6"><h3 class="my-3">{{$article->articulo}}</h3></div>
                                            <div class="col-sm-6">
                                            <div class="float-right">
                                            <button type="button" class="btn bg-yellow elevation-3 btn-ml my-3" data-toggle="modal" data-target="#modal-xl">
                                                    ★  ★  ★  ★  ★
                                            </button>
                                            @if(empty($porcentajes[0]->montoTotal))
                                                <strong>0 calificaciones</strong>
                                            @else
                                                <strong>{{$porcentajes[0]->montoTotal }} calificaciones</strong>
                                            @endif
                                            </div>
                                            </div>
                                        </div>

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
                                                <input type="number" name="quantity" class="form-control" min="1" required>
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
                            @if($orders_validation)
                                <div class="post">
                                    <form action="{{ route('commentaries.store') }}" method="POST">
                                        @csrf
                                        <div id="raiting" class="small">
                                            <input hidden type="number" name="user_id" value="{{Auth::user()->id}}">
                                            <p class="clasificacion">
                                                <input id="radio1" type="radio" name="star" value="5"><!--
                                                --><label for="radio1">★</label><!--
                                                --><input id="radio2" type="radio" name="star" value="4"><!--
                                                --><label for="radio2">★</label><!--
                                                --><input id="radio3" type="radio" name="star" value="3"><!--
                                                --><label for="radio3">★</label><!--
                                                --><input id="radio4" type="radio" name="star" value="2"><!--
                                                --><label for="radio4">★</label><!--
                                                --><input id="radio5" type="radio" name="star" value="1"><!--
                                                --><label for="radio5">★</label>
                                            </p>
                                        </div>
                                        <div id="comentary" class="small">
                                            <p>
                                                <input hidden type="number" name="article_id" value="{{$articles[0]->id}}">
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
                                            <span class="description">Shared publicly - {{$commentary->created_at}} </span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>
                                            {{$commentary->comment}}
                                        </p>

                                        <p>
                                            <a href="{{ route('commentaries.edit',$commentary->id) }}" class="link-black text-sm" data-toggle="modal" data-target="#modal-commentary-edit{{$commentary->id}}"><i class="fas fa-edit mr-1"></i> Editar reseña</a>
                                        </p>

                                        {{--                            MODAL FOR EDIT FORM--}}
                                        <div class="modal fade" id="modal-commentary-edit{{$commentary->id}}">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content card-primary card-outline">
                                                    <form action="{{route('commentaries.update',$commentary->id)}}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body small">
                                                            
                                                            <p>
                                                                <input hidden type="number" name="user_id" value="{{Auth::user()->id}}">
                                                                <input hidden type="number" name="article_id" value="{{$articles[0]->id}}">
                                                                <strong>Comentario</strong>
                                                                <textarea name="comment" id="" cols="10" rows="5" class="form-control" placeholder="Cuenta lo que te parecio el producto. ¿Qué recomiendas? ¿Por qué?">{{$commentary->comment}}</textarea>
                                                            </p>

                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button  class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button  class="btn btn-primary">Guardar Cambios</button>
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
<!-- inicio del modal del porcentaje de los raitings-------------------------------------------------------------- -->
<div class="modal fade" id="modal-xl">
                        <div class="modal-dialog modal-ml">
                            <div class="modal-content">
                                <div class="modal-header">
                                
                                    <img class="elevation-0" src="{{asset('/stars/01Estrella.png')}}" style="width: 300px;height: 70px;"> 
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-header">
                                    @if(empty($porcentajes[0]->montoTotal))
                                        <strong>0 calificaciones de clientes</strong>
                                    @else
                                        <strong>{{$porcentajes[0]->montoTotal }} calificaciones de clientes</strong>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-striped elevation-2">

                                    <tbody>
                                    @foreach($raitings as $raiting)
                                        <tr>
                                            <td>{{$raiting->nameRaiting}}</td>
                                            <td >
                                                <div class="progress" style="width: 200px;">
                                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="100"
                                                        aria-valuemin="0" aria-valuemax="100" style="width: {{$raiting->cantidadCliente}}%">
                                                        <!-- <span class="sr-only">60% completado</span> -->
                                                        {{$raiting->cantidadCliente}}
                                                    </div>

                                                </div>
                                            </td>
                                            <td>{{round( $raiting->cantidadCliente * 100 / $porcentajes[0]->montoTotal,0) }} %</td>
                                            <td>
                                                <button type="submit" class="btn">
                                                    <a class="btn btn-info btn-sm elevation-1" href="/comentario/article/{{$raiting->article_id}}/{{$raiting->estrella}}/detail">
                                                        <i class="fas fa-eye"></i>
                                                        <!-- <i class="fas fa-play"></i>  -->
                                                    </a>
                                                </button>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                                </div>

                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
    <!-- fin del modal-------------------------------------------------------------- -->
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

<!-- ------------------------------Del Modal del Porcentaje del raiting--------------------------------------------------- -->
@section('scriptReadMore')
    <script>
        $(document).ready(function () {
            $('.nav-toggle').click(function () {
                var collapse_content_selector = $(this).attr('href');
                var toggle_switch = $(this);
                $(collapse_content_selector).toggle(function () {
                    if ($(this).css('display') == 'none') {
                        toggle_switch.html('Read More');
                    } else {
                        toggle_switch.html('Read Less');
                    }
                });
            });

        });
    </script>
@endsection
<!-- ----------------------------------------------------------------------------------------- -->
