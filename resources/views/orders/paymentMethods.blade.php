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
                                <p class="card-title m-0 float-right">
                                    <b>ORDER ID : </b>
                                    {{$order_details[0]->order_id}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('transactions.store')}}" method="POST">
                            @csrf
                            @foreach($orders as $order)
                                <div class="row">
                                    <div class="col-6 text-center">
                                        <h2><b>Direccion</b></h2>
                                        <h3>{{$order->city}}</h3>
                                    </div>
                                    <div class="col-6 text-center">
                                        <h2><b>Costo de Envio</b></h2>
                                        <h3>{{$order->price}}</h3>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                            @endforeach
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-8">
                                            <input type="number" name="account_number" class="form-control float-left" placeholder="Ingrese numero de tarjeta..">
                                        </div>
                                        <div class="col-4">
                                            <i class="fa fa-credit-card" aria-hidden="true"></i>&ensp;&ensp;
                                            <i class="fa fa-credit-card" aria-hidden="true"></i><br>
                                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <strong class="float-right">Monto Total Mas Envio: {{$totalAmounts[0]->montoTotal+$order->price}}</strong>
                                    <input type="text" name="amount" value="{{$totalAmounts[0]->montoTotal+$order->price}}">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                {{--                            <a href="/more/{{$order_details[0]->order_id}}/article" class="btn btn-info float-left">Añadir Mas Articulos</a>--}}
                                {{--                            <a href="/payment/methods/{{$order_details[0]->order_id}}/{{$orders[0]->transport_fares_id}}/{{$orders[0]->user_id}}" class="btn btn-danger float-right">Proceder con forma de pago!!!</a>--}}
                                <button class="btn btn-success float-right">Realizar Pedido!!!</button>
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
                            $('#transport_fare').append("<option  value='"+index+"'>"+value+"</option>");
                        }).done();
                    });
                }
            });
        });
    </script>
@endsection
