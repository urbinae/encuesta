<div class="modal fade" id="edit_respuesta{{$respuesta->id}}" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times</span>
                </button>
                <h4 class="modal-title">Modificar respuesta</h4>
            </div>
            {!! Form::model($respuesta, ['route' => ['respuesta.update', $respuesta->id], 'method'=>'PUT']) !!}
            <div class="modal-body">
                <div class="center">
                    <input type="hidden" value="{{ csrf_token() }}" name="token" id="token" />
                    @include('respuesta.partials.form')
                </div>
            </div>
            <div class="modal-footer">
                {{ Form::submit('Guardar', array('class' => 'btn btn-info')) }}
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
