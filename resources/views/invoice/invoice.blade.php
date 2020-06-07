@extends('layouts.client.app')
@section('content')
    <!-- Main content -->
    <br>
    <section class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info elevation-3">
                        <h5><i class="fas fa-info"></i> Nota:</h5>
                        Verifique que todos sus datos sean exactos. Revise si la direccion o algun dato son icorrectos. !!!
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
                        <div class="row no-print">
                            <div class="col-12">
                                <a href="/invoice/print/{{$order_details[0]->order_id}}/order" target="_blank" class="btn bg-gradient-purple btn-block"><i class="fas fa-print"></i> Imprimir</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div>
                <!-- /.col-md-12 -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
