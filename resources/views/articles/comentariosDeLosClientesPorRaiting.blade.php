@extends('layouts.admin.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <label class="float-left">Productos</label>
                    </div>
                    <ul class="list-group">
                        @foreach($articles as $article)
                            <li class="list-group-item">
                                <a href="/reportes/raitings/{{$article->id}}/raiting_comentarios_articulos">{{$article->title}}</a>
                            </li>
                        @endforeach
                        <div class="card-link">{{$articles->links()}}</div>
                    </ul>
                </div>

                <div class="card">
                    <div class="card-header">
                        <label class="float-left">Raitings</label>
                    </div>
                    <ul class="list-group">
                        @foreach($raitings as $raiting)
                            @if($raiting->raiting == 5)
                                <li class="list-group-item">
                                    <a href="/reportes/raiting/{{$raiting->articulo}}/{{$raiting->raiting}}/comentarios">
                                        <img src="{{asset('/stars/5stars.jpg')}}" style="width: 110px;height: 19px;">
                                    </a>
                                </li>
                            @endif
                            @if($raiting->raiting == 4)
                                <li class="list-group-item">
                                    <a href="/reportes/raiting/{{$raiting->articulo}}/{{$raiting->raiting}}/comentarios">
                                        <img src="{{asset('/stars/4stars.jpg')}}" style="width: 110px;height: 19px;">
                                    </a>
                                </li>
                            @endif
                            @if($raiting->raiting == 3)
                                <li class="list-group-item">
                                    <a href="/reportes/raiting/{{$raiting->articulo}}/{{$raiting->raiting}}/comentarios">
                                        <img src="{{asset('/stars/3stars.jpg')}}" style="width: 110px;height: 19px;">
                                    </a>
                                </li>
                            @endif
                            @if($raiting->raiting == 2)
                                <li class="list-group-item">
                                    <a href="/reportes/raiting/{{$raiting->articulo}}/{{$raiting->raiting}}/comentarios">
                                        <img src="{{asset('/stars/2stars.jpg')}}" style="width: 110px;height: 19px;">
                                    </a>
                                </li>
                            @endif
                            @if($raiting->raiting == 1)
                                <li class="list-group-item">
                                    <a href="/reportes/raiting/{{$raiting->articulo}}/{{$raiting->raiting}}/comentarios">
                                        <img src="{{asset('/stars/1stars.jpg')}}" style="width: 110px;height: 19px;">
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <label class="float-left">Producto : {{$comentarios[0]->articulo}}</label>
                    </div>
                    <div class="card-body">
                        <table class="table border table-responsive-sm">
                            <thead class="card-header">
                                <tr class="text-dark">
                                    <th>Cliente</th>
                                    <th>Comentario</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            @foreach($comentarios as $comentario)
                                <tbody>
                                    <tr>
                                        <td>{{$comentario->cliente}}</td>
                                        <td>{{$comentario->comentario}}</td>
                                        <td>{{$comentario->fecha}}</td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <label class="float-left">Porcentaje</label>
                    </div>
                    <div class="card-body">
                        <div style="width: 100%;">
                            {{$barchart->container()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scriptsBarChart')
    {{--    <script src="{{asset('js/chartjs-2.7.1/Chart.min.js')}}"></script>--}}
    {{$barchart->script()}}
@endsection
