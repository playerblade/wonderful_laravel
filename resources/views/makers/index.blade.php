@extends('layouts.menuAdmin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Fabricante</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                        <li class="breadcrumb-item active">Fabricante</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                       <div class="card-header">
                           {{-- <h3 class="card-title float-left">DataTable with default left</h3> --}}
                            <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#modal-lg">
                                <i class="fas fa-plus-circle"></i>
                                Agregar
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-striped elevation-2">
                                <thead>
                                <tr>
                                    <th class="text-center">&ensp; ID</th>
                                    <th>id</th>
                                    <th>Nombre</th>
                                    <th>Ubicacion</th>
                                    <th>Telefono</th>
                                    <th>Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($makers as $maker)
                                        <tr>
                                            <th class="text-center">{{$maker->id}}</th>
                                            <td>{{$maker->id}}</td>
                                            <td>{{$maker->makerss}}</td>
                                            <td>{{$maker->location}}</td>
                                            <td>{{$maker->phone_number}}</td>
                                            <td class="py-0 align-middle">
                                             
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                <th class="text-center">&ensp; ID</th>
                                    <th>id</th>
                                    <th>Nombre</th>
                                    <th>Ubicacion</th>
                                    <th>Telefono</th>
                                    <th>Opciones</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            
            {{-- CREATE ARTICULOS  --}}
            <div class="modal fade" id="modal-lg">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar Fabricante</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('makers.store') }}" method="POST">
                            @csrf 
                            <div class="modal-body">
                                <!-- SELECT2 EXAMPLE -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <strong>Nombre:</strong>
                                            <input type="text" name="name" class="form-control" placeholder="Name">
                                        </div>
                                        <div class="form-group">
                                            <strong>Ubicacion:</strong>
                                            <input type="text" name="location" class="form-control" placeholder="Location">
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <strong>Telefono:</strong>
                                            <input type="text" name="phone_number" class="form-control" placeholder="Telefono">
                                        </div>
                                    </div>
                                    <!-- /.col -->    
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button  class="btn btn-default" data-dismiss="modal">Close</button>
                                <button  class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            {{-- EDIT ARTICULOS --}}
            <div class="modal fade" id="modal-lg-edit">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Mostrar Fabricante</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                       <form action="{{ route('makers.show', $maker->id) }}" method="GET">
                            @csrf
                            @method('GET')
                            <div class="modal-body">
                                <!-- SELECT2 EXAMPLE -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <strong>Primer Nombre:</strong>
                                            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Name" disabled>
                                        </div>
                                        <div class="form-group">
                                            <strong>Segundo Nombre:</strong>
                                            <input type="text" name="second_name" id="second_name" class="form-control" placeholder="Name" disabled>
                                        </div>
                                        <div class="form-group">
                                            <strong>Apellido Paterno:</strong>
                                            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" disabled>
                                        </div>
                                        <div class="form-group">
                                            <strong>Apellido Materno:</strong>
                                            <input type="text" name="mother_last_name" id="mother_last_name" class="form-control" placeholder="Last Name" disabled>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <strong>Genero:</strong>
                                            <div>
                                                <input type="radio" name="gender" id="gender" class="form-control" value="M" disabled>M
                                            </div>
                                            <div>
                                                <input type="radio" name="gender" id="gender" class="form-control" value="F" disabled>F
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <strong>Telefono:</strong>
                                            <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Telefono" disabled>
                                        </div>
                                        <div class="form-group">
                                            <strong>Direccion:</strong>
                                            <input type="text" name="direction" id="direction" class="form-control" placeholder="Direccion" disabled>
                                        </div>
                                    </div>
                                    <!-- /.col -->    
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button  class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

        </div>
        <!-- /.container-fluid -->
    </section>
@endsection

<!-- @section('modal_edit')
    <script>
  
    $('#modal-lg-edit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var sub_category = button.data('sub_category') 
        var article = button.data('article') 
        var marker = button.data('marker')
        var description = button.data('description')
        var stock = button.data('stock')
        var id = button.data('id') 
        var modal = $(this)
        modal.find('.modal-body #sub_category').val(sub_category);
        modal.find('.modal-body #article').val(article);
        modal.find('.modal-body #marker').val(marker);
        modal.find('.modal-body #description').val(description);
        modal.find('.modal-body #stock').val(stock);
        modal.find('.modal-body #id').val(id);

    });
  </script>
@endsection -->