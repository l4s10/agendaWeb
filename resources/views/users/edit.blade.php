@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header">
                    Editar Usuario
                </div>

                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Correo electrónico:</label>
                            <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" name="password" id="password" class="form-control">
                            <small class="text-muted">Dejar en blanco si no quieres cambiar la contraseña.</small>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Contraseña:</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="depto">Departamento:</label>
                            <input type="text" name="depto" id="depto" value="{{ $user->depto }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="role">Rol:</label>
                            <select name="role" id="role" class="form-control" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
