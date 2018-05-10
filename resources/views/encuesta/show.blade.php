@extends('layouts.app2')
 
@section('nombreEncuesta')
{{$encuesta->nombre}}
@endsection

 
@section('content')
<?php $letras = array('A','B','C','D') ?>    
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <div class="panel panel-default">
                
                @if ($mensaje != "")
                    {{-- <h2>{{$mensaje}}</h2> --}}
                @endif
                <div class="panel-body">
                    <div class="form-group">
                        <div class="pull-left" style="margin-bottom: 20px;">
                            <a href="" class="btn btn-info" data-toggle="modal" data-target="#myModalCrear">Crear pregunta</a>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-hover" id="preguntas-table">
                        <thead>
                            <tr>
                                <th width="20">Activa</th>
                                <th>Nombre</th>
                                <th>tiempo</th>
                                <th width="150">Participantes</th>
                                <th width="200">Acciones</th>
                            </tr>
                        </thead>
                    <tbody>
                        @if ($preguntas != null)
                            @foreach ($preguntas as $key => $pregunta)
                                <tr>
                                    <td><center>
                                        <div class="switch">
                                            <label>
                                                <input type="checkbox" @if ($pregunta->habilitada == 1 ) checked @endif><span class="lever"></span></label>
                                        </div>
                                        
                                    </center></td>
                                    <td><div class="dblclick" id="{{ $pregunta->id }}" data-id="{{ $pregunta->id }}">{{ $pregunta->descripcion }}</div></td>
                                    <td>{{ $pregunta->tiempo }} seg</td>
                                    <td>{{ count($pregunta->participantes) }}</td>
                                    
                                    <td>
                                        {{ Form::open(['method' => 'DELETE','route' => ['pregunta.destroy', $pregunta->id],'style'=>'display:inline']) }}
                                        {{ Form::hidden('idEncuesta', $encuesta->id, array('id' => 'idEncuesta')) }}
                                        <button type="submit" value="Submit" class="btn btn-danger btn-circle" title="Eliminar"><i class="mdi mdi-delete-forever"></i></button>
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                    <div class="row">
                                    @if ($respuestas != null)
                                        @foreach ($letras as $key => $letra)
                                            <div class="col-xs-12 col-sm-3 text-center" >
                                            <span style="padding-right:10px;">{{$letra}}</span>
                                            <select class="select-resp">
                                                @foreach ($respuestas as $key => $respuesta)
                                                    
                                                         <option value="{{$respuesta->id}}">{{$respuesta->nombre}}</option>
                                                    
                                                @endforeach
                                            </select>
                                            </div>
                                        @endforeach
                                    @else
                                        <div>no existen repuestas registras</div>
                                    @endif
                                        {{-- <div class="col-xs-12 col-sm-3 text-center" >
                                            <div class=""><span style="padding-right:10px;">A</span> <select><option>si</option></select></div>
                                        </div>
                                        <div class="col-xs-12 col-sm-3 text-center" >
                                            <span style="padding-right:10px;">B</span> <select><option>no</option></select>
                                        </div>
                                        <div class="col-xs-12 col-sm-3 text-center" >
                                            <span style="padding-right:10px;">C</span> <select><option>no se</option></select>
                                        </div>
                                        <div class="col-xs-12 col-sm-3 text-center" >
                                            <span style="padding-right:10px;">D</span> <select><option>tal vez</option></select>
                                        </div>
                                    </div> --}}
                                </tr>
                                <tr>
                                    <td colspan="5"> <hr></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">Tasks not found!</td>
                            </tr>
                        @endif
                        </tbody>
                    
                    </table>
        
                </div>
            </div>
            <!-- Modal -->
            <div id="myModalMensaje" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Mensaje</h4>
                        </div>
                        <div class="modal-body" id="contentBody">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Modal Crear-->
            <div id="myModalCrear" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Crear preguntas</h4>
                        </div>
                        {{ Form::open(array('route' => 'pregunta.store', 'method' => 'post')) }}
                        <div class="modal-body" id="contentBody">
                            {{ Form::hidden('idEncuesta', $encuesta->id, array('id' => 'idEncuesta')) }}
                            <div class="form-group row">
                                <label for="nombre" class="col-md-2 col-form-label">Pregunta</label>
                                <div class="col-md-10">
                                {{ Form::text('nombre', '', array('id' => 'nombre', 'class' => 'form-control input-sm', 'placeholder' => 'Descripción de la pregunta')) }}
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="tiempo" class="col-md-2 col-form-label">Tiempo</label>
                                <div class="col-md-10">
                                    {{ Form::number('tiempo', '0', array('id' => 'tiempo', 'class' => 'form-control')) }}
                                </div>
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

            <!-- Modal Editar-->
            <div id="myModalEditar" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Editar preguntas</h4>
                        </div>
                        <form action="{{ route('pregunta.update','XXX') }}" method = 'put' id="formEditar">
                        {{@csrf}}
                        <div class="modal-body" id="contentBody">
                            
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control input-sm"/>
                            </div>                    
                            <div class="form-group row">
                                <label for="example-number-input" class="col-md-2 col-form-label">Tiempo</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="tiempo" value="42" id="tiempo-preg">
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            
                            <button type="submit" class="btn btn-info" data-dismiss="modal" id="botonEditar">Guardar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
 
@stop
@section('codigo_js')
<script>
$(document).ready( function () {
    var id= 0;
    var url ="";
    var mensaje = "{{$mensaje}}"
    if(mensaje != ""){
        //alert("{{$mensaje}}")

        $("#contentBody").html("{{$mensaje}}");
        $("#myModalMensaje").modal('show');
    }
     

    $(".check").click(function(e){
        //e.preventDefault();
        idCheck= $(this).data('id');
        descripcion = $(this).data('descripcion');

        url = "{{ route('pregunta.edit','XXYYZZ') }}";
        url = url.replace('XXYYZZ',$(this).data('id'));
        //alert(url)
        $.get(url,{
                idEncuesta: "{{ $encuesta->id }}"
            }, function(data, status){
            //alert("Data: " + data + "\nStatus: " + status);
            //if('success' == status)
            //{
            //    $("#contentBody").html("Ahora esta activa la pregunta <strong>"+descripcion+'</strong>');
            //    $("#myModalMensaje").modal('show');
            //}
        
        });
    });

    $(".dblclick").dblclick(function(e){
        e.preventDefault();
        
        id= $(this).data('id');
        url = "{{ route('pregunta.update','XXYY') }}";
       
        url = url.replace('XXYY',$(this).data('id'));
        //alert($(this).data('value'));
    }); 

    $(".dblclick").editable(url, { 
      //indicator : "<img src='img/indicator.gif'>",
        tooltip   : "Doubleclick to edit...",
        //data : "{'value':'valor'}",
        method : 'PUT',
        event     : "dblclick",
      //style  : "inherit"
  });
});
</script>
@endsection