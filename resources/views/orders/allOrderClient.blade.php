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
                                <table id="example3" class="table table-striped elevation-2">
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
                                            @if($order->active == 1 )
                                                <td>{{$order->order_id}}</td>
                                                @if($order->active == 0)
                                                    <td><span class="right badge badge-danger">Cancelado</span></td>
                                                @else
                                                    @if($order->estado == 'inicial')
                                                        <td><span class="right badge badge-secondary">{{$order->estado}}</span></td>
                                                    @endif
                                                    @if($order->estado == 'proceso')
                                                        <td><span class="right badge badge-primary">{{$order->estado}}</span></td>
                                                    @endif
                                                @endif
                                                <td>{{$order->fechaOrden}}</td>
                                                @if($order->estado == 'inicial')
                                                    <td><span class="right badge badge-secondary">{{$order->usuario}}</span></td>
                                                @else
                                                    <td>{{$order->usuario}}</td>
                                                @endif
                                                <td class="text-right">
                                                    <a href="/order_detail/{{$order->order_id}}/client" class="btn btn-info"><i class="fas fa-eye"></i> Ver</a>
                                                </td>
                                            @else
{{--                                                elseeeeee--}}
                                                <td style="opacity: .4;">{{$order->order_id}}</td>
                                                @if($order->active == 0)
                                                    <td style="opacity: .4;"><span class="right badge badge-danger">Cancelado</span></td>
                                                @else
                                                    @if($order->estado == 'inicial')
                                                        <td style="opacity: .4;"><span class="right badge badge-secondary">{{$order->estado}}</span></td>
                                                    @endif
                                                    @if($order->estado == 'proceso')
                                                        <td style="opacity: .4;"><span class="right badge badge-primary">{{$order->estado}}</span></td>
                                                    @endif
                                                @endif
                                                <td style="opacity: .4;">{{$order->fechaOrden}}</td>
                                                @if($order->estado == 'inicial')
                                                    <td style="opacity: .4;"><span class="right badge badge-secondary">{{$order->usuario}}</span></td>
                                                @else
                                                    <td style="opacity: .4;">{{$order->usuario}}</td>
                                                @endif
                                                <td  class="text-right">
                                                    <a style="pointer-events: none;cursor: default; opacity: .4" href="/order_detail/{{$order->order_id}}/client" class="btn btn-info"><i class="fas fa-eye"></i> Ver</a>
                                                </td>
                                            @endif
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
            var msg = '{{\Illuminate\Support\Facades\Session::get('alert')}}'
            var exist = '{{\Illuminate\Support\Facades\Session::has('alert')}}'
            if (exist){
                Toast.fire({
                    type: 'success',
                    title: msg
                })
            }

        });
    </script>

@endsection

