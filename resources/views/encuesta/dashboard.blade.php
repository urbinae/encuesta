@extends('layouts.app2')

 
@section('content')
    
 
    <div class="panel panel-default">
        
        @if ($mensaje != "")
            {{-- <h2>{{$mensaje}}</h2> --}}
        @endif
        <div class="panel-body">
            <div class="form-group">
                <div class="pull-left" style="margin-bottom: 20px;">
                    <a href="" class="btn btn-info" data-toggle="modal" data-target="#myModalCrear">Crear Encuesta</a>
                </div>
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
                                <td><a class="" href="{{ route('encuesta.show',$encuesta->id) }}" data-nombre="{{$encuesta->nombre}}">{{ $encuesta->nombre }}</a></td>
                                <td>0</td>
                                <td>0</td>
                                
                                <td>
                                    <a class="btn btn-info" href="{{ route('pregunta.show',$encuesta->id) }}" title="Preguntas"><i class="mdi mdi-format-list-bulleted"></i></a>
                                    <a class="btn btn-primary editar" href="#" title="Editar" data-nombre="{{$encuesta->nombre}}" data-id="{{$encuesta->id}}"><i class="mdi mdi-table-edit"></i></a>
                                    {{ Form::open(['method' => 'DELETE','route' => ['encuesta.destroy', $encuesta->id],'style'=>'display:inline']) }}
                                    <button type="submit" value="Submit" class="btn btn-danger" title="Eliminar"><i class="mdi mdi-delete-forever"></i></button>
                                    {{ Form::close() }}
                                </td>
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
                    <h4 class="modal-title">Crear Encuesta</h4>
                </div>
                {{ Form::open(array('route' => 'encuesta.store', 'method' => 'post')) }}
                <div class="modal-body" id="contentBody">
                    
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        {{ Form::text('nombre', '', array('id' => 'encuestaNombre', 'class' => 'form-control input-sm', 'placeholder' => 'Nombre de la encuesta')) }}
                    </div>
                    
                    
                    <hr>
                    
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
                    <h4 class="modal-title">Editar Encuesta</h4>
                </div>
                <form action="{{ route('encuesta.update','XXX') }}" method = 'put' id="formEditar">
                {{@csrf}}
                <div class="modal-body" id="contentBody">
                    
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control input-sm"/>
                    </div>                    
                    <hr>
                    
                </div>
                <div class="modal-footer">
                    
                    <button type="submit" class="btn btn-info" data-dismiss="modal" id="botonEditar">Guardar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
                </form>
            </div>

        </div>
    </div>
 
@endsection