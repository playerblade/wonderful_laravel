@extends('layouts.admin.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Imagen de Articulos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                        <li class="breadcrumb-item active">Imagen de Articulos</li>
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
                                    <th>Articulo</th>
                                    <th>url_image</th>
                                    <th>is_main</th>
                                    <th>Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($image_articles as $img)
                                        <tr>
                                            <th class="text-center">{{$img->id}}</th>
                                            <td>{{$img->id}}</td>
                                            <td>{{$img->article}}</td>
                                            <td>{{$img->url_image}}</td>
                                            <td>{{$img->is_main}}</td>
                                            <td class="py-0 align-middle">
                                                <form action="{{ route('image_articles.destroy',$img->id) }}" method="POST">
                                                    <div class="btn-group btn-group-sm">
                                                        <a  class="btn btn-info float-right" 
                                                            data-id="{{ $img->id }}" 
                                                            data-article="{{ $img->article }}" data-is_main="{{ $img->is_main }}"
                                                            data-url_image="{{ $img->url_image }}" 
                                                            data-toggle="modal" data-target="#modal-lg-edit">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('image_articles.edit',$img->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>

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
                                    <th>id</th>
                                    <th>Articulo</th>
                                    <th>url_image</th>
                                    <th>is_main</th>
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
                            <h4 class="modal-title">Agregar Image articulo</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('image_articles.store') }}" method="POST">
                            @csrf 
                            <div class="modal-body">
                                <!-- SELECT2 EXAMPLE -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Articulo:</label>
                                            <select name="article_id" class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 100%;">
                                                <option selected="selected">Seleccione un Articulo</option>
                                            @foreach ($articles as $article)
                                                <option value="{{ $article->id }}">
                                                    {{ $article->title }}
                                                </option>
                                            @endforeach
                                            </select>
                                        </div>
                                        
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="customFile">Imagen:</label>                        
                                            <div class="custom-file">
                                              <input type="file" name="url_image" class="custom-file-input">
                                              <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
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
                            <h4 class="modal-title">Mostrar Articulo</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                       <form action="{{ route('articles.show', $article->id) }}" method="GET">
                            @csrf
                            @method('GET')
                            <div class="modal-body">
                                <!-- SELECT2 EXAMPLE -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Sub Categoria:</label>
                                            <input type="text" name="sub_category" id="sub_category"  class="form-control" placeholder="Sub Category" disabled>
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <strong>Articulo:</strong>
                                            <input type="text" name="title" id="article"  class="form-control" placeholder="Name" disabled>
                                        </div>
                                        <div class="form-group">
                                            <strong>Marker:</strong>
                                            <input type="text" name="marker" id="marker" class="form-control" placeholder="Marker" disabled>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong>Description:</strong>
                                            <textarea name="description" id="description" class="form-control" cols="5" rows="5" placeholder="Description" disabled></textarea>
                                        </div>
                                        <div class="form-group">
                                            <strong>Stock:</strong>
                                            <input type="number" name="stock" id="stock"  class="form-control" placeholder="Stock" disabled>
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