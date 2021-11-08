@extends('layouts.app')

{{-- @section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
{{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
@endsection --}}

@section('styles')

@endsection

@section('content-header')
<div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> Dispositivos - <small> {{ __(' asignados al usuario Oscar Roditi') }} | # {{$cantDevices}}</small> -
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Dispositivos</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            {{-- <a class="btn btn-info" href="{{ route('home') }}">Ir a Inicio</a> --}}
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-info" href="{{ route('home') }}">Ir a Inicio</a>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="thead-dark" style="text-align: center">
                            <tr>
                                <th>{{ __('ID_Device ') }}</th>
                                <th>{{ __('DeviceTypeCode ') }}</th>
                                <th>{{ __('Imei ') }}</th>
                                {{-- <th>{{ __('Notes') }}</th>
                                <th>{{ __('ExternalId') }}</th>
                                <th>{{ __('IsShareDevice') }}</th> --}}
                                <th>{{ __('CreatedOn ') }}</th>
                                <th>{{ __('InstalledOn ') }}</th>
                               {{--  <th>{{ __('Actions') }}</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $i)
                                <tr>
                                    <td>{{ $i->id_device }}</td>
                                    <td>{{ $i->deviceTypeCode }}</td>
                                    <td>{{ $i->imei }}</td>
                                   {{--  <td>{{ $i->notes }}</td>
                                    <td>{{ $i->externalId }}</td>
                                    <td>{{ $i->isShareDevice }}</td> --}}
                                    <td>{{ $i->createdOn }}</td>
                                    <td>{{ $i->installedOn }}</td>
                                    {{-- <td>
                                        <a href="{{ route('alerts.show',$i->imei ) }}" class="btn btn-info" disabled>Alertas</a>
                                    </td> --}}
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
<script>
    $(document).ready( function () {
        $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "excel", "pdf", "print", "colvis"],
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
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection




