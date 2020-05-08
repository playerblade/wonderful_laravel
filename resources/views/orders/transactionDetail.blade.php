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

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <hr>
                        @foreach($transaction_details as $transaction_detail)
                            <div class="row text-center">
                                <div class="col-6">
                                    <strong>Cliente:</strong>
                                    <h4>{{$transaction_detail->first_name}} {{$transaction_detail->last_name}}</h4>
                                </div>
                                <div class="col-6">
                                    <strong>Numero de Transaccion:</strong>
                                    <h4>{{$transaction_detail->id}}</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center">
                                <div class="col-6">
                                    <strong>Monto total de Transaccion:</strong>
                                    <h4> {{$transaction_detail->mount_transaction}}</h4>
                                </div>
                                <div class="col-6">
                                    <strong>Tipo de Transaccion:</strong>
                                    <h4>{{$transaction_detail->type}}</h4>
                                </div>
                            </div>
                        @endforeach
                        <hr>
                        <a href="/home" class="btn btn-success container">Volver A Inicio</a>
                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div>
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

