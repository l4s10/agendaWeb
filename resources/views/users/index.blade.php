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
                <a class="btn btn-secondary" href="{{route('users.edit', $usuario->id)}}">Editar</a>
                <form action="{{route('users.destroy', $usuario->id)}}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
@endsection
