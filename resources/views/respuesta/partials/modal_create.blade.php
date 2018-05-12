<div id="crear-respuesta" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Crear respuesta</h4>
            </div>
            {{ Form::open(array('route' => 'respuesta.store', 'method' => 'post')) }}
            <div class="modal-body" id="contentBody">

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    {{ Form::text('nombre', '', array('id' => 'respuestaNombre', 'class' => 'form-control input-sm', 'placeholder' => 'Nombre de la respuesta')) }}
                </div>
            </div>
            <div class="modal-footer">
                {{ Form::submit('Guardar', array('class' => 'btn btn-info')) }}
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
            {{ Form::close() }}
        </div>

    </div>
</div>