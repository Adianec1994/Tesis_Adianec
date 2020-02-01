@extends('../layouts/reportes')

@section('content')
<div style="overflow: auto;">
  <table border="1px solid" style="border-collapse: collapse;" WIDTH="100%">
    <thead>
      <tr>
        <th colspan="4">
          PARTE DE DISPONIBILIDAD - GEYSEL
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th>Provincia</th>
        <th>Potencia Instalada (MW)</th>
        <th>Potencia Disponible (MW)</th>
        <th>Porciento Disponible (%)</th>
      </tr>
      @empty($disponibilidades)
      <tr style="text-align: center">
        <td colspan="4">No hay disponibilidades</td>
      </tr>
      @endempty
      @foreach ($disponibilidades as $disponibilidad)
      <tr style="text-align: center">
        <td>{{$disponibilidad->provincia}}</td>
        <td>{{$disponibilidad->instalada}}</td>
        <td>{{$disponibilidad->disponible}}</td>
        <td>{{$disponibilidad->porciento}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div style="margin-top:1rem;">
    <img width="100%" src="{{$chart}}" alt="">
  </div>
</div>
@endsection
