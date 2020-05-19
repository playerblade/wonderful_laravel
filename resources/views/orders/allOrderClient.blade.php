@extends('layouts.client.app')
@section('content')
    <br>
    <section class="container">
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
                                        <th>Numero de Orden</th>
                                        <th>Estado</th>
                                        <th>Fecha</th>
                                        <th>Usuario</th>
                                        <th class="text-right">Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->order_id}}</td>
{{--                                            @if($order->active == 1)--}}
{{--                                                <td><span class="right badge badge-success">En Curso</span></td>--}}
{{--                                            @else--}}
{{--                                                <td><span class="right badge badge-danger">Cancelado</span></td>--}}
{{--                                            @endif--}}
                                            @if($order->estado == 'inicial')
                                                <td><span class="right badge badge-secondary">{{$order->estado}}</span></td>
                                            @endif
                                            @if($order->estado == 'proceso')
                                                <td><span class="right badge badge-primary">{{$order->estado}}</span></td>
                                            @endif
                                            <td>{{$order->fechaOrden}}</td>
                                            @if($order->estado == 'inicial')
                                                <td><span class="right badge badge-secondary">{{$order->usuario}}</span></td>
                                            @else
                                                <td>{{$order->usuario}}</td>
                                            @endif
{{--                                            @if($order->estado == 'inicial' || $order->estado == 'proceso' )--}}
{{--                                                @if($order->active == 1)--}}
{{--                                                    <td class="py-0 align-middle text-right">--}}
{{--                                                        <form action="{{ route('order_cancel',$order->order_id) }}" method="POST">--}}
{{--                                                            @csrf--}}
{{--                                                            @method('PUT')--}}
{{--                                                            <div class="btn-group btn-group-sm">--}}
{{--                                                                <button type="submit" class="btn btn-warning"><i class="fas fa-stop-circle"></i> Cancelar</button>--}}
{{--                                                            </div>--}}
{{--                                                        </form>--}}
{{--                                                    </td>--}}
{{--                                                @else--}}
{{--                                                    <td class="py-0 align-middle text-right">--}}
{{--                                                        <form action="{{ route('order_restart',$order->order_id) }}" method="POST">--}}
{{--                                                            <div class="btn-group btn-group-sm">--}}
{{--                                                                @csrf--}}
{{--                                                                @method('PUT')--}}
{{--                                                                <button type="submit" class="btn btn-warning"><i class="fas fa-play-circle"></i> Restablecer</button>--}}
{{--                                                            </div>--}}
{{--                                                        </form>--}}
{{--                                                    </td>--}}
{{--                                                @endif--}}
{{--                                            @else--}}
{{--                                                <td>><span class="right badge badge-secondary">You Can't Cancel</span></td>--}}
{{--                                            @endif--}}
                                            <td>
                                                <a href="/order_detail/{{$order->order_id}}/client" class="btn btn-info"><i class="fas fa-eye"></i> Ver</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfooter>
                                        <thead>
                                        <tr>
                                            <th>Numero de Orden</th>
                                            <th>Estado</th>
                                            <th>Fecha</th>
                                            <th>Usuario</th>
                                            <th class="text-right">Opciones</th>
                                        </tr>
                                        </thead>
                                    </tfooter>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.container-fluid -->
@endsection

