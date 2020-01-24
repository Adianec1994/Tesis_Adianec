@extends('../layouts/reportes')

@section('content')
  <div style="overflow: auto;">
    <table border="1px solid" style="border-collapse: collapse;" WIDTH="200%">
        <thead>
          <tr>
            <th colspan="11">
              UNE - PARTE DIARIO DE ACOMPAÑAMIENTO DE PAILAS DE COMBUSTIBLE DIESEL
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($provincias as $provincia)
            {{-- <table border="1px solid" style="border-collapse: collapse; margin-top: 1rem;" WIDTH="200%"> --}}
             {{-- <thead> --}}
               <tr>
                 <td colspan="11" style="color: white">
                   _
                 </td>
               </tr>
                <tr>
                  <th colspan="3">
                    Provincia: {{$provincia['provincia']}}
                  </th>
                </tr>
                <tr>
                  <th style="width: 5%">Fecha</th>
                  <th style="width: 5%">Hora</th>
                  <th style="width: 10%">Central Eléctrica</th>
                  <th style="width: 7%">Combustible por Factura (L)</th>
                  <th style="width: 7%">Combustible por Medición (L)</th>
                  <th style="width: 5%">Diferencia (L)</th>
                  <th style="width: 15%">Causas</th>
                  <th colspan="2" style="width: 24%">Nombres y Apellidos</th>
                  <th style="width: 7%">CI</th>
                  <th style="width: 15%">Acciones ejecutadas</th>
                </tr>
             {{-- </thead> --}}
             {{-- <tbody> --}}
               @empty($provincia['pailas'])
                   <tr style="text-align: center">
                      <th colspan="11">No hubo entradas en esta fecha</th>
                   </tr>
               @endempty
               @foreach ($provincia['pailas'] as $paila)
                  <tr style="text-align: center">
                    <td rowspan="3">{{$paila['paila']['fecha']}}</td>
                    <td rowspan="3"></td>
                    <td rowspan="3">{{$paila['central']}}</td>
                    <td rowspan="3">{{$paila['paila']['combustibleFactura']}}</td>
                    <td rowspan="3">{{$paila['paila']['combustibleMedicion']}}</td>
                    <td rowspan="3">{{$paila['paila']['combustibleMedicion']-$paila['paila']['combustibleFactura']}}</td>
                    <td rowspan="3"></td>
                    <td style="width: .5rem">Chofer CUPET</td>
                    <td>{{$paila['paila']['chofer']['nombre']}}</td>
                    <td>{{$paila['paila']['chofer']['cidentidad']}}</td>
                    <td rowspan="3">{{$paila['paila']['acciones']}}</td>
                  </tr>
                  <tr style="text-align: center">
                    <td style="width: 10%">Acompañante UNE</td>
                    <td>{{$paila['paila']['acompanante']['nombre']}}</td>
                    <td>{{$paila['paila']['acompanante']['cidentidad']}}</td>
                  </tr>
                  <tr style="text-align: center">
                    <td style="width: .5rem">Recibe en la C.E</td>
                    <td>{{$paila['paila']['operadors']['nombre']}}</td>
                    <td>{{$paila['paila']['operadors']['cidentidad']}}</td>
                  </tr>
               @endforeach
             {{-- </tbody> --}}
            {{-- </table> --}}
          @endforeach
        </tbody>
    </table>
  </div>
@endsection
