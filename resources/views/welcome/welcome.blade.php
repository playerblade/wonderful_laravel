@extends('welcome.app')
@section('content')
    {{--    <div class="container">--}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-1">
                {{--                SPACE--}}
            </div>
            <div class="col-3 small">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <b>Busquedas</b>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <label>Categoria</label>
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
                                <label>Sub Categoria</label>
                                <select id="sub_categories" name="sub_category_id" class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 100%;" required>
                                    {{--                                    ajax code--}}
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <label>Makers</label>
                                <select id="makers_search" name="sub_category_id" class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 100%;" required>
                                    <option selected >Select a maker</option>
                                    @foreach($makers as $maker)
                                        <option value="{{$maker->id}}">{{$maker->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-md-2 -->
            <div class="col-7 small">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <b class="float-left">Articulos</b>
                        <!-- SEARCH FORM -->
                        <div class="form-inline ml-0 ml-md-3 float-right">
                            <div class="input-group input-group-sm float-right">
                                <input id="search_article" class="form-control" type="search" placeholder="Search a article" aria-label="Search">
                            </div>
                        </div>
                    </div>
                    <div id="content_hidden" class="card-header small">
{{--                        <hr>--}}
                        @foreach($articles as $article)
                            <div class="row">
                                <div class="col-4">
                                    <img class="rounded mx-auto d-block img-fluid"  src="{{asset('/imagenes/imagenes_articulos/'.$article->url_image)}}">
                                    <a href="/article/{{$article->id}}/detail" class="btn btn-block bg-gradient-primary btn-sm mt-2">Ver detalle</a>
                                </div>
                                <div class="col-8">
                                    <h3>{{$article->title}}</h3>
                                    <br>
                                    <div class="row">
                                        <div class="col-8">
                                            <h4>Price :{{$article->price}}</h4>
                                            <p>!Compra ahora!!!</p>
                                        </div>
                                        <div class="col-4">
                                            {{--                                                <h5><b>Avaliable Colors</b></h5>--}}
                                            <h5><b>Maker:</b> <br> {{$article->name}}</h5>
                                            <h5 class="mt-3"><b>Raiting:</b><br></h5>
                                        </div>
                                        <br><br><br>
                                        <a href="/login" class="btn bg-gradient-primary btn-sm float-right">Añadir al carrito</a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <hr>
                        @endforeach
                        <div class="card-link">{{$articles->links()}}</div>
                    </div>
                    <div id="content" class="card-header small">
                        {{--                        json code--}}
                    </div>
                </div>
            </div>
{{--            <div class="col-1">--}}
{{--                --}}{{--                SPACE--}}
{{--            </div>--}}
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection
@section('script_for_search')
    <script type="text/javascript">
        // search for Categories
        $(document).ready(function () {
            var img_path = '/imagenes/imagenes_articulos/';
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
                    $.get('get_articles_for_categories',{category_id: category_id}, function (articles) {
                        $('#content').empty();
                        $('#content_hidden').hide();
                        $.each(articles, function (index , value ){
                            $('#content').append("<div class='row'>\n" +
                                "                                <div class='col-4'>\n" +
                                "                                    <img class='rounded mx-auto d-block img-fluid'  src='"+img_path+value[3]+"'>\n" +
                                "                                </div>\n" +
                                "                                <div  class='col-8'>\n" +
                                "                                    <h3>"+value[0]+"</h3>\n" +
                                "                                    <br>\n" +
                                "                                    <div class='row'>\n" +
                                "                                        <div class='col-8'>\n" +
                                "                                            <h4>Price :"+value[1]+"</h4>\n" +
                                "                                            <p>!Compra ahora!!!</p>\n" +
                                "                                        </div>\n" +
                                "                                        <div class='col-4'>\n" +
                                "                                            <h5><b>Maker:</b><br>"+value[2]+" </h5>\n" +
                                "                                        </div>\n" +
                                "                                        <br><br><br>\n" +
                                "                                        <a href='/order/"+index+"/form' class='btn btn-primary float-right'>Añadir al carrito</a>\n" +
                                "                                    </div>\n" +
                                "                                </div>\n" +
                                "                                <a href='/order/"+index+"/form' class='btn btn-primary mt-2'>Ver detalle del producto</a>\n" +
                                "                            </div>\n" +
                                "                            <hr>\n" +
                                "                            <hr>");
                        });
                        // $('#content').append("<div class='card-link'>"+articles.link()+"</div>");

                    }).done();
                }
            });
            // search for sub Categories
            $('#sub_categories').on('change', function () {
                var sub_category_id = $('#sub_categories').val();
                if ($.trim(sub_category_id) != ''){
                    // $('#content').empty();
                    // $('#content').append("<h1>HELLO CONTENT</h1>");
                    $.get('get_articles_for_sub_categories',{sub_category_id: sub_category_id}, function (articles) {
                        $('#content').empty();
                        $('#content_hidden').hide();
                        $.each(articles, function (index , value ){
                            // $('#content').append("<h1>"+value+"</h1>");
                            $('#content').append("<div class='row'>\n" +
                                "                                <div class='col-4'>\n" +
                                "                                    <img class='rounded mx-auto d-block img-fluid'  src='"+img_path+value[3]+"'>\n" +
                                "                                </div>\n" +
                                "                                <div  class='col-8'>\n" +
                                "                                    <h3>"+value[0]+"</h3>\n" +
                                "                                    <br>\n" +
                                "                                    <div class='row'>\n" +
                                "                                        <div class='col-8'>\n" +
                                "                                            <h4>Price :"+value[1]+"</h4>\n" +
                                "                                            <p>!Compra ahora!!!</p>\n" +
                                "                                        </div>\n" +
                                "                                        <div class='col-4'>\n" +
                                "                                            <h5><b>Maker:</b><br>"+value[2]+" </h5>\n" +
                                "                                        </div>\n" +
                                "                                        <br><br><br>\n" +
                                "                                        <a href='/order/"+index+"/form' class='btn btn-primary float-right'>Añadir al carrito</a>\n" +
                                "                                    </div>\n" +
                                "                                </div>\n" +
                                "                                <a href='/order/"+index+"/form' class='btn btn-primary mt-2'>Ver detalle del producto</a>\n" +
                                "                            </div>\n" +
                                "                            <hr>\n" +
                                "                            <hr>");
                        });
                    }).done();
                }
            });
            // search for makers
            $('#makers_search').on('change', function () {
                var maker_id = $('#makers_search').val();
                // search for only makers
                if ($.trim(maker_id) != ''){
                    $.get('get_articles_for_makers',{maker_id: maker_id}, function (articles) {
                        $('#content').empty();
                        $('#content_hidden').hide();
                        $.each(articles, function (index , value ){
                            // $('#content').append("<h1>"+value+"</h1>");
                            $('#content').append("<div class='row'>\n" +
                                "                                <div class='col-4'>\n" +
                                "                                    <img class='rounded mx-auto d-block img-fluid'  src='"+img_path+value[3]+"'>\n" +
                                "                                </div>\n" +
                                "                                <div  class='col-8'>\n" +
                                "                                    <h3>"+value[0]+"</h3>\n" +
                                "                                    <br>\n" +
                                "                                    <div class='row'>\n" +
                                "                                        <div class='col-8'>\n" +
                                "                                            <h4>Price :"+value[1]+"</h4>\n" +
                                "                                            <p>!Compra ahora!!!</p>\n" +
                                "                                        </div>\n" +
                                "                                        <div class='col-4'>\n" +
                                "                                            <h5><b>Maker:</b><br>"+value[2]+" </h5>\n" +
                                "                                        </div>\n" +
                                "                                        <br><br><br>\n" +
                                "                                        <a href='/order/"+index+"/form' class='btn btn-primary float-right'>Añadir al carrito</a>\n" +
                                "                                    </div>\n" +
                                "                                </div>\n" +
                                "                                <a href='/order/"+index+"/form' class='btn btn-primary mt-2'>Ver detalle del producto</a>\n" +
                                "                            </div>\n" +
                                "                            <hr>\n" +
                                "                            <hr>");
                        });
                    }).done();
                }

                // search for makers and sub_categories
                var sub_category_id = $('#sub_categories').val();
                if ($.trim(maker_id) != '' && $.trim(sub_category_id) != ''){
                    $.get('get_articles_for_makers_and_sub_categories',{maker_id: maker_id,sub_category_id: sub_category_id }, function (articles) {
                        $('#content').empty();
                        $('#content_hidden').hide();
                        $.each(articles, function (index , value ){
                            // $('#content').append("<h1>"+value+"</h1>");
                            $('#content').append("<div class='row'>\n" +
                                "                                <div class='col-4'>\n" +
                                "                                    <img class='rounded mx-auto d-block img-fluid'  src='"+img_path+value[3]+"'>\n" +
                                "                                </div>\n" +
                                "                                <div  class='col-8'>\n" +
                                "                                    <h3>"+value[0]+"</h3>\n" +
                                "                                    <br>\n" +
                                "                                    <div class='row'>\n" +
                                "                                        <div class='col-8'>\n" +
                                "                                            <h4>Price :"+value[1]+"</h4>\n" +
                                "                                            <p>!Compra ahora!!!</p>\n" +
                                "                                        </div>\n" +
                                "                                        <div class='col-4'>\n" +
                                "                                            <h5<b>Maker:</b><br>"+value[2]+" </h5>\n" +
                                "                                        </div>\n" +
                                "                                        <br><br><br>\n" +
                                "                                        <a href='/order/"+index+"/form' class='btn btn-primary float-right'>Añadir al carrito</a>\n" +
                                "                                    </div>\n" +
                                "                                </div>\n" +
                                "                                <a href='/order/"+index+"/form' class='btn btn-primary mt-2'>Ver detalle del producto</a>\n" +
                                "                            </div>\n" +
                                "                            <hr>\n" +
                                "                            <hr>");
                        });
                    }).done();
                }
            });
        });
    </script>
{{--    search for input--}}
    <script type="text/javascript">
        $(document).ready(function () {
            var img_path = '/imagenes/imagenes_articulos/';
            $('#search_article').on('keyup', function () {
                var text = $('#search_article').val();
                if ($.trim(text) != ''){
                    $.get('get_search_articles',{text: text}, function (articles) {
                        $('#content').empty();
                        $('#content_hidden').hide();
                        $.each(articles, function (title , value){
                            $('#content').append("<div class='row'>\n" +
                                "                                <div class='col-4'>\n" +
                                "                                    <img class='rounded mx-auto d-block img-fluid'  src='"+img_path+value[1]+"'>\n" +
                                "                                </div>\n" +
                                "                                <div  class='col-8'>\n" +
                                "                                    <h3>"+title+"</h3>\n" +
                                "                                    <br>\n" +
                                "                                    <div class='row'>\n" +
                                "                                        <div class='col-8'>\n" +
                                "                                            <h4>Price :"+value[2]+"</h4>\n" +
                                "                                            <p>!Compra ahora!!!</p>\n" +
                                "                                        </div>\n" +
                                "                                        <div class='col-4'>\n" +
                                "                                            <h5><b>Maker:</b><br>"+value[3]+" </h5>\n" +
                                "                                        </div>\n" +
                                "                                        <br><br><br>\n" +
                                "                                        <a href='/order/"+value[0]+"/form' class='btn btn-primary float-right'>Añadir al carrito</a>\n" +
                                "                                    </div>\n" +
                                "                                </div>\n" +
                                "                                <a href='/order/"+value[0]+"/form' class='btn btn-primary mt-2'>Ver detalle del producto</a>\n" +
                                "                            </div>\n" +
                                "                            <hr>\n" +
                                "                            <hr>"
                            );
                        });
                    })
                }
            });
        });
    </script>
@endsection
