@extends('layouts.admin.app')
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
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                       <div class="card-header">
                            <h3 class="card-title float-left">Lista de Articulos</h3>
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
                                    <th>Articulo</th>
                                    <th>Fabricante</th>
                                    <th>Stock</th>
                                    {{--  <th>Color</th>  --}}
                                    <th>Sub Categoria</th>
                                    <th>Categoria</th>
                                    <th>Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($articles as $article)
                                        <tr>
                                            <th class="text-center">{{$article->id}}</th>
                                            <td>{{$article->article}}</td>
                                            <td>{{$article->marker}}</td>
                                            <td>{{$article->stock}}</td>
                                            {{--  <td>
                                                <img class="img-circle fa-2x" style="width: 20px; height: 20px;" src="{{asset('/imagenes/imagenes_articulos/'.$article->image)}}" alt="">
                                            </td>  --}}
                                            <td>{{$article->sub_category}}</td>
                                            <td>{{$article->category}}</td>
                                            <td class="py-0 align-middle">
                                                <form action="{{ route('articles.destroy',$article->id) }}" method="POST">
                                                    <div class="btn-group btn-group-sm">
                                                        <a  class="btn btn-info float-right"
                                                            data-toggle="modal" data-target="#modal-lg-edit">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('articles.edit',$article->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>

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
                                    <th>Articulo</th>
                                    <th>Fabricante</th>
                                    <th>Stock</th>
                                    {{--  <th>Color</th>  --}}
                                    <th>Sub Categoria</th>
                                    <th>Categoria</th>
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
                    <div class="modal-content card-red card-outline">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar Articulo</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('articles.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <!-- SELECT2 EXAMPLE -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Categoria:</label>
                                            <select id="categories" name="category_id" class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 100%;" required>
                                                <option selected="selected">Seleccione Categoria</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <strong>Articulo:</strong>
                                            <input type="text" name="title" class="form-control" placeholder="Name" required>
                                        </div>
                                        <div class="form-group">
                                            <strong>Marker:</strong>
                                            <input type="text" name="marker" class="form-control" placeholder="Marker" required>
                                        </div>
                                        <div class="form-group">
                                            <strong>Stock:</strong>
                                            <input type="number" name="stock" class="form-control" placeholder="Stock" required>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Sub Categoria:</label>
                                            <select id="sub_categories" name="sub_category_id" class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 100%;" required>
{{--                                                code js is here--}}
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <strong>Description:</strong>
                                            <textarea name="description" class="form-control" rows="2" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <strong>Color:</strong>
                                            <div class="select2-purple">
                                                <select class="select2" name="color_id[]"   multiple="multiple" data-placeholder="Select a Color" data-dropdown-css-class="select2-purple" style="width: 100%;" required>
                                                    @foreach($colors as $color)
                                                    <option value="{{$color->id}}">{{ $color->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <!-- /.form-group -->
{{--                                        <div class="form-group">--}}
{{--                                            <strong for="customFile">Imagen:</strong>--}}
{{--                                            <div class="custom-file">--}}
{{--                                              <input type="file" class="custom-file-input" id="customFile">--}}
{{--                                              <label class="custom-file-label" for="customFile">Choose file</label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="form-group">
                                            <strong>Precio:</strong>
                                             <div class="row">
                                                <div class="col-8">
                                                    <input type="text" name="price" class="form-control" placeholder="Precio" required>
                                                </div>
                                                <div class="col-4">
                                                    <input type="radio" checked  name="is_current" value="1" required>
                                                    <br>
                                                    <input type="radio" disabled name="is_current" value="0" required>
                                                </div>
                                             </div>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button  class="btn btn-default" data-dismiss="modal">Close</button>
                                <button  class="btn btn-primary">Guardar Articulos</button>
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
@section('script_categories')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#categories').on('change',function () {
                var category_id = $('#categories').val();
                if ($.trim(category_id) != ''){
                    $.get('get_sub_categories',{category_id: category_id}, function (sub_categories) {
                        $('#sub_categories').empty();
                        $('#sub_categories').append("<option value=''>Selecione una sub categoria</option>");
                        $.each(sub_categories, function (index , value){
                            $('#sub_categories').append("<option value='"+index+"'>"+value+"</option>");
                        });
                    }).done();
                }
            });
        });
    </script>
@endsection
