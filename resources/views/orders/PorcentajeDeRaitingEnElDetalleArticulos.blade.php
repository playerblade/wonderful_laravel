


<!-- inicio del modal-------------------------------------------------------------- -->
<div class="modal fade" id="modal-xl">
                        <div class="modal-dialog modal-ml">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Evaluación del Articulo</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('comentaries.store') }}" method="POST">
                                    @csrf

                                    <div class="modal-body">
                                        <input hidden type="number" name="user_id" value="{{Auth::user()->id}}">
                                        <strong>Raiting</strong>
                                        <p class="clasificacion">
                                            <input id="radio1" type="radio" name="estrellas" value="5">
                                            <label class="labelTamanio" for="radio1">★</label>
                                            <input id="radio2" type="radio" name="estrellas" value="4">
                                            <label class="labelTamanio" for="radio2">★</label>
                                            <input id="radio3" type="radio" name="estrellas" value="3">
                                            <label class="labelTamanio" for="radio3">★</label>
                                            <input id="radio4" type="radio" name="estrellas" value="2">
                                            <label class="labelTamanio" for="radio4">★</label>
                                            <input id="radio5" type="radio" name="estrellas" value="1">
                                            <label class="labelTamanio" for="radio5">★</label>
                                        </p>
                                        <p>
                                            <strong>Comentario</strong>
                                            <textarea name="comment" id="" cols="10" rows="5" class="form-control" placeholder="Cuenta lo que te parecio el producto. ¿Qué recomiendas? ¿Por qué?"></textarea>
                                        </p>

                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button  class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button  class="btn btn-primary">Evaluar Producto</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
    <!-- fin del modal-------------------------------------------------------------- -->


<!-- ------------------------------Del Modal del Porcentaje del raiting--------------------------------------------------- -->
@section('scriptReadMore')
    <script>
        $(document).ready(function () {
            $('.nav-toggle').click(function () {
                var collapse_content_selector = $(this).attr('href');
                var toggle_switch = $(this);
                $(collapse_content_selector).toggle(function () {
                    if ($(this).css('display') == 'none') {
                        toggle_switch.html('Read More');
                    } else {
                        toggle_switch.html('Read Less');
                    }
                });
            });

        });
    </script>
@endsection
<!-- ----------------------------------------------------------------------------------------- -->