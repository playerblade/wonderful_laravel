@extends('layouts.client.app')
@section('content')
    <br>
    <div class="container">
        <div class="row">
            <!-- /.col-md-6 -->
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <u><b>{{Auth::user()->first_name}} {{Auth::user()->last_name}} {{Auth::user()->mother_last_name}}</b> </u>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table id="example1" class="table table-striped elevation-2">
                                    <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Orden</th>
{{--                                        <th>Articulo</th>--}}
{{--                                        <th>Cantidad</th>--}}
{{--                                        <th>Color</th>--}}
{{--                                        <th>Monto Total</th>--}}
{{--                                        <th>Estado</th>--}}
                                        <th class="text-right">Opciones De orden</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->order_id}}</td>
                                            @if($order->active == 1)
                                                <td><span class="right badge badge-success">En Curso</span></td>
                                            @else
                                                <td><span class="right badge badge-danger">Cancelado</span></td>
                                            @endif
                                            @if($order->process_order == 'initial' || $order->process_order == 'process' )
                                                @if($order->active == 1)
                                                    <td class="py-0 align-middle text-right">
                                                        <form action="{{ route('order_cancel',$order->order_id) }}" method="POST">
                                                            <div class="btn-group btn-group-sm">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-warning"><i class="fas fa-stop-circle"></i> Cancelar</button>
                                                            </div>
                                                        </form>
                                                    </td>
                                                @else
                                                    <td class="py-0 align-middle text-right">
                                                        <form action="{{ route('order_restart',$order->order_id) }}" method="POST">
                                                            <div class="btn-group btn-group-sm">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-warning"><i class="fas fa-play-circle"></i> Restablecer</button>
                                                            </div>
                                                        </form>
                                                    </td>
                                                @endif
                                            @else
                                                <td><p>Opciones no diponibles</p></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfooter>
                                        <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Orden</th>
{{--                                            <th>Articulo</th>--}}
{{--                                            <th>Cantidad</th>--}}
{{--                                            <th>Color</th>--}}
{{--                                            <th>Monto Total</th>--}}
{{--                                            <th>Estado</th>--}}
                                            <th class="text-right">Opciones De orden</th>
                                        </tr>
                                        </thead>
                                    </tfooter>
                                </table>
                            </div>
                        </div>
{{--                        <form action="{{route('orders.update',$order->id)}}" method="POST">--}}
{{--                            @csrf--}}
{{--                            @method('PUT')--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-4">--}}
{{--                                    <strong>Ciudad</strong>--}}
{{--                                    <select id="cities" name="city_id" class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 100%;" required>--}}
{{--                                        <option value="">Seleccione un ciudad</option>--}}
{{--                                        @foreach($cities as $city)--}}
{{--                                            <option value="{{$city->id}}">{{$city->city}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <div class="col-4">--}}
{{--                                    <strong>Direccion</strong>--}}
{{--                                    <input type="text" class="form-control" name="location" placeholder="Lugar, Calle, Numero de casa" required>--}}
{{--                                </div>--}}
{{--                                <div class="col-4">--}}
{{--                                    <strong>Costo</strong>--}}
{{--                                    <select id="transport_fare" name="transport_fares_id"  class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 100%;" required>--}}
{{--                                        --}}{{--                                        json code--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                @foreach($orders as $order)--}}
{{--                                    <input hidden type="text" name="user_id" value="{{$order->user_id}}">--}}
{{--                                    <input hidden type="text" name="total_amount" value="{{$order->total_amount + $totalAmounts[0]->montoTotal}}" >--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                            <hr>--}}
{{--                            <div class="form-group">--}}
{{--                                --}}{{--                            <a href="/more/{{$order_details[0]->order_id}}/article" class="btn btn-info float-left">Añadir Mas Articulos</a>--}}
{{--                                --}}{{--                            <a href="/payment/methods/{{$order_details[0]->order_id}}/{{$orders[0]->transport_fares_id}}/{{$orders[0]->user_id}}" class="btn btn-danger float-right">Proceder con forma de pago!!!</a>--}}
{{--                                <button class="btn btn-danger float-right">Proceder con forma de pago!!!</button>--}}
{{--                            </div>--}}
{{--                        </form>--}}
                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection

