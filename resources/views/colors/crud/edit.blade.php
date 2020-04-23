@extends('layouts.admin.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Colores</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Colores</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <!-- AREA CHART -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Colores</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                            <table id="example1" class="table table-striped elevation-2">
                                <thead>
                                <tr>
                                    <th class="text-center">&ensp; ID</th>
                                    <th>Name</th>
                                    <th>Imagen</th>
                                    <th>Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($colors_edit as $color_item)
                                    <tr>
                                        <th class="text-center">{{$color_item->id}}</th>
                                        <td>{{$color_item->name}}</td>
                                        <td>
                                            <img class="img-circle fa-2x" style="width: 30px; height: 30px;" src="{{asset('/imagenes/imagenes_articulos/'.$color_item->image)}}" alt="">
                                        </td>
                                        <td class="py-0 align-middle text-right">
                                            <form action="{{ route('articles.destroy',$color_item->id) }}" method="POST">
                                                <div class="btn-group btn-group-sm">
                                                    <a  href="{{ route('articles.edit',$color_item->id) }}" class="btn btn-info float-right">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('articles.edit',$color_item->id) }}" class="btn btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th class="text-center">&ensp; ID</th>
                                    <th>Name</th>
                                    <th>Imagen</th>
                                    <th class="text-right">Opciones</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col (LEFT) -->
                <div class="col-md-4">
                    <!-- LINE CHART -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Editar Colores</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <form action="{{ route('colors.update',$color->id) }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="card-title">Color:</label>
                                    <input type="text" name="name" value="{{$color->name}}" class="form-control" placeholder="nombre del color">
                                </div>
                                <div class="form-group">
                                    <strong for="customFile">Imagen:</strong>
                                    <div class="custom-file">
                                        <input type="file" name="images" value="{{$color->image}}" class="custom-file-input" id="customFile">
                                        {{--                                        <input type="file" name="images">--}}
                                        <label class="custom-file-label" for="customFile">{{$color->image}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit"  class="btn btn-info form-control ">Guardar Cambios</button>
                            </div>
                        </form>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col (RIGHT) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
