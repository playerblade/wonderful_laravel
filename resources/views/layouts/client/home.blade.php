@extends('layouts.client.app')
@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"> Welcome To Wonderful <small>Version 1.0</small></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Cliente</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container">
      <div class="row">
          <div class="col-12 text-center">
              <div class="card card-primary card-outline">
                  <div class="card-header">
                      <div class="row">
                          <div class="col-6">
                              <div class="row">
                                  <div class="col-6">
                                      <select id="" name="sub_category_id" class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 100%;" required>
                                      </select>
                                  </div>
                                  <div class="col-6">
                                      <select id="" name="sub_category_id" class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 100%;" required>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="col-6">
                              <h5 class="card-title m-0 float-right"><b>Articulos</b></h5>
                          </div>
                      </div>
                  </div>
                  <div class="card-body">
                      @foreach($articles as $article)
                          <div class="row">
                              <div class="col-4">
                                  {{--                              <h1>Images</h1>--}}
                                  {{--                              <img src="" alt="">--}}
                                  <img class="rounded mx-auto d-block img-fluid"  src="{{asset('/imagenes/imagenes_articulos/'.$article->image)}}">
                              </div>
                              <div class="col-8">
                                  <h1>Title : {{$article->articulo}}</h1>
                                  <br>
                                  <div class="row">
                                      <div class="col-8">
                                          <h3>Price :{{$article->price}}</h3>
                                          <p>!Compra ahora!!!</p>
                                      </div>
                                      <div class="col-4">
                                          <h4><b>Maker:</b> <br> {{$article->fabricante}}</h4>
                                      </div>
                                      <br><br><br>
                                      <a href="#" class="btn btn-primary float-right">Añadir al carrito</a>
                                  </div>
                              </div>
                              <a href="/order/{{$article->id}}/form" class="btn btn-primary mt-2">Ver detalle del producto</a>
                          </div>
                          <hr>
                          <hr>
                      @endforeach
                  </div>
              </div>
          </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection
