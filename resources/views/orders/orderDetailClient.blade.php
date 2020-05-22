@extends('layouts.client.app')
@section('content')
    <!-- Main content -->
    <br>
    <section class="container">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <form action="{{ route('order_cancel',$orderDetails[0]->order_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                        <div class="card-header">
                            <div class="row">
                                <input hidden type="text" name="first_name" value="{{Auth::user()->first_name}}">
                                @if($orderDetails)
                                    <div class="col-6 float-left">
                                        <h3 class="card-title"><b>Orden:</b>&ensp; {{$orderDetails[0]->order_id}}</h3><br>
                                        <h3 class="card-title"><b>Cliente:</b>&ensp; {{$orderDetails[0]->cliente}}</h3>
                                    </div>
                                    <div class="col-6 float-right">
                                        <h3 class="card-title"><b>Fecha:</b>&ensp; {{$orderDetails[0]->fecha}}</h3>
                                        @if($totalAmounts)
                                            <h3 class="card-title float-right"><b>Monto Total Mas Envio:</b>&ensp; {{$totalAmounts[0]->montoTotal + $transport[0]->price}}</h3>
{{--                                            <input hidden type="number" name="monto_total" value="{{$totalAmounts[0]->montoTotal + $transport[0]->price}}">--}}
                                             <input hidden type="number" name="amount_bank_account" value="{{$transaction[0]->amount}}">
                                        @else
                                            No hay datos...
                                        @endif
                                        <br>
                                        <div class="btn-group btn-group-sm float-right">
                                            <button type="submit" class="btn btn-warning"><i class="fas fa-stop-circle"></i> Cancelar Orden</button>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-12">
                                        <h2 class="card-title"><b>No hay registros disponibles de la orden</b></h2>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            {{--                            table-striped projects  otro estilo=> table-bordered--}}
                            <table id="example1" class="table table-striped elevation-2">
                                <thead>
                                <tr>
{{--                                    <th class="text-center">&ensp;&ensp;ID</th>--}}
                                    <th>Articulo</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Sub Total</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orderDetails as $orderDetail)
                                    <tr>
                                        <input hidden type="text" value="{{$orderDetail->color}}" name="color">
{{--                                        <th class="text-center">{{$orderDetail->article_id}}</th>--}}
                                        <td>{{$orderDetail->articulo}}</td>
                                        <td>{{$orderDetail->precio}}</td>
                                        <td>{{$orderDetail->cantidad}} <input hidden type="number" name="quantity" value="{{$orderDetail->cantidad}}"> </td>
                                        <td>{{$orderDetail->subTotal}}</td>
                                        <td class="text-center">
                                            <button type="submit" class="btn">
                                                <a class="btn bg-success elevation-1 btn-sm" href="/reportes/cliente/orden/detalle_orden/{{$orderDetail->article_id}}/articulo">
                                                    <i class="fas fa-eye"></i>
                                                    <span class="right badge badge-success">Ver</span>
                                                    {{--                                                    &ensp;Ver | {{$orderDetail->articulo}}--}}
                                                </a>
                                            </button>
                                            <button type="submit" class="btn">
                                                <a class="btn bg-danger elevation-1 btn-sm" href="/reportes/cliente/orden/detalle_orden/{{$orderDetail->article_id}}/articulo">
                                                    <i class="fas fa-trash"></i>
                                                    <span class="right badge badge-danger">Quitar</span>
                                                    {{--                                                    &ensp;Ver | {{$orderDetail->articulo}}--}}
                                                </a>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
{{--                                    <th class="text-center">&ensp;ID</th>--}}
                                    <th>Articulo</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Sub Total</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                            <input type="text" hidden value="funciona" name="test">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
