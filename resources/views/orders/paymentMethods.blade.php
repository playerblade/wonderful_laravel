@extends('layouts.client.app')
@section('content')
    <br>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="callout callout-info elevation-3">
                    <h5><i class="fas fa-info"></i> Nota:</h5>
                    Asegurese de ingresar adecuadamente su numero de cuenta, tambien asegurece de tener el monto suficiente. !!!
                </div>

                <!-- Main content -->
                <div class="invoice p-3 mb-3 card-outline card-purple elevation-5">
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
                            <b>Numero de Orden:</b> {{$order_details[0]->order_id}} <br>
                            <b>Ciudad:</b>
                            @foreach($orders as $order)
                                {{$order->city}}<br>
                            @endforeach
                            <b>Direccion:</b> {{$order->location}}<br>
                            <b>Forma de envio:</b>
                                @if($order->shiping == 1)
                                    Rapido (1 dia)
                                @else
                                    Normal (3 dias)
                                @endif
                            <br>
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
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-6">
                            <p><b>Monto de:</b> {{Carbon\Carbon::parse($order_details[0]->fecha)->isoFormat('LLLL')}}</p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td>$ {{$totalAmounts[0]->montoTotal}}</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping:</th>
                                            @foreach($orders as $order)
                                            <td>$ {{$order->price}}</td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td>$ {{$totalAmounts[0]->montoTotal+$order->price}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                        <!-- accepted payments column -->
                        <div class="col-6">
                            <p class="lead">Payment Methods:</p>
                            <img src="{{asset("/admin-lte/dist/img/credit/visa.png")}}" alt="Visa">
                            <img src="{{asset("/admin-lte/dist/img/credit/mastercard.png")}}" alt="Mastercard">
                            <img src="{{asset("/admin-lte/dist/img/credit/american-express.png")}}" alt="American Express">
                            <img src="{{asset("/admin-lte/dist/img/credit/paypal2.png")}}" alt="Paypal">

                            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                <form action="{{route('transactions.store')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <strong>Numero de cuenta:</strong>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                                            </div>
                                            <input type="number" name="account_number" class="form-control float-left" placeholder="Ingrese numero de tarjeta.."required>
                                        </div>
                                    </div>
                                    <input type="text" hidden name="amount" value="{{$totalAmounts[0]->montoTotal+$order->price}}">

                                    <hr>
                                    <div class="form-group">
                                        <button class="btn btn-success btn-sm float-right">Realizar Pedido!!!</button>
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
            <!-- /.col-md-12 -->
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
@section('alert_validations')
    <script type="text/javascript">
        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000
            });
            // if exist some errors
            var msg = '{{\Illuminate\Support\Facades\Session::get('alerta')}}'
            var exist = '{{\Illuminate\Support\Facades\Session::has('alerta')}}'
            if (exist){
                Toast.fire({
                    type: 'warning',
                    title: msg
                })
            }

        });
    </script>
@endsection
