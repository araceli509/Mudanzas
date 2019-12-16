@extends('layouts.master')

<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
@section('title')
    SOLICITUDES PENDIENTES
@endsection

@section('content')

<br>
<br>
<br>
<button type="button" class="btn btn-secondary btn-lg btn-block">Fotos Personales</button>
<div class="card-group">
    <div class="card">
      <img src="https://res.cloudinary.com/ito/c_scale,h_3171/foto_perfil/{{$prestador->foto_perfil}}" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Foto de perfil</h5>
        <p class="card-text"></p>
      </div>
      <div class="card-footer">
        <small class="text-muted">Last updated 3 mins ago</small>
      </div>
    </div>
    <div class="card">
      <img src="https://res.cloudinary.com/ito/ine/{{$documentos->ine}}" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Credencial de elector</h5>
        <p class="card-text"></p>
      </div>
      <div class="card-footer">
        <small class="text-muted">Last updated 3 mins ago</small>
      </div>
    </div>
  </div>

  <button type="button" class="btn btn-secondary btn-lg btn-block">Permisos</button>
  <div class="card-group">
    <div class="card">
      <img src="https://res.cloudinary.com/ito/c_scale,h_3171/tarjeta_circulacion/{{$documentos->tarjeta_circulacion}}" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Tarjeta de Circulacion</h5>
        <p class="card-text"></p>
      </div>
      <div class="card-footer">
        <small class="text-muted">Last updated 3 mins ago</small>
      </div>
    </div>
    <div class="card">
        <img src="https://res.cloudinary.com/ito/licencia_conducir/{{$documentos->licencia_vigente}}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Licencia de conducir vigente</h5>
          <p class="card-text"></p>
        </div>
        <div class="card-footer">
          <small class="text-muted">Last updated 3 mins ago</small>
        </div>
      </div>
  </div>

  <button type="button" class="btn btn-secondary btn-lg btn-block">Datos del Vehiculo</button>

  <div class="card-group">
    <div class="card">
      <img src="https://res.cloudinary.com/ito/c_scale,h_3171/foto_frontal/{{$vehiculo->foto_frontal}}" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Foto Frontal</h5>
        <p class="card-text"></p>
      </div>
      <div class="card-footer">
        <small class="text-muted">Last updated 3 mins ago</small>
      </div>
    </div>
    <div class="card">
        <img src="https://res.cloudinary.com/ito/foto_lateral/{{$vehiculo->foto_lateral}}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Foto Lateral</h5>
          <p class="card-text"></p>
        </div>
        <div class="card-footer">
          <small class="text-muted">Last updated 3 mins ago</small>
        </div>
      </div>

      <div class="card">
        <img src="https://res.cloudinary.com/ito/foto_trasera/{{$vehiculo->foto_trasera}}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Foto Trasera</h5>
          <p class="card-text"></p>
        </div>
        <div class="card-footer">
          <small class="text-muted">Last updated 3 mins ago</small>
        </div>
      </div>
  </div>

  <br>
  <br>
  <br>
  <br>
  <br>

  <form action="{{ url('/prestador/actualizar/'.$prestador->id_prestador) }}" method="post">

    @csrf

    <input type="hidden" name="id" value="{{ $prestador->id_prestador}}">

           <input type="submit" class="btn btn-success" name="act" value="Aprobar">
    </form>
@endsection

@section('scripts')
    
@endsection
