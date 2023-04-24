@extends('layouts.app')
@section('content')
    <div class="container">
        @foreach ($usuarios as $usuario)
        <div class="card">
            <div class="card-header">Tarjeta de usuario N°{{$usuario->id}}</div>
            <div class="card-body">
                <p>Nombre: {{$usuario->name}}</p>
                <p>Email: {{$usuario->email}}</p>
                <p>Depto: {{$usuario->depto}}</p>
                <p>Rol: {{$usuario->getRoleNames()->implode(', ')}}</p>
            </div>
            <div class="card-footer">
                <a class="btn btn-secondary" href="{{route('users.edit',$usuario->id)}}">Editar</a>
                <a class="btn btn-danger" href="{{route('users.destroy',$usuario)}}">Eliminar</a>
            </div>
        </div>
        @endforeach
    </div>
@endsection
