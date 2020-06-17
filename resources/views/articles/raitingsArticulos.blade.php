@extends('layouts.admin.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Raitings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="/reportes/raitings/raiting_comentarios_articulos">Articulos</a></li>
                        <li class="breadcrumb-item active">Raitings</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                    <div class="card-header">
                        @if(empty($raitings[0]->article))
                            <strong>Datos vacios</strong>
                        @else
                            <h3 class="card-title"><b>Articulo: &ensp; </b>{{$raitings[0]->article}}</h3>
                        @endif
                    </div>
                    <!-- /.card-header -->
                        <div class="card-body">
                            {{--                            table-striped projects  otro estilo=> table-bordered--}}
                            <table id="example1" class="table table-striped elevation-2">
                                <thead>
                                <tr>
                                    <th>Raiting </th>
                                    <th>Cantidad clientes</th>
                                    <th>Porcentaje</th>
                                    <th>Ver Comentario</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($raitings as $raiting)
                                    <tr>
                                        @if($raiting->estrella == 5)
                                            {{--                                        <td><img src="{{asset('/stars/5stars.jpg')}}" style="width: 110px;height: 19px;"></td>--}}
                                            <td>
                                                <a href="/reportes/raiting/{{$raiting->article}}/{{$raiting->raiting}}/comentarios">
                                                    <img src="{{asset('/stars/5stars.jpg')}}" style="width: 110px;height: 19px;">
                                                </a>
                                            </td>
                                        @endif
                                        @if($raiting->estrella == 4)
                                            <td>
                                                <a href="/reportes/raiting/{{$raiting->article}}/{{$raiting->raiting}}/comentarios">
                                                    <img src="{{asset('/stars/4stars.jpg')}}" style="width: 110px;height: 19px;">
                                                </a>
                                            </td>
                                        @endif
                                        @if($raiting->estrella == 3)
                                            <td>
                                                <a href="/reportes/raiting/{{$raiting->article}}/{{$raiting->raiting}}/comentarios">
                                                    <img src="{{asset('/stars/3stars.jpg')}}" style="width: 110px;height: 19px;">
                                                </a>
                                            </td>
                                        @endif
                                        @if($raiting->estrella == 2)
                                            <td>
                                                <a href="/reportes/raiting/{{$raiting->article}}/{{$raiting->raiting}}/comentarios">
                                                    <img src="{{asset('/stars/2stars.jpg')}}" style="width: 110px;height: 19px;">
                                                </a>
                                            </td>
                                        @endif
                                        @if($raiting->estrella == 1)
                                            <td>
                                                <a href="/reportes/raiting/{{$raiting->article}}/{{$raiting->raiting}}/comentarios">
                                                    <img src="{{asset('/stars/1stars.jpg')}}" style="width: 110px;height: 19px;">
                                                </a>
                                            </td>
                                        @endif
                                        <td>{{$raiting->cantidadCliente}}</td>
                                        <td>{{round( $raiting->cantidadCliente * 100 / $porcentajes[0]->montoTotal,0) }} %</td>
                                        <td>
                                            <button type="submit" class="btn">
                                                <a class="btn btn-info btn-sm elevation-1" href="/reportes/articulo/raiting/{{$raiting->article_id}}/{{$raiting->estrella}}/comentarios">
                                                    <i class="fas fa-eye"></i> ver
                                                </a>
                                            </button>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Raiting </th>
                                    <th>Cantidad clientes</th>
                                    <th>Porcentaje</th>
                                    <th>Ver Comentario</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
