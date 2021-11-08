@extends('layouts.app')

@section('styles')
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}"> --}}
{{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
 {{-- <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet"> --}}
@endsection

@section('content')
<div class="container-fluid">
    <h2 class="text-center display-4">Criterios de Busqueda</h2>
    <form action="" method="get">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Dispositivo:</label>
                            <select class="form-control" data-placeholder="Imei" style="width: 100%;">
                                <option>Seleccione una opcion</option>
                                @foreach ($devices as $item)
                                    <option value="{{ $item->id_device }}"> {{ $item->imei }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>From</label>
                            <input type="date" name="fecfrom" id="fecfrom" class="form-control">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>to</label>
                            <input type="date" name="fecto" id="fecto" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Page</label>
                            <input type="number" name="fecfrom" id="fecfrom" class="form-control" min="1" step="1" value="1">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Item per Page</label>
                            <input type="number" name="fecto" id="fecto" class="form-control" min="50" step="1" value="50">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <br>
                            <button class="btn btn-info">Buscar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@section('scripts')
{{-- <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script> --}}
{{-- <script src="{{ asset('js/app.js') }}" defer></script>--}}
 {{-- <script src="{{ asset('js/datatables.min.js') }}" defer></script>
 <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script> --}}
<script>
    $(document).ready( function () {
        $('#example').DataTable({
            "language": {
                "sProcessing":    "Procesando...",
                "sLengthMenu":    "Mostrar _MENU_ registros",
                "sZeroRecords":   "No se encontraron resultados",
                "sEmptyTable":    "Ningún dato disponible en esta tabla",
                "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":   "",
                "sSearch":        "Buscar:",
                "sUrl":           "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":    "Último",
                    "sNext":    "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });

    } );
</script>
@endsection
