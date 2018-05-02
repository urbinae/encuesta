@extends('layouts.app')

 
@section('content')
 
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
 
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Encuestas </h2>
        </div>
        <div class="panel-body">  
            <div id="resultado"><center>     
            
            </center>
            </div>
            
            <table class="table table-bordered table-stripped" id="encuestas-table">
                <thead>
                    <tr>
                        <th width="20">No</th>
                        <th>Nombre</th>
                        <th>N° de preguntas</th>
                    </tr>
                </thead>
               <tbody>
                @if (count($encuestas) > 0)
                        @foreach ($encuestas as $key => $encuesta)
                            <tr>
                                <td>{{ $encuesta->id }}</td>
                                <td><a class="buscar" href="# {{-- {{ route('realizar_encuesta',$encuesta->id) }} --}}" data-id="{{$encuesta->id}}" id="{{$encuesta->id}}">{{ $encuesta->nombre }}</a></td>
                                {{-- <td>{{link_to_route('realizar_encuesta', 'realizar_encuesta')}}</td> --}}
                                <td>0</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">no existe encuestas</td>
                        </tr>
                    @endif
                </tbody>
            
            </table>
 
        </div>
    </div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body" id="contentBody">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>
 
@stop
@section('codigo_js')
<script>
$(document).ready( function () {
    
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

    $('.buscar').click(function() 
    {
        var url = "{{ route('buscarEncuesta','XXX') }}";
        url = url.replace('XXX',$(this).data('id'))

        var urlEncuesta = "{{ route('realizar_encuesta','PPP') }}";
        urlEncuesta = urlEncuesta.replace('PPP',$(this).data('id'))
        var parametros = "";
       
        $.ajax({
                data:  parametros,
                url:   url,
                type:  'get',
                beforeSend: function () {
                    //$("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                    
                    if(response.encontrado > 0)
                    {
                        $("#contentBody").html(response.mensaje);
                        $("#myModal").modal('show');
                    }
                    else{
                        window.location.href = urlEncuesta;
                    }
                    
                }
        });
    });
});
</script>
@endsection
