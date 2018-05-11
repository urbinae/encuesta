@extends('layouts.app2')
 
@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
 
    <div class="panel panel-default">
        
        @if ($mensaje != "")
            {{-- <h2>{{$mensaje}}</h2> --}}
        @endif
        <div class="panel-body">
            <div class="form-group">
                <div class="pull-left" style="margin-bottom: 20px;">
                    <a href="" class="btn btn-info" data-toggle="modal" data-target="#crear-encuesta">Crear Encuesta</a>
                </div>
                @include('encuesta.partials.modal_create')
            </div>
 
            <table class="table table-bordered table-stripped" id="encuestas-table">
                <thead>
                    <tr>
                        <th width="20">No</th>
                        <th>Nombre</th>
                        <th width="150">N° de preguntas</th>
                        <th width="100">Participantes</th>
                        <th width="200">Acciones</th>
                    </tr>
                </thead>
               <tbody>
                @if (count($encuestas) > 0)
                        @foreach ($encuestas as $key => $encuesta)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $encuesta->nombre }}</td>
                                @if(count($encuesta->preguntas) >0)
                                    <td>{{ count($encuesta->preguntas) }}</td>
                                @else
                                    <td>0</td>
                                @endif
                                @if(count($encuesta->participantes) > 0)
                                    <td>{{ count($encuesta->participantes) }}</td>
                                @else
                                    <td>0</td>
                                @endif
                                
                                <td>
                                    <a class="btn btn-info" href="{{ route('encuestas.show',$encuesta->id) }}" title="Preguntas"><i class="mdi mdi-format-list-bulleted"></i></a>
                                   
                                    <button value="{{$encuesta->id}}" data-toggle="modal" data-target="#edit_encuesta{{$encuesta->id}}" class="btn btn-warning">
                                            <i class="mdi mdi-table-edit"></i>
                                    </button>
                                    @include('encuesta.partials.modal_edit')
                                    <button value="{{$encuesta->id}}" data-toggle="modal" data-target="#delete_encuesta{{$encuesta->id}}" class="btn btn-danger">
                                            <i class="mdi mdi-delete-forever"></i>
                                    </button>
                                    @include('encuesta.partials.modal_delete')
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">No hay encuestas registradas</td>
                        </tr>
                    @endif
                </tbody>
            
            </table>
 
        </div>
    </div>
   
@stop
@section('codigo_js')
<script>
$(document).ready( function () {
    var mensaje = "{{$mensaje}}"
    if(mensaje != ""){
        //alert("{{$mensaje}}")

        //$("#contentBody").html("{{$mensaje}}");
        //$("#myModalMensaje").modal('show');
    }

    $('.editar').click(function(e) {
        e.preventDefault();
        //alert($('#formEditar').attr('action'))
        var newUrl = "{{ route('encuestas.update','newEdit') }}";
       
        newUrl = newUrl.replace('newEdit',$(this).data('id'));

        $('#nombre').val($(this).data('nombre'))
        
        //alert($(this).data('id'))
        $('#formEditar').attr('action',newUrl)
        //alert($('#formEditar').attr('action'))

        $("#myModalEditar").modal('show');

    });


    $('#botonEditar').click(function(e) {
        e.preventDefault();
        //$("#formEditar").submit();
    });
   


    $('#encuestas-table').DataTable({
        processing: true,
        language: {
            "sProcessing":     "<b>Procesando...</b>",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron coincidencias",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "<b>Total de registros: _TOTAL_</b> ",
            "sInfoEmpty":      "0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "<b>Buscar:</b>",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
        //serverSide: true,
       /* ajax: '{!! route('indexDataTable') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nombre', name: 'nombre' },
            { data: 'user_id', name: 'user_id' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' }
        ]*/
        }
    });
});
</script>
@endsection