<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-md-flex align-items-center mb-3 mx-2">
                        <div class="mb-md-0 mb-3">
                            <h3 class="font-weight-bold mb-0">Inventario</h3>
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
                                    <button type="button"
                                        class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        <i class="fa-solid fa-plus" style="font-size: 15px; padding-right:15px;"></i>
                                        <span class="btn-inner--text"> Nuevo producto</span>
                                    </button>
                                </div>
                            </div>
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
                                    <input type="text" class="form-control" placeholder="Search">
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
                                            @foreach ($stock as $key => $inventario)
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
                                                    <ul class="nav  ">
                                                        <li class="nav-item">
                                                        <button type="button" class="btn btn-sm btn-white mb-0 me-2 " data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$inventario->idstock}}">
                                                            <svg width="14" height="14" viewBox="0 0 15 16"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M11.2201 2.02495C10.8292 1.63482 10.196 1.63545 9.80585 2.02636C9.41572 2.41727 9.41635 3.05044 9.80726 3.44057L11.2201 2.02495ZM12.5572 6.18502C12.9481 6.57516 13.5813 6.57453 13.9714 6.18362C14.3615 5.79271 14.3609 5.15954 13.97 4.7694L12.5572 6.18502ZM11.6803 1.56839L12.3867 2.2762L12.3867 2.27619L11.6803 1.56839ZM14.4302 4.31284L15.1367 5.02065L15.1367 5.02064L14.4302 4.31284ZM3.72198 15V16C3.98686 16 4.24091 15.8949 4.42839 15.7078L3.72198 15ZM0.999756 15H-0.000244141C-0.000244141 15.5523 0.447471 16 0.999756 16L0.999756 15ZM0.999756 12.2279L0.293346 11.5201C0.105383 11.7077 -0.000244141 11.9624 -0.000244141 12.2279H0.999756ZM9.80726 3.44057L12.5572 6.18502L13.97 4.7694L11.2201 2.02495L9.80726 3.44057ZM12.3867 2.27619C12.7557 1.90794 13.3549 1.90794 13.7238 2.27619L15.1367 0.860593C13.9869 -0.286864 12.1236 -0.286864 10.9739 0.860593L12.3867 2.27619ZM13.7238 2.27619C14.0917 2.64337 14.0917 3.23787 13.7238 3.60504L15.1367 5.02064C16.2875 3.8721 16.2875 2.00913 15.1367 0.860593L13.7238 2.27619ZM13.7238 3.60504L3.01557 14.2922L4.42839 15.7078L15.1367 5.02065L13.7238 3.60504ZM3.72198 14H0.999756V16H3.72198V14ZM1.99976 15V12.2279H-0.000244141V15H1.99976ZM1.70617 12.9357L12.3867 2.2762L10.9739 0.86059L0.293346 11.5201L1.70617 12.9357Z"
                                                            fill="#64748B" />
                                                    </svg>
                                                        </button>
                                                        {{--<a href="{{ route('stock.edit',$inventario->idstock)}}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar Producto"><i class="bi bi-pen"></i></a>--}}                                  </li>
                                                        <li class="nav-item">
                                                        <form action="{{route('stock.elminar',$inventario->idstock)}}" method="post" style="margin-left: 5px;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-danger mb-0 me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Dar de baja"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                            </svg></button>
                                                        </form>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <!-- Editar Modal -->
                                            <div class="modal fade  modal-lg " id="staticBackdrop-{{$inventario->idstock}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Editar Prodcuto</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                    <form class="row g-3"  method="POST" action="{{ route('stock.updatedit',$inventario->idstock) }}" enctype="multipart/form-data">
                                                        @csrf

                                                        <div class="mb-6 col-md-5">
                                                        <label for="Nombre" class="form-label">Nombre</label>
                                                        <input name="nombre" type="text" class="form-control" id="nombre" aria-describedby="nombre" value="{{ $inventario->producto }}">
                                                        </div>
                                                        <div class="mb-6 col-md-2">
                                                        <label for="Cantidad" class="form-label">Cantidad:</label>
                                                        <input name="cantidad" type="text" class="form-control" id="Cantidad" value="{{ $inventario->cantidad }}">
                                                        </div>
                                                        <div class="mb-6 col-md-3">
                                                        <label for="TipoCantidad" class="form-label">Tipo de cantidad:</label>
                                                        <select class="form-select" aria-label="Default select example" name="tipo_cantidad_id" >
                                                            <option selected>Seleccione</option>
                                                            @foreach ($tipoMedicion as $tipoMedicionid)
                                                            <option value="{{ $tipoMedicionid->id }}" {{ $inventario->idcantidad == $tipoMedicionid->id ? 'selected' : ''}}>{{ $tipoMedicionid->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                        </div>
                                                        <div class="mb-6 col-md-2">
                                                        <label for="TipoCantidad" class="form-label">Status:</label>
                                                        <select class="form-select" aria-label="Default select example" name="baja_id">
                                                            <option >Seleccione</option>
                                                            <option value="1" {{ $inventario->idbaja == 1 ? 'selected' : ''}}>Activo</option>
                                                            <option value="2" {{ $inventario->idbaja == 2 ? 'selected' : ''}}>Pendiente</option>
                                                            <option value="3" {{ $inventario->idbaja == 3 ? 'selected' : ''}}>Baja</option>
                                                        </select>
                                                        </div>
                                                        <div class="mb-6 col-md-4">
                                                        <label for="Observacón" class="form-label">Observacón:</label>
                                                        <textarea  name="observacion" class="form-control" placeholder="Observaciones del producto" id="floatingTextarea2" style="height: 50px">{{ $inventario->observaciones }}</textarea>
                                                        </div>
                                                        <div class="mb-6 col-md-3">
                                                        <label for="TipoMercancia" class="form-label">Tipo de mercancia:</label>
                                                        <select class="form-select" aria-label="Default select example" name="tipo_mercancia_id">
                                                            <option selected>Seleccione</option>
                                                            @foreach ($tipoMercancia as $tipoMercanciaid)
                                                            <option value="{{ $tipoMercanciaid->id }}" {{ $inventario->idmercancia == $tipoMercanciaid->id ? 'selected' : ''}}>{{ $tipoMercanciaid->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                        </div>
                                                        <div class="mb-6 col-md-5">
                                                        <label for="Imagen" class="form-label">Imagen:</label>
                                                        <input name="imagen" class="form-control" type="file" id="Imagen">
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
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center border-top py-3 px-3 d-flex align-items-center">
                                    {!! $stock->links() !!}
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

</x-app-layout>
