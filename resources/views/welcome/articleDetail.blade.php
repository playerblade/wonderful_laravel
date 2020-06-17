@extends('welcome.app')
@section('content')
    <!-- Default box -->
    <div class="container">
        <div class="card card-primary card-outline">
            @foreach($articles as $article)
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
{{--                            <input hidden  type="number" name="user_id" value="{{ Auth::user()->id }}">--}}
                            <input hidden  type="number" name="article_id" value="{{ $article->id }}">
                            <h3  class="d-inline-block d-sm-none"><input type="text" name="title" value="{{$article->articulo}}"></h3>
                            <div  class="col-12">
                                <img src="{{asset('/imagenes/imagenes_articulos/'.$article->image)}}" class="product-image" alt="Product Image">
                            </div>
                            <div class="col-12 product-image-thumbs">
                                <a href="{{ route('articles.show',$article->id) }}" data-toggle="modal" data-target="#modal-article-img{{$article->id}}"
                                   class="btn btn-sm bg-gradient-primary btn-block">
                                    Ver ma imagnes
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <h3 class="my-3">{{$article->articulo}}</h3>
                            <h5><b>Fabricante: </b>{{$article->fabricante}}.</h5>
                            @foreach ($stocks as $stock)
                                <h5><b>Stock: </b>{{$stock->stock}}.</h5>
                                <input hidden type="number" name="stocks" value="{{$stock->stock}}">
                            @endforeach
                            <p><b>Description: </b>{{$article->description}}.</p>
                            <h4>Available Colors</h4>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                @foreach($colors as $color)
                                    <label class="btn btn-default text-center active">
                                        @if($color->quantity >= 1)
                                            <div class="ribbon-wrapper">
                                                <div class="ribbon bg-success text-small">
                                                    Available
                                                </div>
                                            </div>
                                        @else
                                            <div class="ribbon-wrapper">
                                                <div class="ribbon bg-danger text-small">
                                                    Exhausted
                                                </div>
                                            </div>
                                        @endif
                                        <input type="radio" name="color_option" id="color_option1" autocomplete="off" checked="">
                                        {{$color->name}}
                                        <br>
                                        <img class="img-circle fa-2x" style="width: 35px; height: 35px;" src="{{asset('/imagenes/imagenes_articulos/'.$color->image)}}" alt="">
                                        <br> Cant.: {{$color->quantity}}
                                    </label>

                                @endforeach
                            </div>
                            {{--                                <form action="">--}}
                            <div class="row mt-2">
                                <div class="col-6">
                                    <h4>Escoge un Color</h4>
                                    <div class="select2-purple">
                                        <select id="color" class="select2" name="color_article[]"   multiple="multiple" data-placeholder="Select a Color" data-dropdown-css-class="select2-purple" style="width: 100%;" required>
                                            @foreach ($colors as $color)
                                                <option value="{{$color->image}}">
                                                    {{ $color->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="cant"></div>
                                </div>
                                <div id="cantidad" class="col-6">
                                    <h4>Cantidad</h4>
                                    <input type="number" name="quantity" class="form-control" required>
                                </div>
                                <div  class="col-6">
                                    {{--                                            space--}}
                                </div>
                            </div>
                            {{--                                </form>--}}
                            <div class="bg-gray py-2 px-3 mt-4">
                                @foreach($prices as $price )
                                    @if($price->is_current == 1)
                                        <h2 class="mb-0">
                                            ${{$price->price}}
                                        </h2>
                                        <input hidden type="number" name="price_article_id" value="{{$price->id}}">
                                        <input hidden type="number" name="price" value="{{$price->price}}">
                                    @endif
                                    @if($price->is_current == 0)
                                        <h4 class="mt-0">
                                            <small>Ex Tax: <strike>${{$price->price}}</strike> </small>
                                        </h4>
                                    @endif
                                @endforeach
                            </div>

                            <div class="mt-4">
                                <div class="btn btn-primary btn-lg btn-flat">
                                    <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                    <a href="/login" class="btn btn-primary">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            @endforeach
        </div>
    </div>
    <br>
    <!-- /.card -->

    {{--       modal start image --}}
    @foreach($articles as $article)
        <div class="modal fade" id="modal-article-img{{$article->id}}">
            <div class="modal-dialog modal-xl">
                <div class="modal-content card-purple card-outline">
                    <div class="modal-header">
                        <h4 class="modal-title">Imagenes Articulos</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row" >
                            @foreach($images_articles as $image)
                                @if($image->article_id == $article->id)
                                    <div class="col-3">
                                        @if($image->is_main == 1)
                                            <div class="card bg-light">
                                                <div class="ribbon-wrapper ribbon-lg">
                                                    <div class="ribbon bg-success text-sm">
                                                        Principal
                                                    </div>
                                                </div>
                                                <img class="img-fluid mb-2" src="{{asset('/imagenes/imagenes_articulos/'.$image->url_image)}}">
                                            </div>
                                        @else
                                            <div class="card bg-light">
                                                <div class="ribbon-wrapper ribbon-lg">
                                                    <div class="ribbon bg-info text-sm">
                                                        Secundario
                                                    </div>
                                                </div>
                                                <img class="img-fluid mb-2" src="{{asset('/imagenes/imagenes_articulos/'.$image->url_image)}}">
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button  class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    @endforeach
    {{--   modal end image--}}
@endsection
@section('script_color_form')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#color').on('change',function () {
                var color = $('#color').val();
                if ($.trim(color.length) > 1){
                    $('#cantidad').hide();
                    console.log($.trim(color.length));
                }
            });
        });
    </script>
@endsection
