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
                                    <th>Cambiar Estado A:</th>
                                    {{--                                    <th>Color</th>--}}
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
                                        <td>
                                            &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
                                            <form action="{{route('status_orders.update',$order_detail->order_id)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input hidden type="number" name="order_id" value="{{$order_detail->order_id}}">
                                                <input hidden type="number" name="user_id" value="{{Auth::user()->id}}">
                                                <input hidden type="number" name="process_order_id" value="2">
                                                &ensp;&ensp;&ensp;&ensp;&ensp;
                                                <button class="btn btn-info">Proceso</button>
                                            </form>
                                        </td>
                                        {{--                                        <td>{{$order_detail->color}}</td>--}}
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
