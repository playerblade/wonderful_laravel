@extends('layouts.checker.app')
@section('content')
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> Welcome To Wonderful <small>Version 1.0</small></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Layout</a></li>
                        <li class="breadcrumb-item active">Top Navigation</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h4></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 d-xl-flex justify-content-lg-center">
                                    <div class="card bg-light">
                                        <a href="/orders_dispatched">
                                            <img src="{{asset('/imagenes/imagenes_estados/despachado.jpg')}}" alt="">
                                        </a>
                                        <b>Estado Despachado</b>
                                    </div>
                                </div>
                                {{--                        ./ card--}}
                                <div class="col-6 d-xl-flex justify-content-lg-center">
                                    <div class="card bg-light">
                                        <a href="/orders_delivered">
                                            <img src="{{asset('/imagenes/imagenes_estados/entregado.jpg')}}" alt="">
                                        </a>
                                        <b>Estado Entregado</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
