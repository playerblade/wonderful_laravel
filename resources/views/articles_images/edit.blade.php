@extends('layouts.menuAdmin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Articulos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                        <li class="breadcrumb-item active">Articulos</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Editar Articulos</h3>
                            {{-- <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#modal-lg">
                                <i class="fas fa-plus-circle"></i>
                                Agregar
                            </button> --}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('articles.update',$article->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <!-- SELECT2 EXAMPLE -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <label>Sub Categoria:</label>
                                                <select name="sub_category_id" class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 100%;">
                                                @foreach ($sub_categories as $sub_categories)
                                                    <option selected="selected" value="{{ $sub_categories->id }}">
                                                        {{ $sub_categories->sub_category }}
                                                    </option>
                                                @endforeach
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <strong>Articulo:</strong>
                                                <input type="text" name="title" value="{{ $article->title }}" class="form-control" placeholder="Name">
                                            </div>
                                            <div class="form-group">
                                                <strong>Marker:</strong>
                                                <input type="text" name="marker" value="{{ $article->marker }}" class="form-control" placeholder="Marker">
                                            </div>
                                            <div class="form-group">
                                                <strong>Stock:</strong>
                                                <input type="number" name="stock" value="{{ $article->stock }}" class="form-control" placeholder="Stock">
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Description:</strong>
                                                <textarea name="description" class="form-control" rows="2">{{ $article->description }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <strong>Color:</strong>
                                                <div class="select2-purple">
                                                    <select class="select2" multiple="multiple" data-placeholder="Select a Color" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                        @foreach($colors as $color) --}}
                                                        <option>{{ $color->image }}</option> --}}
                                                        <option value="">
                                                            <img src="{{asset('/imagenes/imagenes_articulos/'.$color->image)}}" alt="">
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <strong for="customFile">Imagen:</strong>                        
                                                <div class="custom-file">
                                                  <input type="file" class="custom-file-input" id="customFile">
                                                  <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <strong>Precio:</strong>
                                                {{-- <div class="card-body"> --}}
                                                <input type="text" name="precio" class="form-control" placeholder="Precio">
                                                <input type="checkbox" name="my-checkbox" class="float-right" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                                {{-- </div> --}}
                                            </div>
                                        </div>
                                        <!-- /.col -->    
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button  class="btn btn-primary float-right">Save changes</button>
                                </div>
                            </form>
            
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection