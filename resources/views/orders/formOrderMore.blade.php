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

    <!-- Default box -->
    <div class="container">
        <div class="card card-primary card-outline">
            <!-- <form action="{{route('orders.store')}}" method="POST"> -->
            <form action="{{route('storeMoreArticles')}}" method="POST">
                @csrf
                @foreach($articles as $article)
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <input hidden  type="number" name="user_id" value="{{ Auth::user()->id }}">
                                <input hidden  type="number" name="article_id" value="{{ $article->id }}">
{{--                                <h3  class="d-inline-block d-sm-none">{{$article->articulo}}</h3>--}}
                                <h3  class="d-inline-block d-sm-none"><input type="text" name="title" value="{{$article->articulo}}"></h3>
                                <div  class="col-12">
                                    <img src="{{asset('/imagenes/imagenes_articulos/'.$article->image)}}" class="product-image" alt="Product Image">
                                </div>
                                <div class="col-12 product-image-thumbs">
                                    <div class="product-image-thumb active"><img src="../../dist/img/prod-1.jpg" alt="Product Image"></div>
                                    <div class="product-image-thumb" ><img src="../../dist/img/prod-2.jpg" alt="Product Image"></div>
                                    <div class="product-image-thumb" ><img src="../../dist/img/prod-3.jpg" alt="Product Image"></div>
                                    <div class="product-image-thumb" ><img src="../../dist/img/prod-4.jpg" alt="Product Image"></div>
                                    <div class="product-image-thumb" ><img src="../../dist/img/prod-5.jpg" alt="Product Image"></div>
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
                                        <button class="btn btn-primary">Add to Cart</button>
                                        <input hidden type="number" name="order_id" value="{{$orders[0]->order_id}}">
                                    </div>
{{--                                    <div class="swalDefaultError">--}}
{{--                                        content json--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                @endforeach
            </form>
        </div>
    </div>
    <br>
    <!-- /.card -->
@endsection
@section('script_cities')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#cities').on('change',function () {
                var city_id = $('#cities').val();
                if ($.trim(city_id) != ''){
                    $.get('/get_transport_fares',{city_id: city_id}, function (transport_fares) {
                        $('#transport_fare').empty();
                        // $('#transport_fare').append("<option value=''>Selecione una sub categoria</option>");
                        $.each(transport_fares, function (index , value){
                            $('#transport_fare').append("<option selected='selected' value='"+index+"'>"+value+"</option>");
                        }).done();
                    });
                }
            });
        });
    </script>
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
@section('alert_validations')
    <script type="text/javascript">
        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000
            });
            // if exist some errors
            var msg = '{{\Illuminate\Support\Facades\Session::get('alert')}}';
            var exist = '{{\Illuminate\Support\Facades\Session::has('alert')}}';
            if (exist){
                Toast.fire({
                    type: 'error',
                    title: msg
                })
            }

            $('.swalDefaultSuccess').click(function() {
                Toast.fire({
                    type: 'success',
                    title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                })
            });
            $('.swalDefaultInfo').click(function() {
                Toast.fire({
                    type: 'info',
                    title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                })
            });
            // $('.swalDefaultError').click(function() {
            //     Toast.fire({
            //         type: 'error',
            //         title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            //     })
            // });
            $('.swalDefaultWarning').click(function() {
                Toast.fire({
                    type: 'warning',
                    title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                })
            });
            $('.swalDefaultQuestion').click(function() {
                Toast.fire({
                    type: 'question',
                    title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                })
            });
        });
    </script>

@endsection
