<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>WonderFUL | Invoice</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 4 -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset("/admin-lte/plugins/fontawesome-free/css/all.min.css")}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("/admin-lte/dist/css/adminlte.min.css")}}">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h2 class="page-header">
                    <i class="fas fa-globe"></i> WonderFUL, Web.
                    <small class="float-right"><b>Fecha:</b> {{Carbon\Carbon::parse($order_details[0]->fecha)->isoFormat('LLL')}}</small>
                </h2>
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
                        <th>Descripcion</th>
                        <th>Sub Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order_details as $order_detail)
                        <tr>
                            <td>{{$order_detail->articulo}}</td>
                            <td>$ {{$order_detail->precio}}</td>
                            <td class="text-center">{{$order_detail->cantidad}}</td>
                            <td>{{$order_detail->description}}</td>
                            <td>${{$order_detail->subTotal}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <hr>
        <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">
                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Tenga cuidado en el manejo de este docuemento y evite perder el mismo porque
                    le sirve a usted como documento de respaldo para el recojo de su orden:
                    Pasos para recojo de su orden: <br>
                    <b> 1: Aliste un folder de tamanio carta <br>
                        2: Fotocopie su CI 2 para respaldo <br>
                        3: Inprima esta factura <br>
                    </b>
                    Una vez que tenga todos estos aspectos esta listo para el recojo de su orden en la direccion que
                    usted espesifico al realizar su orden.
                </p>
            </div>
            <!-- /.col -->
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
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- ./wrapper -->

<script type="text/javascript">
    window.addEventListener("load", window.print());
</script>
</body>
</html>
