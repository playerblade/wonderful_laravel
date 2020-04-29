@extends('layouts.client.app')
@section('content')
    <div class="container">
        <div class="row">
            <!-- /.col-md-6 -->
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-6">
                                        <select id="" name="sub_category_id" class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 100%;" required>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <select id="" name="sub_category_id" class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 100%;" required>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <h5 class="card-title m-0 float-right"><b>Articulos</b></h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach($order_details as $order_detail)
                            <div class="row">
                                <div class="col-4">
                                    {{--                              <h1>Images</h1>--}}
                                    {{--                              <img src="" alt="">--}}
                                    <img src="{{asset('/imagenes/imagenes_articulos/'.$order_detail->imagen)}}" class="product-image" alt="Product Image">
                                </div>
                                <div class="col-8">
                                    <h2>Title : {{$order_detail->articulo}}</h2>
                                    <br>
                                    <div class="row">
                                        <div class="col-4">
                                            <h4>Price : {{$order_detail->precio}}</h4>
                                            <h4>Sub Total : {{$order_detail->subTotal}}</h4>
                                        </div>
                                        <div class="col-4">
                                            <h4>Cantidad : {{$order_detail->cantidad}}</h4>
                                        </div>
                                        <div class="col-4">
                                            <h5><b>Color:</b></h5>
                                            <img src="{{asset('/imagenes/imagenes_articulos/'.$order_detail->color)}}" alt="" class="img-circle fa-2x" style="width: 35px; height: 35px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <hr>
                        @endforeach
                        <div class="form-group">
                            <a href="/more/{{$order_details[0]->order_id}}/article" class="btn btn-info float-left">Añadir Mas Articulos</a>
                            <a href="/payment/methods/{{$order_details[0]->order_id}}/{{$orders[0]->transport_fares_id}}/{{$orders[0]->user_id}}" class="btn btn-danger float-right">Proceder con forma de envio!!!</a>
                            <a href="{{ route('orders.edit',$order_details[0]->order_id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection
