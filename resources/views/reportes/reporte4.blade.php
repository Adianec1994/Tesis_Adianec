@extends('../layouts/reportes')

@section('content')
<div style="overflow: auto;">
  <table border="1px solid" style="border-collapse: collapse;" WIDTH="200%">
    <thead>
      <tr>
        <th colspan="12">
          PARTE DE COBERTURA DE COMBUSTIBLE - GEYSEL
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th colspan="3">
          Fecha: {{($coberturas[0]['fechaCobertura'])}}
        </th>
      </tr>
      <tr>
        <th>Provincia</th>
        <th>Centrales Diesel</th>
        <th>Capacidad total almacenamiento (lts)</th>
        <th>Existencia TOTAL (lts) Cierre Día Anterior</th>
        <th>Existencia TOTAL (lts)</th>
        <th>Capacidad de vacio (lts)</th>
        <th>Plan Reserva (lts)</th>
        <th>Fondaje</th>
        <th>Existencia operativa (lts) (ExTotal-Fond-Reserva)</th>
        <th>Cobertura (hrs)</th>
        <th>Consumo (lts)</th>
        <th>Suministro de CUPET (Entradas) (lts)</th>
      </tr>
      @foreach ($coberturas as $cobertura)
      <tr style="text-align: center">
        <td>{{$cobertura['central_electricas']['entidads']['provincias']['nombre']}}</td>
        <td>{{$cobertura['central_electricas']['nombre']}}</td>
        <td>{{$cobertura['capacTotalAlmac']}}</td>
        <td>{{$cobertura['existTotalDiaAnterior']}}</td>
        <td>{{$cobertura['existTotal']}}</td>
        <td>{{$cobertura['capacVacio']}}</td>
        <td>{{$cobertura['planReserva']}}</td>
        <td>{{$cobertura['fondaje']}}</td>
        <td>{{$cobertura['existOperativa']}}</td>
        <td>{{$cobertura['coberturaHoras']}}</td>
        <td>{{$cobertura['consumo']}}</td>
        <td>{{$cobertura['suminCupet']}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
