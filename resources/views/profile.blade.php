@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Perfil') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Formulario para cambiar la contraseña -->
                    <form method="POST" action="{{ route('profile.changePassword') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="current_password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña Actual') }}</label>

                            <div class="col-md-6">
                                <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required>

                                @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="new_password" class="col-md-4 col-form-label text-md-end">{{ __('Nueva Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required>

                                @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Nueva Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Cambiar Contraseña') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <hr>

                    <!-- Formulario para cambiar el correo electrónico -->
                    <form method="POST" action="{{ route('profile.changeEmail') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="new_email" class="col-md-4 col-form-label text-md-end">{{ __('Nuevo Correo Electrónico') }}</label>

                            <div class="col-md-6">
                                <input id="new_email" type="email" class="form-control @error('new_email') is-invalid @enderror" name="new_email" required>

                                @error('new_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Cambiar Correo Electrónico') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <hr>

                    <!-- Formulario para cambiar el nombre de usuario -->
                    <form method="POST" action="{{ route('profile.changeUsername') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="new_username" class="col-md-4 col-form-label text-md-end">{{ __('Nuevo Nombre de Usuario') }}</label>

                            <div class="col-md-6">
                                <input id="new_username" type="text" class="form-control @error('new_username') is-invalid @enderror" name="new_username" required>

                                @error('new_username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Cambiar Nombre de Usuario') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection