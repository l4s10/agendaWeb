@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <p>
                        Tu nombre es: {{auth()->user()->name}} <br>
                        Tu correo es: {{auth()->user()->email}} <br>
                        Tu depto es: {{auth()->user()->depto}} <br>
                    </p>
                    @role('administrador')
                    <p>texto solo para admins B=)</p>
                    @endrole
                    @can('ver boton')
                        <button class="btn btn-primary">Boton Gracioso!</button>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
