@extends('layouts.client.app')
@section('content')
    <!-- Default box -->
    <div class="container">
        <div class="card card-primary card-outline">
            <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- Box Comment -->
                    <div class="card card-widget">
                        <div class="card-header">
                            <div class="user-block">
{{--                                <img class="img-circle" src="{{asset("/admin-lte/dist/img/user1-128x128.jpg")}}" alt="User Image">--}}
                                <span class="username"><a href="#">Raiting:</a></span>
                                <span class="description">
{{--                                    @foreach($comentarios as $comentario)--}}
                                        @if($comentarios[0]->raiting == 5)
                                            <img src="{{asset('/stars/5stars.jpg')}}" style="width: 110px;height: 19px;">
                                        @endif
                                        @if($comentarios[0]->raiting == 4)
                                            <img src="{{asset('/stars/4stars.jpg')}}" style="width: 110px;height: 19px;">
                                        @endif
                                        @if($comentarios[0]->raiting == 3)
                                            <img src="{{asset('/stars/3stars.jpg')}}" style="width: 110px;height: 19px;">
                                        @endif
                                        @if($comentarios[0]->raiting == 2)
                                            <img src="{{asset('/stars/2stars.jpg')}}" style="width: 110px;height: 19px;">
                                        @endif
                                        @if($comentarios[0]->raiting == 1)
                                            <img src="{{asset('/stars/1stars.jpg')}}" style="width: 110px;height: 19px;">
                                        @endif
{{--                                    @endforeach--}}
                                </span>
                            </div>
                            <!-- /.user-block -->
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            <!-- Attachment -->
                            <div class="attachment-block clearfix">
                                <img class="attachment-img" src="{{asset('/imagenes/imagenes_articulos/'.$comentarios[0]->imagen)}}" alt="Attachment Image">

                                <div class="attachment-pushed">
                                    <h4 class="attachment-heading"><a href="http://www.lipsum.com/">{{$comentarios[0]->article}}</a></h4>

                                    <div class="attachment-text">
{{--                                        {{$comentarios[0]->description}}... <a href="#">more</a>--}}
                                        {{\Illuminate\Support\Str::limit($comentarios[0]->description,28,'')}}
                                        {{--                                        <div id="collapse" style="display:none">--}}
                                        <p id="collapse" style="display:none">{{\Illuminate\Support\Str::substr($comentarios[0]->description,28,1000)}}</p>
                                        {{--                                        </div>--}}
                                        <a href="#collapse" class="nav-toggle">Read More</a>
                                    </div>
                                    <!-- /.attachment-text -->
                                </div>
                                <!-- /.attachment-pushed -->
                            </div>
                            <!-- /.attachment-block -->
                            <div class="row">
                                <div class="col-10">
                                    <nav class="w-100">
                                        <div class="nav nav-tabs" id="product-tab" role="tablist">
                                            <a class="nav-item nav-link" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true"></a>
                                        </div>
                                    </nav>
                                </div>
                                <div class="col-2">
                                    <nav class="w-100">
                                        <div class="nav nav-tabs float-right">
{{--                                            @if($comentarios[0]->raiting == 5)--}}
{{--                                                <span class="text-muted ">{{$raitings[0]->cantidadCliente}}&ensp;&ensp; Comentarios </span>--}}
{{--                                            @endif--}}
                                            <span class="text-muted ">&ensp;&ensp; Comentarios </span>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer card-comments" style="display: block;">
                            <div class="card-comment">
                                @foreach($comentarios as $comentario)
                                    <!-- User image -->
                                    <img class="img-circle img-sm" src="{{asset("/admin-lte/dist/img/user3-128x128.jpg")}}" alt="User Image">

                                    <div class="comment-text">
                                    <span class="username">
                                        {{$comentario->cliente}}
{{--                                      <span class="text-muted float-right">8:03 PM Today</span>--}}
                                        <span class="text-muted float-right">{{$comentario->fecha}}</span>
                                    </span>
                                        <!-- /.username -->
                                            {{\Illuminate\Support\Str::limit($comentario->cometario,50,'')}}
{{--                                        <div id="collapse" style="display:none">--}}
                                            <p id="collapse" style="display:none">{{\Illuminate\Support\Str::substr($comentario->cometario,253,1000)}}</p>
{{--                                        </div>--}}
                                            <a href="#collapse" class="nav-toggle">Read More</a>
                                        <hr>
                                    </div>
                                    <!-- /.comment-text -->
                                 @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

        </div>
    </div>
    <br>
    <!-- /.card -->
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
