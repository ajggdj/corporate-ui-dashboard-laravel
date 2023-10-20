<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-md-flex align-items-center mb-3 mx-2">
                        <div class="mb-md-0 mb-3">
                            <h3 class="font-weight-bold mb-0">Carrito</h3>
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
                                <div class=" col-md-2">
                                    <label for="Idempleado" class="form-label">Numero de Empleado:</label>
                                    <select class="form-select" aria-label="Default select example" name="Idempleado" wire:model="Idempleado">
                                        <option selected>Seleccione</option>
                                        @foreach ($empleados as $empleado)
                                        <option value="{{ $empleado->id }}">{{ $empleado->numero_empleado }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" col-md-3" style="margin-left: 10px">
                                    <label for="observacion_checkout" class="form-label">Observacón:</label>
                                    <textarea  name="observacion_checkout" class="form-control" placeholder="Observaciones del producto" id="floatingTextarea2" style="height: 50px" wire:model="observacion_checkout"></textarea>
                                  </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="table-responsive p-0">
                                @if (Cart::count() > 0)
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                Imagen producto</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Nombre</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Cantidad
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Cart::content() as $item )
                                        <tr>
                                            <td>
                                                <img width="60" height="50" src="{{ asset('/stock') }}/{{$item->model->imagen}}" class="img-fluid" alt="...">
                                            </td>
                                            <td>
                                                {{ $item->model->nombre }}
                                            </td>
                                            <td>
                                                <div class="input-group quantity-selector quantity-selector-sm">
                                                    <input type="number" id="inputQuantitySelectorSm" class="form-control" aria-live="polite" data-bs-step="counter" name="quantity" title="quantity" value="{{$item->qty}}" min="0" max="10" step="1" data-bs-round="0" aria-label="Quantity selector">
                                                    <button type="button" class="btn btn-icon btn-secondary btn-sm mb-0" aria-describedby="inputQuantitySelectorSm" data-bs-step="down" wire:click.prevent="decreaseQuantity('{{$item->rowId}}')">
                                                        <i class="fa-solid fa-minus" style="font-size: 10px;"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-icon btn-secondary btn-sm mb-0" aria-describedby="inputQuantitySelectorSm" data-bs-step="up" wire:click.prevent="increaseQuantity('{{$item->rowId}}')">
                                                        <i class="fa-solid fa-plus" style="font-size: 10px;"></i>
                                                    </button>
                                                  </div>
                                            </td>
                                            <td class="align-middle">
                                                <a href="#" wire:click.prevent="destroy('{{$item->rowId}}')" class="action-btn hover-up btn btn-danger"><i class="bi bi-trash3"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center border-top py-3 px-3 d-flex align-items-center">
                                    <button class="btn btn-success" wire:click='Checkout'>
                                        Guardar
                                      </button>
                                </div>

                              @else
                              <div class="d-flex  border-top py-3 px-3 d-flex ">
                                <p>No hay productos en el carrito</p>

                            </div>
                            <div class="d-flex justify-content-center border-top py-3 px-3 d-flex align-items-center">
                                <a href="{{ route('shop') }}" class="btn btn-danger" wire:click='Checkout'>
                                    Regresar
                                </a>
                            </div>

                              @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-app-layout>
