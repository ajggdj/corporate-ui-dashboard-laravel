<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-md-flex align-items-center mb-3 mx-2">
                        <div class="mb-md-0 mb-3">
                            <h3 class="font-weight-bold mb-0">Empleados</h3>
                        </div>

                    </div>
                </div>
            </div>
            <hr class="my-0">
            @if (session()->has('success'))
        <div class="alert alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert alert-success alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
            <div class="row my-4">
                <div class="col-lg-12 col-md-12">
                    <div class="card shadow-xs border">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center mb-3">
                                <div class="ms-auto d-flex">
                                    <button type="button" style="margin-right: 10px;" class="btn btn-sm btn-white mb-0 me-2" data-bs-toggle="modal" data-bs-target="#staticBackdropImportar">
                                        <i class="bi bi-file-arrow-up"></i> Importar
                                    </button>
                                    <a class="btn btn-sm btn-success  mb-0 me-2" style="margin-right: 10px;" href="{{ route('exportEmpleados') }}"> <i class="bi bi-file-earmark-arrow-down"></i> Exportar</a>

                                    <button type="button"
                                        class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop">

                                        <span class="btn-inner--text">Nuevo empleado</span>
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
                                                Numero de empleado</th>

                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Nombre del empleado</th>
                                            <th
                                                class=" text-secondary text-xs font-weight-semibold opacity-7">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($empleadoNumero as $key => $identificacion)
                                        <tr>
                                            <td>
                                                {{ $key+1 }}
                                            </td>
                                            <td>
                                                {{ $identificacion->numero_empleado }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $identificacion->nombre_empleado }}
                                            </td>
                                            <td class="align-middle">
                                                <ul class="nav  ">
                                                    <li>
                                                        <button type="button" class="btn btn-sm btn-white mb-0 me-2 " data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$identificacion->id}}">
                                                            <svg width="14" height="14" viewBox="0 0 15 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M11.2201 2.02495C10.8292 1.63482 10.196 1.63545 9.80585 2.02636C9.41572 2.41727 9.41635 3.05044 9.80726 3.44057L11.2201 2.02495ZM12.5572 6.18502C12.9481 6.57516 13.5813 6.57453 13.9714 6.18362C14.3615 5.79271 14.3609 5.15954 13.97 4.7694L12.5572 6.18502ZM11.6803 1.56839L12.3867 2.2762L12.3867 2.27619L11.6803 1.56839ZM14.4302 4.31284L15.1367 5.02065L15.1367 5.02064L14.4302 4.31284ZM3.72198 15V16C3.98686 16 4.24091 15.8949 4.42839 15.7078L3.72198 15ZM0.999756 15H-0.000244141C-0.000244141 15.5523 0.447471 16 0.999756 16L0.999756 15ZM0.999756 12.2279L0.293346 11.5201C0.105383 11.7077 -0.000244141 11.9624 -0.000244141 12.2279H0.999756ZM9.80726 3.44057L12.5572 6.18502L13.97 4.7694L11.2201 2.02495L9.80726 3.44057ZM12.3867 2.27619C12.7557 1.90794 13.3549 1.90794 13.7238 2.27619L15.1367 0.860593C13.9869 -0.286864 12.1236 -0.286864 10.9739 0.860593L12.3867 2.27619ZM13.7238 2.27619C14.0917 2.64337 14.0917 3.23787 13.7238 3.60504L15.1367 5.02064C16.2875 3.8721 16.2875 2.00913 15.1367 0.860593L13.7238 2.27619ZM13.7238 3.60504L3.01557 14.2922L4.42839 15.7078L15.1367 5.02065L13.7238 3.60504ZM3.72198 14H0.999756V16H3.72198V14ZM1.99976 15V12.2279H-0.000244141V15H1.99976ZM1.70617 12.9357L12.3867 2.2762L10.9739 0.86059L0.293346 11.5201L1.70617 12.9357Z"
                                                                    fill="#64748B" />
                                                            </svg>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                         <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop-{{$identificacion->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="{{ route('empleados.editar',$identificacion->id) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row g-2">
                                                                <div class="mb-6 col-md-12">
                                                                    <label for="Nombre_empleado" class="form-label">Nombre de empleado</label>
                                                                    <input name="nombre_empleado" type="text" class="form-control" id="nombre" aria-describedby="nombre"  value="{{ $identificacion->nombre_empleado }}">
                                                                </div>
                                                                <div class="mb-6 col-md-12">
                                                                    <label for="Numero_empleado" class="form-label">Numero de empleado</label>
                                                                    <input name="numero_empleado" type="text" class="form-control" id="Cantidad" required value="{{ $identificacion->numero_empleado }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Enviar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal agregar empleados-->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('empleados.add') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Nuevo Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="mb-6 col-md-12">
                            <label for="Nombre_empleado" class="form-label">Nombre de empleado</label>
                            <input name="nombre_empleado" type="text" class="form-control" id="nombre" aria-describedby="nombre" >
                        </div>
                        <div class="mb-6 col-md-12">
                            <label for="Numero_empleado" class="form-label">Numero de empleado</label>
                            <input name="numero_empleado" type="text" class="form-control" id="Cantidad" required>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </form>
    </div>
  </div>
   <!--modal importar-->

  <!-- Modal -->
  <div class="modal fade" id="staticBackdropImportar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Importar Nuevos Usuarios</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ url('/import') }}" method="post" enctype="multipart/form-data">
                @csrf
                <p>Solo se podra importar archivos que tenga la extencion CSV. </p>
                <input type="file" name="file"  accept=".csv">
                <button type="submit" class="btn btn-primary">Import</button>
                </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
