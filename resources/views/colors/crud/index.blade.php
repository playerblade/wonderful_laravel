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
                            <table id="example3" class="table table-striped elevation-2">
                                <thead>
                                <tr>
                                    <th class="text-center">&ensp; ID</th>
                                    <th>Name</th>
                                    <th>Imagen</th>
                                    <th>Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($colors as $color)
                                    <tr>
                                        <th class="text-center">{{$color->id}}</th>
                                        <td>{{$color->name}}</td>
                                        <td>
                                            <img class="img-circle fa-2x" style="width: 30px; height: 30px;" src="{{asset('/imagenes/imagenes_articulos/'.$color->image)}}" alt="">
                                        </td>
                                        <td class="py-0 align-middle text-right">
                                            <form action="{{ route('colors.destroy',$color->id) }}" method="POST">
                                                <div class="btn-group btn-group-sm">
                                                    <a  href="{{ route('colors.show',$color->id) }}" class="btn btn-info float-right">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('colors.edit',$color->id) }}" class="btn btn-warning">
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
                            <h3 class="card-title">Crear Colores</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('colors.store') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="card-title">Color:</label>
                                    <input type="text" name="name" class="form-control" placeholder="nombre del color">
                                </div>
                                <div class="form-group">
                                    <strong for="customFile">Imagen:</strong>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Chose a file</label>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit"  class="btn btn-info form-control ">Guardar Color</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Asiganar color a articulos</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('color_articles.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Articulo:</label>
                                    <select name="article_id" class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 100%;">
                                        <option selected="selected">Seleccione un articulo</option>
                                        @foreach ($articles as $article)
                                            <option value="{{ $article->id }}">
                                                {{ $article->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Color:</label>
                                    <select name="color_id" class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 100%;">
                                        <option selected="selected">Seleccione un color</option>
                                        @foreach($colors as $color)
                                            <option value="{{ $color->id }}">
                                                {{ $color->name }}
                                                {{--                                                <img class="img-circle fa-2x" style="width: 30px; height: 30px;" src="{{asset('/imagenes/imagenes_articulos/'.$color->image)}}" alt="">--}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Cantidad:</label>
                                    <input type="number" name="quantity" min="1" class="form-control">
                                </div>
                                <div class="card-footer">
                                    <button type="submit" style="display: block;" class="btn btn-info form-control ">Guardar Cambios</button>
                                </div>
                            </form>
                        </div>
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
