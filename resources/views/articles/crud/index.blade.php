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
                    <div class="card card-info card-outline">
                       <div class="card-header">
                            <h3 class="card-title float-left">Articles</h3>
                            <button type="button" class="btn float-right btn-outline-info btn-sm" data-toggle="modal" data-target="#modal-lg">
                                <i class="fas fa-plus-circle"></i> &ensp;
                                Add More
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example3" class="table table-striped elevation-4">
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
                                                        <a  class="btn btn-info float-right" data-toggle="modal" data-target="#modal-lg-edit">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('articles.edit',$article->id) }}" class="btn btn-warning elevation-2" data-toggle="modal" data-target="#modal-article-edit{{$article->id}}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger elevation-2"><i class="fas fa-trash"></i></button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
{{--                                        EDIT MODAL ARTICLES--}}
                                        <div class="modal fade" id="modal-article-edit{{$article->id}}">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content card-info card-outline">
                                                    <div class="modal-header">
                                                        <b class="modal-title">Edit Articles</b>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{route('articles.update',$article->id)}}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body small">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <!-- /.form-group -->
                                                                    <div class="form-group">
                                                                        <label>Categoria:</label>
                                                                        <div class="select2-purple">
                                                                            <select id="categories2" class="form-control select2" name="category_id" style="width: 100%;" required>
                                                                                <option selected="selected">Seleccione Categoria</option>
                                                                                @foreach ($categories as $category)
                                                                                    @if($article->category == $category->category)
                                                                                        <option selected value="{{$category->id}}">{{$category->category}}</option>
                                                                                    @else
                                                                                        <option value="{{$category->id}}">{{$category->category}}</option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <strong>Articulo:</strong>
                                                                        <input type="text" name="title" class="form-control" placeholder="Name" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <strong>Marker:</strong>
                                                                        <select name="maker_id" class="form-control select2" style="width: 100%;" required>
                                                                            <option selected>Select a maker</option>
                                                                            @foreach($makers as $maker)
                                                                                @if($article->marker == $maker->name)
                                                                                    <option selected value="{{$maker->id}}">{{$maker->name}}</option>
                                                                                @else
                                                                                    <option value="{{$maker->id}}">{{$maker->name}}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <strong>Stock:</strong>
                                                                        <input type="number" name="stock" class="form-control" placeholder="Stock" required>
                                                                    </div>
                                                                </div>
                                                                <!-- /.col -->
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label>Sub Categoria:</label>
                                                                        <div class="select2-purple">
                                                                            <select id="sub_categories2" class="form-control select2" name="sub_category_id"  style="width: 100%;" required>
                                                                                <option id="option_sc" value="{{$article->sub_id}}">{{$article->sub_category}}</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <strong>Description:</strong>
                                                                        <textarea name="description" class="form-control" rows="2" required></textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <strong>Color:</strong>
                                                                        <div class="select2-purple">
                                                                            <select class="select2" name="color_id[]"  multiple="multiple" data-placeholder="Select a Color" data-dropdown-css-class="select2-purple" style="width: 100%;" required>
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
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- /.col -->
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button class="btn btn-primary">Save Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
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
                    <div class="modal-content card-purple card-outline">
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
                                            <select id="categories" name="category_id" class="form-control select2" style="width: 100%;" required>
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
{{--                                            <input type="text" name="marker" class="form-control" placeholder="Marker" required>--}}
                                            <select name="maker_id" class="form-control select2" style="width: 100%;" required>
                                                <option selected>Select a maker</option>
                                                @foreach($makers as $maker)
                                                    <option value="{{$maker->id}}">{{$maker->name}}</option>
                                                @endforeach
                                            </select>
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
                                            <select id="sub_categories" name="sub_category_id" class="form-control select2" style="width: 100%;" required>
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
                                                <select class="select2" name="color_id[]"  multiple="multiple" data-placeholder="Select a Color" data-dropdown-css-class="select2-purple" style="width: 100%;" required>
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
{{--                                                <div class="col-4">--}}
{{--                                                    <div class="form-group clearfix">--}}
{{--                                                        <div class="icheck-primary d-inline">--}}
{{--                                                            <input type="radio" id="radioPrimary1" name="is_current" checked="" value="1" required>--}}
{{--                                                            <label for="radioPrimary1">Current</label>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="icheck-primary d-inline">--}}
{{--                                                            <input type="radio" id="radioPrimary2" name="is_current" value="1" required disabled>--}}
{{--                                                            <label for="radioPrimary2">Before</label>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
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
@section('script_categories_create')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#categories').on('change',function () {
                var category_id = $('#categories').val();
                if ($.trim(category_id) != ''){
                    $.get('/get_sub_categories',{category_id: category_id}, function (sub_categories) {
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
@section('script_categories_edit')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#categories2').on('change',function () {
                var category_id = $('#categories2').val();
                if ($.trim(category_id) != ''){
                    $.get('/get_sub_categories',{category_id: category_id}, function (sub_categories) {
                        $('#option_sc').hide();
                        $('#sub_categories2').empty();
                        $('#sub_categories2').append("<option value=''>Selecione una sub categoria</option>");
                        $.each(sub_categories, function (index , value){
                            $('#sub_categories2').append("<option value='"+index+"'>"+value+"</option>");
                        });
                    }).done();
                }
            });
        });
    </script>
@endsection
