<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-md-flex align-items-center mb-3 mx-2">
                        <div class="mb-md-0 mb-3">
                            <h3 class="font-weight-bold mb-0">Inventario Pendientes</h3>
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
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <div class="ms-auto d-flex">
                                </div>
                            </div>
                            <div class="pb-3 d-sm-flex align-items-center">
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <a href="{{ route('stock.index') }}" class="btn btn-white {{ is_current_route('stock.index') ? 'active' : '' }}">Inventario</a>
                                    <a href="{{ route('stock.indexpendientes') }}" class="btn btn-white {{ is_current_route('stock.indexpendientes') ? 'active' : '' }}">Pendientes</a>
                                    <a href="{{ route('stock.indexbaja') }}" class="btn btn-white {{ is_current_route('stock.indexbaja') ? 'active' : '' }}">Baja</a>
                                </div>
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
                                    <input id="buscar" type="text" class="form-control" placeholder="Buscar...">
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
                                                Imagen</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Nombre
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Cantidad</th>
                                            <th
                                                class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Observaciones
                                            </th>
                                            <th
                                                class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Tipo de Producto
                                            </th>
                                            <th
                                                class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach ($pendiente as $key => $inventario)
                                            <tr>
                                                <th scope="row">{{ $key+1 }}</th>
                                                <td><a data-bs-toggle="modal" data-bs-target="#exampleModal-{{$inventario->idstock}}"><img class="img-thumbnail" width="80" src="{{ asset('/stock') }}/{{$inventario->imagen}}" alt=""></a></td>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal-{{$inventario->idstock}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content" style="background-color: #faebd700;border: none;">
                                                        <div class="modal-body">
                                                            <img width="400" src="{{ asset('/stock') }}/{{$inventario->imagen}}" class="img-fluid" alt="...">
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                <td>{{ $inventario->producto }}</td>
                                                <td>{{ $inventario->cantidad }} {{ $inventario->tipo }}</td>
                                                <td>{{ $inventario->observaciones }}</td>
                                                <td>{{ $inventario->herramienta }}</td>
                                                <td class="align-middle">
                                                    <ul class="nav   ">
                                                        <li class="nav-item">
                                                          <form action="{{route('stock.activo',$inventario->idstock)}}" method="post" >
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-success mb-0 me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Cambiar a activo"><i class="fa-solid fa-check" style="font-size:15px; "></i></button>
                                                          </form>                                  </li>
                                                        <li class="nav-item">
                                                          <form action="{{route('stock.elminar',$inventario->idstock)}}" method="post" style="margin-left: 5px;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-danger mb-0 me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Dar de baja"><i class="fa-solid fa-trash" style="font-size: 15px;"></i></button>
                                                          </form>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center border-top py-3 px-3 d-flex align-items-center">
                                    {!! $pendiente->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Modal -->
<div class="modal  fade modal-lg " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Nuevo Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form class="row g-3"  method="POST" action="{{ route('stock.nuevoproducto') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-6 col-md-6">
              <label for="Nombre" class="form-label">Nombre</label>
              <input name="nombre" type="text" class="form-control" id="nombre" aria-describedby="nombre" required>
            </div>
            <div class="mb-6 col-md-2">
              <label for="Cantidad" class="form-label">Cantidad:</label>
              <input name="cantidad" type="text" class="form-control" id="Cantidad" required>
            </div>
            <div class="mb-6 col-md-2">
              <label for="TipoCantidad" class="form-label">Tipo de cantidad:</label>
              <select class="form-select" aria-label="Default select example" name="tipo_cantidad_id" required>
                <option value="" selected>Seleccione</option>
                @foreach ($tipoMedicion as $tipoMedicionid)
                <option value="{{ $tipoMedicionid->id }}">{{ $tipoMedicionid->nombre }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-6 col-md-2">
              <label for="TipoCantidad" class="form-label">Status:</label>
              <select class="form-select" aria-label="Default select example" name="status" required>
                <option value="" selected>Seleccione</option>
                <option value="1">Activo</option>
                <option value="2">Pendiente</option>
                <option value="3">Baja</option>
              </select>
            </div>
            <div class="mb-6 col-md-4">
              <label for="Observacón" class="form-label">Observacón:</label>
              <textarea name="observacion" class="form-control" placeholder="Observaciones del producto" id="floatingTextarea2" style="height: 50px"></textarea>
            </div>
            <div class="mb-6 col-md-3">
              <label for="TipoMercancia" class="form-label">Tipo de mercancia:</label>
              <select class="form-select" aria-label="Default select example" name="tipo_mercancia_id" required>
                <option value="" selected>Seleccione</option>
                @foreach ($tipoMercancia as $tipoMercanciaid)
                <option value="{{ $tipoMercanciaid->id }}">{{ $tipoMercanciaid->nombre }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-6 col-md-5">
              <label for="Imagen" class="form-label">Imagen:</label>
              <input name="imagen" class="form-control" type="file" id="Imagen" accept="image/*" required>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary float-end" style="margin-left:8px">Enviar</button>
        </div>
      </form>
      </div>
    </div>
  </div>
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
