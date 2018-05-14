<div class="modal fade" id="delete_respuesta{{$respuesta->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		{!! Form::open(['route' => ['respuesta.destroy', $respuesta->id], 'method'=>'DELETE']) !!}
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true">&times</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="center">
					<input type="hidden" value="{{ csrf_token() }}" name="token" id="token" />
					<input type="hidden" value="id" />
					{{ Form::hidden('idEncuesta', $respuesta->id, array('id' => 'idEncuesta')) }}
					<h4>¿Desea eliminar la respuesta {{$respuesta->nombre}}?</h4>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-"></span> Cancelar</button>

				<button type="submit" class="btn btn-success pull-rigth"><span class="glyphicon glyphicon-"></span> Eliminar</button>
			</div>
		{!! Form::close() !!}
		</div>
	</div>
</div>