@extends('welcome.app')
@section('content')
    <div class="container">
        <div class="row">
            <!-- /.col-md-6 -->
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-6">
                                        <select id="categories" name="category_id" class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 100%;" required>
                                            <option selected="selected">Seleccione Categoria</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->category }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <select id="sub_categories" name="sub_category_id" class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 100%;" required>
                                            {{--                                                code js is here--}}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <h5 id="content" class="card-title m-0 float-right">

                                </h5>
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
                                <a href="/article/{{$article->id}}/detail" class="btn btn-primary mt-2">Ver detalle del producto</a>
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
    </div>
    <!-- /.container-fluid -->
@endsection
@section('script_categories_search')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#categories').on('change',function () {
                var category_id = $('#categories').val();
                if ($.trim(category_id) != ''){
                    $.get('get_sub_categories_search',{category_id: category_id}, function (sub_categories) {
                        $('#sub_categories').empty();
                        $('#sub_categories').append("<option value=''>Selecione una sub categoria</option>");
                        $.each(sub_categories, function (index , value){
                            $('#sub_categories').append("<option value='"+index+"'>"+value+"</option>");
                        });
                    }).done();
                }
            });

            $('#sub_categories').on('change', function () {
                var sub_category_id = $('#sub_categories').val();
                if ($.trim(sub_category_id) != ''){
                    // $('#content').empty();
                    // $('#content').append("<h1>HELLO CONTENT</h1>");
                    $.get('get_articles_search',{sub_category_id: sub_category_id}, function (articles) {
                        $('#content').empty();
                        // $('#content').append("<h1>HELLO CONTENT</h1>");
                        $.each(articles, function (index , value){
                            // $('#content').append("<h1>"+value+"</h1>");
                            $('#content').append("<input type='text' value='"+value+"'/>");
                        });
                    }).done();
                }
            });
        });
    </script>
@endsection
