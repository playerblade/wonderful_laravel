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
                                <h5 class="card-title m-0 float-left"><b>Monto Total: </b> {{$totalAmounts[0]->montoTotal}}</h5>
                                <h5 class="card-title m-0 float-right">
                                    <b>
                                        {{ Auth::user()->first_name }}
                                        {{ Auth::user()->last_name }}
                                        {{ Auth::user()->mother_last_name }}
                                    </b>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Articulo</th>
                                        <th>Cantidad</th>
                                        <th>Color</th>
                                        <th class="text-right">Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order_details as $order_detail)
                                        <tr>
                                            <td>{{$order_detail->articulo}}</td>
                                            <td>{{$order_detail->cantidad}}</td>
                                            <td>
                                                <img src="{{asset('/imagenes/imagenes_articulos/'.$order_detail->color)}}" alt="" class="img-circle fa-2x" style="width: 35px; height: 35px;">
                                            </td>
                                            <td class="py-0 align-middle text-right">
                                                <form action="{{ route('order_details.destroy',$order_detail->id) }}" method="POST">
                                                    <div class="btn-group btn-group-sm">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
                                    <strong>Costo</strong>
                                    <select id="transport_fare" name="transport_fares_id"  class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 100%;" required>
{{--                                        json code--}}
                                    </select>
                                </div>
                                @foreach($orders as $order)
                                    <input hidden type="text" name="user_id" value="{{$order->user_id}}">
                                    <input hidden type="text" name="total_amount" value="{{$order->total_amount + $totalAmounts[0]->montoTotal}}" >
                                @endforeach
                            </div>
                            <hr>
                            <div class="form-group">
                                {{--                            <a href="/more/{{$order_details[0]->order_id}}/article" class="btn btn-info float-left">Añadir Mas Articulos</a>--}}
                                {{--                            <a href="/payment/methods/{{$order_details[0]->order_id}}/{{$orders[0]->transport_fares_id}}/{{$orders[0]->user_id}}" class="btn btn-danger float-right">Proceder con forma de pago!!!</a>--}}
                                <button class="btn btn-danger float-right">Proceder con forma de pago!!!</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
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
