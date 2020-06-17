@extends('layouts.admin.app')
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
                        <div class="col-12 col-sm-5">
                    @foreach($images_articles as $images_article)
                            @if($images_article->estadoImagenes == 'principal')
                                <div class="col-12">
                                    <img class="product-image" src="{{asset('/imagenes/imagenes_articulos/'.$images_article->imagen)}}" style="width: 380px; height: 340px;">
                                </div>
                            @else
                                <div class="col-12">
                                    <b>IMAGEN:</b>&ensp; <p>No exite imagenes principal registrado...</p>
                                </div>
                            @endif
                            @if($images_article->estadoImagenes == 'secundario')
                                <div class="col-12 product-image-thumbs">
                                    <div class="product-image-thumb" ><img src="{{asset('/imagenes/imagenes_articulos/'.$images_article->imagen)}}" style="width: 50px ; height:40px ;"></div>
                                </div>
                            @else
                                <div class="col-12 product-image-thumbs">
                                    <b>IMAGEN:</b>&ensp; <p>No hay imagenes secundarias disponibles...</p>
                                </div>
                            @endif
                    @endforeach
                        </div>
                        <div class="col-12 col-sm-7">
                            <h3 class="my-3">{{$articles[0]->articulo}}</h3>
                            <p><b>Descripcion:</b>&ensp;{{$articles[0]->descripcion}}</p>
                            <p><b>Fabricante:</b>&ensp;{{$articles[0]->fabricante}}</p>
                            <p><b>Stock:</b>&ensp;{{$articles[0]->stock}}</p>

                            <hr>
                            <h4>Available Colors</h4>
                            @foreach($articles as $article)
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <a class="btn btn-default text-center active" href="#">
                                        <label for="color">{{$article->nombreColor}}</label>
                                        <br>
    {{--                                    {{$article->color}}--}}
                                        <img class="img-circle fa-2x" style="width: 50px; height: 50px;" src="{{asset('/imagenes/imagenes_articulos/'.$article->color)}}" alt="">
                                    </a>
                                </div>
                            @endforeach
                                <div class="bg-gray py-2 px-3 mt-4">
                                    <h4><small>Precio:</small></h4>
                                    @foreach($prices_articles as $prices_article)
{{--                                            <div class="col-12">--}}
                                            @if($prices_article->estadoPrecios == 'actual')
                                                <h2>
                                                    <small>${{$prices_article->precio}}</small>
                                                </h2>
                                            @else
                                                <h5>
                                                    <small>No exite precio principal registrado...</small>
                                                </h5>
                                            @endif
                                            @if($prices_article->estadoPrecios == 'anterior')
                                                 <s><small>${{$prices_article->precio}}</small></s> &ensp;
                                            @else
                                                <s><small>No exiten precios anteriores...</small></s>
                                            @endif
                                    @endforeach
                                </div>
                            <div class="row mt-4">
                                <nav class="w-100">
                                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Raiting</a>
                                        <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Comments</a>
                                    </div>
                                </nav>
                                <div class="tab-content p-3" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in  </div>
                                    <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem</div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
