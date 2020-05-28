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
                                            <input hidden type="number" name="monto_total_transaction" value="{{$totalAmounts[0]->montoTotal + $transport[0]->price}}">
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
                                            <!-- <div class="mt-2"> -->
                                            <button type="button" class="btn bg-yellow elevation-1 btn-sm" data-toggle="modal" data-target="#modal-xl">
                                                ★★★★★
                                                </button>
                                            <!-- </div> -->
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
    <!-- inicio del modal-------------------------------------------------------------- -->
    <div class="modal fade" id="modal-xl">
                        <div class="modal-dialog modal-ml">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Evaluación del Articulo</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('comentaries.store') }}" method="POST">
                                    @csrf
                                    
                                    <div class="modal-body">
                                        <input hidden type="number" name="user_id" value="{{Auth::user()->id}}">
                                        <strong>Raiting</strong>
                                        <p class="clasificacion">
                                            <input id="radio1" type="radio" name="estrellas" value="5">
                                            <label class="labelTamanio" for="radio1">★</label>
                                            <input id="radio2" type="radio" name="estrellas" value="4">
                                            <label class="labelTamanio" for="radio2">★</label>
                                            <input id="radio3" type="radio" name="estrellas" value="3">
                                            <label class="labelTamanio" for="radio3">★</label>
                                            <input id="radio4" type="radio" name="estrellas" value="2">
                                            <label class="labelTamanio" for="radio4">★</label>
                                            <input id="radio5" type="radio" name="estrellas" value="1">
                                            <label class="labelTamanio" for="radio5">★</label>
                                        </p>
                                        <p>
                                            <input hidden type="number" name="article_id" value="{{$orderDetails[0]->article_id}}">
                                            <strong>Comentario</strong>
                                            <textarea name="comment" id="" cols="10" rows="5" class="form-control" placeholder="Cuenta lo que te parecio el producto. ¿Qué recomiendas? ¿Por qué?"></textarea>
                                        </p>
                                    
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button  class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button  class="btn btn-primary">Evaluar Producto</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
    <!-- fin del modal-------------------------------------------------------------- -->
@endsection

@section('scriptReadMore')
    <script>
        $(document).ready(function () {
            $('.nav-toggle').click(function () {
                var collapse_content_selector = $(this).attr('href');
                var toggle_switch = $(this);
                $(collapse_content_selector).toggle(function () {
                    if ($(this).css('display') == 'none') {
                        toggle_switch.html('Read More');
                    } else {
                        toggle_switch.html('Read Less');
                    }
                });
            });

        });
    </script>
@endsection