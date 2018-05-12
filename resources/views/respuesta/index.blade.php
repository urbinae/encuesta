@extends('layouts.app2')


@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <div class="pull-left" style="margin-bottom: 20px;">
                    <a href="" class="btn btn-info" data-toggle="modal" data-target="#crear-respuesta">Crear respuesta</a>
                </div>
            </div>
            @include('respuesta.partials.modal_create')
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="20">No</th>
                            <th>Descripcion</th>
                            <th width="200">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                       @if (count($respuestas) > 0)
                       @foreach ($respuestas as $key => $respuesta)
                       <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $respuesta->nombre }}</td>

                        <td>
                            <button value="{{$respuesta->id}}" data-toggle="modal" data-target="#edit_respuesta{{$respuesta->id}}" class="btn btn-warning">
                                <i class="mdi mdi-table-edit"></i>
                            </button>
                            @include('respuesta.partials.modal_edit')

                            <button value="{{$respuesta->id}}" data-toggle="modal" data-target="#delete_respuesta{{$respuesta->id}}" class="btn btn-danger">
                                <i class="mdi mdi-delete-forever"></i>
                            </button>
                            @include('respuesta.partials.modal_delete')
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="4">No Hay registros</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

@endsection