<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-md-flex align-items-center mb-3 mx-2">
                        <div class="mb-md-0 mb-3">
                            <h3 class="font-weight-bold mb-0">Ordenes Maquinaria</h3>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-0">
            <div class="row my-4">
                <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
                    <div class="card shadow-xs border">
                        <div class="card-header border-bottom pb-0">
                            <div class="pb-3 d-sm-flex align-items-center">
                                <div class="input-group w-sm-25 ms-auto">
                                    <span class="input-group-text text-body">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                            </path>
                                        </svg>
                                    </span>
                                    <input id="buscar" type="text" class="form-control" placeholder="Search">
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="table-responsive p-0">
                                <table id="tabla" class="table align-items-center justify-content-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                #</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Numero de Empleado</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Numero de Orden
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Fecha de Orden</th>
                                            <th
                                                class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($maquinaria as $key => $report)
                                        <tr>
                                            <td>
                                                {{ $key+1 }}
                                            </td>

                                            <td>
                                                {{ $report->numero_empleado}}
                                            </td>
                                            <td>
                                                {{$report->numero_orden}}
                                            </td>
                                            <td class="align-middle">
                                                {{ $report->fecha_salida}}
                                            </td>
                                            <td class="align-middle">
                                                <a class="mb-0 btn btn-sm btn-white me-2" href="{{ route('report.detallesmaquina',$report->numero_orden) }}"><i class="fa-regular fa-eye" style="font-size: 15px;"></i> Ver Detalles</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center border-top py-3 px-3 d-flex align-items-center">
                                    {!! $maquinaria->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        var busqueda = document.getElementById('buscar');
      var table = document.getElementById("tabla").tBodies[0];

      buscaTabla = function(){
        texto = busqueda.value.toLowerCase();
        var r=0;
        while(row = table.rows[r++])
        {
          if ( row.innerText.toLowerCase().indexOf(texto) !== -1 )
            row.style.display = null;
          else
            row.style.display = 'none';
        }
      }

      busqueda.addEventListener('keyup', buscaTabla);
  </script>
</x-app-layout>
