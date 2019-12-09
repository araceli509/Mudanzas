@extends('layouts.master')

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
                      <tr id="{{$p->id}}">
                            <td>{{$p->id}}</td>
                            <td>{{$p->nombre}}</td>
                            <td>{{$p->apellidos}}</td>
                            <td>{{$p->direccion}}</td>
                            <td>{{$p->telefono}}</td>
                            <td>{{$p->correo}}</td>
                            <td><a href="#" class="view" title="View Details" data-toggle="tooltip"><i class="material-icons">&#xE5C8;</i></a></td>
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