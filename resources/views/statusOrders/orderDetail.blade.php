@extends('layouts.collaborator.app')
@section('content')
    <section class="content-header">
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
    </section>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h4></h4>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-striped elevation-2">
                                <thead>
                                <tr>
                                    <th class="text-center">&ensp;Order ID</th>
                                    <th>Cliente</th>
                                    <th>Articulo</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Sub Total</th>
                                    <th>Orden </th>
                                    <th>Cambiar Estado A:</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order_details as $order_detail)
                                    <tr>
                                        <th class="text-center">{{$order_detail->order_id}}</th>
                                        <td>{{$order_detail->cliente}}</td>
                                        <td>{{$order_detail->articulo}}</td>
                                        <td>{{$order_detail->precio}}</td>
                                        <td>{{$order_detail->cantidad}}</td>
                                        <td>{{$order_detail->subTotal}}</td>
                                        @if($order_detail->acitve == 1)
                                        <td><span class="right badge badge-success">En Curso</span></td>
                                        @else
                                        <td><span class="right badge badge-danger">Cancelado</span></td>
                                        @endif

                                        @if($order_detail->acitve == 1)
                                        <!-- <td><span class="right badge badge-success">En Curso</span></td> -->
                                        <td>
                                            <form action="{{route('status_orders.update',$order_detail->order_id)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                &ensp;&ensp;&ensp;&ensp;&ensp;
                                                <button class="btn btn-info">Proceso</button>
                                                <input hidden type="number" name="order_id" value="{{$order_detail->order_id}}">
                                                <input hidden type="number" name="user_id" value="{{Auth::user()->id}}">
                                                <input hidden type="number" name="process_order_id" value="2">
                                            </form>
                                        </td>
                                        @else
                                        <!-- <td><span class="right badge badge-danger">Cancelado</span></td> -->
                                        <td>
                                            <form action="{{route('status_orders.update',$order_detail->order_id)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                &ensp;&ensp;&ensp;&ensp;&ensp;
                                                <button class="btn btn-info" disabled>Proceso</button>
                                                <input hidden type="number" name="order_id" value="{{$order_detail->order_id}}">
                                                <input hidden type="number" name="user_id" value="{{Auth::user()->id}}">
                                                <input hidden type="number" name="process_order_id" value="2">
                                            </form>
                                        </td>
                                        @endif
                                        
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th class="text-center">&ensp;Order ID</th>
                                    <th>Cliente</th>
                                    <th>Articulo</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Sub Total</th>
                                    <th>Orden </th>
                                    <th>Cambiar Estado A:</th>
                                    {{--                                    <th>Color</th>--}}
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
