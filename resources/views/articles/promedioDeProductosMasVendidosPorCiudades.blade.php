@extends('layouts.menuAdmin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Ciudades</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                        <li class="breadcrumb-item active">Ciudades</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col-lg-3">
                    <div class="card card-primary card-outline">
                        <div class="card-header">Ciudades</div>
                        <ul class="list-group">
                            @foreach($cities as $city)
                                <li class="list-group-item">
                                    <a href="/reportes/ventas/{{$city->id}}/articulos_promedio_ventas_ciudades">{{$city->city}}</a>
                                </li>
                            @endforeach
                            <div class="card-link">{{$cities->links()}}</div>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="card card-primary card-outline">
                        @if($articles)
                            <div class="card-header"><h3 class="card-title">Promedio de ventas por ciudades</h3>
                                <label class="float-right">Ciudad : {{$articles[0]->ciudad}}</label>
                            </div>
                        @else
                            no hay datos
                        @endif
                        <div class="card-body">
                            <div style="width: 100%;">
                                {{$barchart->container()}}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection

@section('scriptsBarChart')
{{--    <script src="{{asset('js/chart/Chart.min.js')}}"></script>--}}
    {{$barchart->script()}}
@endsection
