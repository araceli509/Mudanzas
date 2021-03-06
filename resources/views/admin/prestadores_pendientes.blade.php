@extends('layouts.master')

<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">

@section('title')
    SOLICITUDES PENDIENTES
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Solicitudes pendientes</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
                <thead class=" text-primary">
                    <th>
                      Id
                    </th>
                    <th>
                      Nombre(s)
                    </th>
                    <th>
                      Apellidos
                    </th>
                    <th>
                        Direccion
                    </th>
                    <th>
                        Telefono
                    </th>
                    <th>
                       Correo
                    </th>
                    
                    <th>
                        Detalles
                     </th>
                  </thead>
                  <tbody>
                      @foreach ($prestador as $p)
                      <tr id="{{$p->id_prestador}}">
                            <td>{{$p->id_prestador}}</td>
                            <td>{{$p->nombre}}</td>
                            <td>{{$p->apellidos}}</td>
                            <td>{{$p->direccion}}</td>
                            <td>{{$p->telefono}}</td>
                            <td>{{$p->correo}}</td>
                            <td align="center"><a href="/prestador/detalles/{{$p->id_prestador}}" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a></td>
                        </tr>  
                      @endforeach 
                  </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
    
@endsection