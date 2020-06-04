@extends('layouts.admin.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Categorias</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Categorias</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">

                    <!-- DONUT CHART -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Sub Categorias</h3>

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
                                    <th>Sub Categoria</th>
                                    <th>Categoria</th>
                                    <th>Fecha</th>
                                    <th class="text-right">Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sub_categories as $sub_category)
                                    <tr>
                                        <th class="text-center">{{$sub_category->id}}</th>
                                        <td>{{$sub_category->sub_category}}</td>
                                        <td>{{$sub_category->category}}</td>
                                        <td>
                                            {{Carbon\Carbon::parse($sub_category->created_at)->isoFormat('LLL')}}
                                        </td>
                                        <td class="py-0 align-middle text-right">
                                            <form action="{{ route('sub_categories.destroy',$sub_category->id) }}" method="POST">
                                                <div class="btn-group btn-group-sm">
                                                    <a  href="{{ route('sub_categories.show',$sub_category->id) }}" class="btn btn-info float-right">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('sub_categories.edit',$sub_category->id) }}" class="btn btn-warning">
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
                                    <th>Sub Categoria</th>
                                    <th>Categoria</th>
                                    <th>Fecha</th>
                                    <th class="text-right">Opciones</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col (LEFT) -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Crear Sub Categorias</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <form action="{{ route('sub_categories.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Categoria:</label>
                                    <select name="category_id" class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 100%;">
                                        <option selected="selected">Seleccione una Categoria</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="card-title">Sub Categoria:</label>
                                    <input type="text" class="form-control @error('sub_category') is-invalid @enderror" name="sub_category" value="{{ old('sub_category') }}" required autocomplete="sub_category" autofocus>
                                    @error('sub_category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit"  class="btn btn-info form-control ">Guardad Sub Categoria</button>
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
