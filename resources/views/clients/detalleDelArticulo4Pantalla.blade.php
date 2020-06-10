@extends('layouts.menuAdmin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Ordenes</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="/reportes/detalle_ordenes_por_cliente">Clientes</a></li>
                        <li class="breadcrumb-item active">Articulo</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
    <section class="content">
        <!-- Default box -->
        <div class="card card-solid card-primary card-outline elevation-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        @foreach($images_articles as $images_article)
                            @if($images_article->estadoImagenes == 'principal')
                                <div class="col-12">
{{--                                    style="width: 600px; height: 400px;"--}}
                                    <img class="rounded mx-auto d-block img-fluid" alt="Responsive image" src="{{asset('/imagenes/imagenes_articulos/'.$images_article->imagen)}}">
                                </div>
                            @endif
{{--                            @elseif($images_article->estadoImagenes == 'secundario')--}}
{{--                                <div class="col-12">--}}
{{--                                    <div class="product-image-thumb" >--}}
{{--                                        <img src="{{asset('/imagenes/imagenes_articulos/'.$images_article->imagen)}}" style="width: 50px ; height:40px ;">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @else--}}
{{--                                No Tiene Secundaria--}}
{{--                            @endif--}}
                        @endforeach
                        <div class="mt-2">
                            <button type="button" class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#modal-xl">
                                Ver mas imagenes..
                            </button>
                        </div>
                    </div>
                    <!-- /.modal -->
                    <div class="col-12 col-sm-6">
                        <h3 class="my-3">{{$articles[0]->articulo}}</h3>
{{--                        <p><b>Descripcion:</b>&ensp;{{$articles[0]->descripcion}}</p>--}}
                        <p><b>Fabricante:</b>&ensp;{{$articles[0]->fabricante}}</p>
                        <p><b>Stock:</b>&ensp;{{$articles[0]->stock}}</p>

                        <hr>
                        <h4>Colores:</h4>
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
                        <div class="bg-gray py-2 px-3 mt-4">
                        
                            <h4><small>Precio:</small></h4>
                            @foreach($prices_articles as $prices_article)
                                @if($prices_article->estadoPrecios == 'actual')
                                    <h2>
                                        <small>${{$prices_article->precio}}</small>
                                    </h2>
                                @endif
                                @if($prices_article->estadoPrecios == 'anterior')
{{--                                    <h4>--}}
                                        <s><span>${{$prices_article->precio}}</span></s>&ensp;&ensp;
{{--                                    </h4>&ensp;--}}
                                @endif
                            @endforeach
                        </div>
                        <br>
{{--                        <p><b>Descripcion:</b>&ensp;{{$articles[0]->descripcion}}</p>--}}
                        <div class="container">
                            <div class="row">
                                <p><b>Descripcion:</b>&ensp;{{\Illuminate\Support\Str::limit($articles[0]->descripcion,50,'')}}</p>
                                <div id="collapse" style="display:none">
                                    <p>{{\Illuminate\Support\Str::substr($articles[0]->descripcion,50,500)}}</p>
                                </div>
                                <a href="#collapse" class="nav-toggle">Read More</a>
                            </div>
                        </div>
                    </div>
{{--                    MODAL--}}
                    <div class="modal fade" id="modal-xl">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
{{--                                <div class="modal-header">--}}
{{--                                    <h4 class="modal-title">Extra Large Modal</h4>--}}
{{--                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                        <span aria-hidden="true">&times;</span>--}}
{{--                                    </button>--}}
{{--                                </div>--}}

                                <div class="modal-body">
                                    <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
{{--                                            @if($images_articles)--}}
{{--                                                <div class="carousel-item active" data-interval="2000">--}}
{{--                                                    <img class="rounded mx-auto d-block img-fluid"  src="{{asset('/imagenes/imagenes_articulos/'.$images_articles[1]->imagen)}}">--}}
{{--                                                </div>--}}
{{--                                                <div class="carousel-item">--}}
{{--                                                    <img class="rounded mx-auto d-block img-fluid" src="{{asset('/imagenes/imagenes_articulos/'.$images_articles[2]->imagen)}}">--}}
{{--                                                </div>--}}
{{--                                                <div class="carousel-item" data-interval="2000">--}}
{{--                                                    <img class="rounded mx-auto d-block img-fluid"  src="{{asset('/imagenes/imagenes_articulos/'.$images_articles[3]->imagen)}}">--}}
{{--                                                </div>--}}
{{--                                                <div class="carousel-item" data-interval="2000">--}}
{{--                                                    <img class="rounded mx-auto d-block img-fluid"  src="{{asset('/imagenes/imagenes_articulos/'.$images_articles[4]->imagen)}}">--}}
{{--                                                </div>--}}
{{--                                            @elseif(!$images_articles)--}}
{{--                                                <h2 class="text-center">No hay imagenes secundarios....</h2>--}}
{{--                                            @endif--}}
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default float-right" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->

                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
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
