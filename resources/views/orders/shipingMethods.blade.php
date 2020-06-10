@extends('layouts.client.app')
@section('content')
    <br>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="callout callout-info elevation-3">
                    <h5><i class="fas fa-info"></i> Nota:</h5>
                    Asegurese de ingresar adecuadamente su direccion, la ciudad y el forma de envio que desee. !!!
                </div>
                <!-- Main content -->
                <div class="invoice p-3 mb-3 card-purple card-outline elevation-5">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> WonderFUL, Web.
                                <small class="float-right"><b>Fecha:</b> {{Carbon\Carbon::parse($order_details[0]->fecha)->isoFormat('LLL')}}</small>
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong>Admin, WonderFUL</strong>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong>
                                    {{ Auth::user()->first_name }}
                                    {{ Auth::user()->last_name }}
                                    {{ Auth::user()->mother_last_name }}
                                </strong><br>
                                Phone: (+591) {{Auth::user()->phone_number}}<br>
                                User: {{Auth::user()->user}}<br>
                                Birthday: {{Carbon\Carbon::parse(Auth::user()->birthday)->isoFormat('LL')}}
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <br>
                            <b>Numero de Orden:</b> {{$order_details[0]->order_id}}
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Color</th>
                                    <th>Sub Total</th>
                                    {{--                                    <th class="text-right">Opciones</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order_details as $order_detail)
                                    <tr>
                                        <td>{{$order_detail->articulo}}</td>
                                        <td>{{$order_detail->precio}}</td>
                                        <td>{{$order_detail->cantidad}}</td>
                                        <td>
                                            <img src="{{asset('/imagenes/imagenes_articulos/'.$order_detail->color)}}" alt="" class="img-circle fa-2x" style="width: 35px; height: 35px;">
                                        </td>
                                        <td>${{$order_detail->subTotal}}</td>
                                        {{--                                        <td class="py-0 align-middle text-right">--}}
                                        {{--                                            <form action="{{ route('order_details.destroy',$order_detail->id) }}" method="POST">--}}
                                        {{--                                                <div class="btn-group btn-group-sm">--}}
                                        {{--                                                    @csrf--}}
                                        {{--                                                    @method('DELETE')--}}
                                        {{--                                                    <button type="submit" class="btn btn-warning"><i class="fas fa-trash"></i> Quitar Articulo</button>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </form>--}}
                                        {{--                                        </td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-5">
                            <p><b>Monto de:</b> {{Carbon\Carbon::parse($order_details[0]->fecha)->isoFormat('LLLL')}}</p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td>${{$totalAmounts[0]->montoTotal}}</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>${{$totalAmounts[0]->montoTotal}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-7">
                            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                            <form action="{{route('orders.update',$order->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-6">
                                        <strong>Ciudad</strong>
                                        <select id="cities" name="city_id" class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 100%;" required>
                                            <option value="">Seleccione un ciudad</option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}">{{$city->city}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <strong>Costo de envio</strong>
                                        <select id="transport_fare" name="transport_fares_id"  class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 100%;" required>
                                            {{--                                        json code--}}
                                        </select>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <strong>Direccion</strong>
                                        <input type="text" class="form-control" name="location" placeholder="Lugar, Calle, Numero de casa" required>
                                        @foreach($orders as $order)
                                            <input hidden type="text" name="user_id" value="{{$order->user_id}}">
                                            <input hidden type="text" name="total_amount" value="{{$order->total_amount + $totalAmounts[0]->montoTotal}}" >
                                        @endforeach
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <button class="btn btn-success btn-sm float-right">Proceder con forma de pago!!!</button>
                                </div>
                            </form>
                            </p>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.invoice -->
            </div>
            <!-- /. col-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection
@section('script_transport_fares')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#cities').on('change',function () {
                var city_id = $('#cities').val();
                if ($.trim(city_id) != ''){
                    $.get('/get_transport_fares',{city_id: city_id}, function (transport_fares) {
                        $('#transport_fare').empty();
                        $('#transport_fare').append("<option value=''>Selecione su tipo y precio de envio</option>");
                        $.each(transport_fares, function (index , value){
                            if (value[1] == 1 ){
                                $('#transport_fare').append("<option  value='"+index+"'>Envio Normal "+value[0]+" bs.</option>");
                            }
                            if (value[1] == 0 ){
                                $('#transport_fare').append("<option  value='"+index+"'>Envio Rapido "+value[0]+" bs.</option>");
                            }
                        }).done();
                    });
                }
            });
        });
    </script>
@endsection
