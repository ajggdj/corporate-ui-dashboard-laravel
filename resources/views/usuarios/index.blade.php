<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-md-flex align-items-center mb-3 mx-2">
                        <div class="mb-md-0 mb-3">
                            <h3 class="font-weight-bold mb-0">Administrar Usuarios</h3>
                        </div>
                        <div class="ms-auto d-flex">
                            <button type="button"
                                class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop-usuarios">

                                <span class="btn-inner--text">Nuevo Usuario</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-0">
            <div class="row my-4">
                <div class="col-lg-6 col-md-6 mb-md-0 mb-4">
                    <div class="card shadow-xs border h-100">
                        <div class="card-header pb-0">
                            <h6 class="font-weight-semibold text-lg mb-3">Usuarios Activos</h6>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                #</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Nombre</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Correo
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($usuario as $key => $usuarios)
                                        <tr>
                                            <td>
                                                {{ $key+1 }}
                                            </td>
                                            <td>@if($usuarios->email == 'a.javier.glz@gmail.com') Admin @else {{ $usuarios->name }} @endif </td>
                                            <td>@if($usuarios->email == 'a.javier.glz@gmail.com') Admin @else {{ $usuarios->email }} @endif </td>
                                            <td class="align-middle">
                                                <ul class="nav">
                                                    <li class="nav-item">
                                                        <button @if($usuarios->email == 'a.javier.glz@gmail.com') style="display:none;" @endif type="button" class="btn btn-sm btn-white mb-0 me-2 " data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$usuarios->id}}">
                                                            <svg width="14" height="14" viewBox="0 0 15 16"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M11.2201 2.02495C10.8292 1.63482 10.196 1.63545 9.80585 2.02636C9.41572 2.41727 9.41635 3.05044 9.80726 3.44057L11.2201 2.02495ZM12.5572 6.18502C12.9481 6.57516 13.5813 6.57453 13.9714 6.18362C14.3615 5.79271 14.3609 5.15954 13.97 4.7694L12.5572 6.18502ZM11.6803 1.56839L12.3867 2.2762L12.3867 2.27619L11.6803 1.56839ZM14.4302 4.31284L15.1367 5.02065L15.1367 5.02064L14.4302 4.31284ZM3.72198 15V16C3.98686 16 4.24091 15.8949 4.42839 15.7078L3.72198 15ZM0.999756 15H-0.000244141C-0.000244141 15.5523 0.447471 16 0.999756 16L0.999756 15ZM0.999756 12.2279L0.293346 11.5201C0.105383 11.7077 -0.000244141 11.9624 -0.000244141 12.2279H0.999756ZM9.80726 3.44057L12.5572 6.18502L13.97 4.7694L11.2201 2.02495L9.80726 3.44057ZM12.3867 2.27619C12.7557 1.90794 13.3549 1.90794 13.7238 2.27619L15.1367 0.860593C13.9869 -0.286864 12.1236 -0.286864 10.9739 0.860593L12.3867 2.27619ZM13.7238 2.27619C14.0917 2.64337 14.0917 3.23787 13.7238 3.60504L15.1367 5.02064C16.2875 3.8721 16.2875 2.00913 15.1367 0.860593L13.7238 2.27619ZM13.7238 3.60504L3.01557 14.2922L4.42839 15.7078L15.1367 5.02065L13.7238 3.60504ZM3.72198 14H0.999756V16H3.72198V14ZM1.99976 15V12.2279H-0.000244141V15H1.99976ZM1.70617 12.9357L12.3867 2.2762L10.9739 0.86059L0.293346 11.5201L1.70617 12.9357Z"
                                                            fill="#64748B" />
                                                    </svg>
                                                        </button>
                                                    </li>
                                                    <li class="nav-item">
                                                        <form action="{{route('usuarios.eliminarusuarios',$usuarios->id)}}" method="post" style="margin-left: 5px;">
                                                            @csrf
                                                            <button @if($usuarios->email == 'a.javier.glz@gmail.com') style="display:none;" @endif type="submit" class="btn btn-sm btn-danger mb-0 me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Dar de baja">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                                </svg>
                                                            </button>
                                                          </form>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <!-- Modal tipos de usuarios-->
                                        <div class="modal fade" id="staticBackdrop{{$usuarios->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Editar Usuario</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <form class="row g-3"  method="POST" action="{{ route('usuarios.editusuarios',$usuarios->id) }}" enctype="multipart/form-data">
                                                                @csrf
                                                            <div class="mb-6 col-md-6">
                                                                <label for="Nombre" class="form-label">Nombre</label>
                                                                <input name="nombre" type="text" class="form-control" id="nombre" aria-describedby="nombre" value="{{ $usuarios->name }}" required>
                                                            </div>
                                                            <div class="mb-6 col-md-6">
                                                                <label for="correo" class="form-label">Correo</label>
                                                                <input name="correo" type="email" class="form-control" id="email" aria-describedby="email" value="{{ $usuarios->email }}" required>
                                                            </div>
                                                            <div class="mb-6 col-md-12">
                                                                <label for="password" class="form-label">Contraseña</label>
                                                                <input name="password" type="password" class="form-control" id="password" aria-describedby="password" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="card shadow-xs border">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center mb-3">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Usuarios Inactivos</h6>
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
                                                Nombre</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Correo
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($usuariobaja as $key => $usuariobajas)
                                        <tr>
                                            <th scope="row">{{ $key+1 }}</th>
                                            <td>{{ $usuariobajas->name }}</td>
                                            <td>{{ $usuariobajas->email }}</td>
                                            <td>
                                                <ul class="nav">
                                                    <li class="nav-item">
                                                        <form action="{{route('usuarios.activarusuarios',$usuariobajas->id)}}" method="post" style="margin-left: 5px;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Dar de baja">
                                                                <i class="fa-solid fa-check"></i>
                                                            </button>
                                                        </form>
                                                    </li>
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

            <x-app.footer />
        </div>
        <!-- Modal de usuarios-->
<div class="modal fade" id="staticBackdrop-usuarios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="row g-3"  method="POST" action="{{ route('usuarios.addusuarios') }}" enctype="multipart/form-data">
                        @csrf
                    <div class="mb-6 col-md-6">
                        <label for="Nombre" class="form-label">Nombre</label>
                        <input name="nombre" type="text" class="form-control" id="nombre" aria-describedby="nombre" required>
                    </div>
                    <div class="mb-6 col-md-6">
                        <label for="correo" class="form-label">Correo</label>
                        <input name="correo" type="email" class="form-control" id="email" aria-describedby="email" required>
                    </div>
                    <div class="mb-6 col-md-12">
                        <label for="password" class="form-label">Contraseña</label>
                        <input name="password" type="password" class="form-control" id="password" aria-describedby="password" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
        </div>
    </div>
</div>
    </main>

</x-app-layout>
