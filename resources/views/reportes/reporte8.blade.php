@extends('../layouts/reportes')

@section('content')
<div style="overflow: auto;">
  <table border="1px solid" style="border-collapse: collapse;" WIDTH="100%">
    <thead>
      <tr>
        <th colspan="4">
          PARTE DE EXISTENCIA DE LUBRICANTES - GEYSEL
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th></th>
        @foreach ($lubricantes as $lubricante)
        <th>{{$lubricante->provincia}}</th>
        @endforeach
      </tr>
      <tr style="text-align: center">
        <th>Existencia</th>
        @foreach ($lubricantes as $lubricante)
        <td>{{$lubricante->existencia}}</td>
        @endforeach
      </tr>
      <tr style="text-align: center">
        <th>Horas</th>
        @foreach ($lubricantes as $lubricante)
        <td>{{$lubricante->horas}}</td>
        @endforeach
      </tr>
    </tbody>
  </table>
  <div style="margin-top:1rem;">
    <img width="100%" src="{{$chart}}" alt="">
  </div>
</div>
@endsection
