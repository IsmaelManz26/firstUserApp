@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if(Auth::check())
                        Hola {{ Auth::user()->name }}! Bienvenido a tu dashboard.
                    @else
                        Hola Invitado! Bienvenido a tu dashboard.
                    @endif
                </div>

                <div class="card-body">
                    @guest
                        <a href="{{ url('login') }}">Login</a>
                        <br>
                    @endguest
                    <a href="{{ route('verificado') }}">Verificado</a>
                    <br>
                    <a href="{{ route('home') }}">Logueado</a>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection