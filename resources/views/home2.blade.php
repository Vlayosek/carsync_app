@extends('layouts.app')

@section('styles')
<style>
    a.disabled {
        pointer-events: none;
        cursor: default;
    }
</style>

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{-- <div class="card-header">{{ __('CarSync') }}</div> --}}

                <div class="card-body">

                    <form method="POST" action="{{ route('home.auth') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="freddy.pincay@tpg.com.ec" required autocomplete="username" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" value="cjlg>42rE*37mn:1qoCAQ=+f" required autocomplete="password" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="realm" class="col-md-4 col-form-label text-md-right">{{ __('Realm') }}</label>
                            <div class="col-md-6">
                                <input id="realm" type="text" class="form-control" name="realm" value="partners" required autocomplete="realm" readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-info">
                                    {{ __('Obtener Token') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('home.sessionpls') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="oscar.roditi@tpg.com.ec" required autocomplete="username" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" value="abc1234" required autocomplete="password" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="subdomain" class="col-md-4 col-form-label text-md-right">{{ __('Subdomain') }}</label>
                            <div class="col-md-6">
                                <input id="subdomain" type="text" class="form-control" name="subdomain" value="fleet" required autocomplete="subdomain" readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-info">
                                    {{ __('Obtener Sesión PLS') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <div class="card">
                <div class="card-body">
                    {{-- @if ($bandera == true)
                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Dispositivos Cargados">
                        <a class="btn btn-info disabled" style="pointer-events: none;" href="{{ route('home.devices') }}">Traer Dispositivos</a>
                    </span>
                   {{--  <a class="btn btn-info disabled" href="{{ route('home.devices') }}">Traer Dispositivos</a>
                    @else
                    <a class="btn btn-info" href="{{ route('home.devices') }}">Traer Dispositivos</a>
                    @endif --}}
                    <a class="btn btn-info" href="{{ route('home.devices') }}">Traer Dispositivos</a>
                    <a class="btn btn-info" href="{{ route('devices.index') }}">Ir a Listado Dispositivos</a>
                    <a class="btn btn-info" href="{{ route('alerts.index') }}">Traer Alertas</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
