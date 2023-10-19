<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-md-flex align-items-center mb-3 mx-2">
                        <div class="mb-md-0 mb-3">
                            <h3 class="font-weight-bold mb-0">Detalles de la orden: {{ $numeroOrden[0]->numero_orden}}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-0">
            <div class="row my-4">
                <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
                    <div class="card shadow-xs border">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center mb-3">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Nombre de Empleado: {{$empleado[0]->nombre_empleado}}</h6>
                                    <h6 class="font-weight-semibold text-lg mb-0">Nº de Empleado: {{$empleado[0]->numero_empleado}}</h6>
                                    <h6 class="font-weight-semibold text-lg mb-0">Fecha:       {{ \Carbon\Carbon::now()->format('d/m/Y') }}</h6>

                                </div>
                                <div class="ms-auto d-flex">
                                    <a href="{{route('report.generatePDFnormal', $numeroOrden[0]->numero_orden)}}"
                                        class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0">
                                        <span class="btn-inner--icon">
                                            <i class="fa-regular fa-file-pdf" style="font-size: 15px;padding-right:5px;"></i>
                                        </span>
                                        <span class="btn-inner--text"> PDF</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                #</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Imgen Producto</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Producto
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Cantidad</th>
                                            <th
                                                class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Fecha de orden
                                            </th>
                                            <th
                                                class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Observaciones
                                            </th>
                                            <th
                                                class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reporte as $key => $report)
                                        <tr>
                                            <th scope="row">{{ $key+1 }}</th>
                                            <td><img width="80" src="{{ asset('/stock') }}/{{ $report->imagen}}" class="img-fluid" alt="..."></td>
                                            <td>{{ $report->nombre}}</td>
                                            <td>{{$report->cantidad}}</td>
                                            <td>{{ $report->fecha_salida}}</td>
                                            <td>{{$report->obser}}</td>
                                            <td class="align-middle">
                                                <ul class="nav  ">
                                                    @if ($report->elimdetalle !=0)
                                                    <li class="nav-item">
                                                        <form action="{{route('report.eliminardetalle',$report->checkid)}}" method="post" style="margin-left: 5px;">
                                                          @csrf
                                                          <button type="submit" class="btn btn-sm btn-danger btn-icon d-flex align-items-center mb-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Dar de baja"><i class="fa-solid fa-trash" style="font-size: 15px;"></i></button>
                                                        </form>
                                                      </li>
                                                    @else
                                                    <h5><span class="badge bg-gradient-danger">Eliminado</span> </h5>
                                                    @endif


                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-app-layout>
