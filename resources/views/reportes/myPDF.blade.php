<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <table class="table">
                <tbody>
                    <tr>
                        <td>Nombre de Empelado: {{$reporte[0]->nombre_empleado }}</td>
                    </tr>
                    <tr>
                        <td>N° de Empelado: {{$reporte[0]->numero_empleado }}</td>
                    </tr>
                    <tr>
                        <td>N° Orden: {{$reporte[0]->numero_orden }}</td>
                    </tr>
                    <tr>
                        <td>Fecha de orden: {{$reporte[0]->fecha_entrega }}</td>
                    </tr>
                </tbody>
              </table>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Imgen Producto</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Fecha de orden</th>
                        <th scope="col">Fecha de Ingreso</th>
                        @if ($reporte[0]->idmaquinaria_activo ==1)
                        <th scope="col">Status de Entrega</th>
                        @endif
                        
                    </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($reporte as $key=> $repo)
                        <tr>
                            <td>{{ $key+1}}</td>
                            <td><img src="stock/{{$repo->imagen }}" alt="" width="80">
                                {{--<img width="80" src="data:image/png;base64,{{ asset('/stock/'.$repo->imagen) }}" class="img-fluid" alt="...">--}}</td>
                            <td scope="row">{{ $repo->nombre }}</td>
                            <td>{{$repo->cantidad}}</td>
                            <td>{{ $repo->fecha_salida}}</td>
                            <td>{{ $repo->fecha_entrega}}</td>
                            @if ($reporte[0]->idmaquinaria_activo ==1)
                            <td>@if ($repo->fecha_entrega != 'N/A' )
                                <a href="#" class="btn btn-success"><i class="bi bi-check-circle"></i> Entrgado</a>
                                
                            @else
                            <a href="#" class="btn btn-warning" ><i class="bi bi-exclamation-circle"></i> No entregado</a>
                            
                            @endif
                            </td>
                            @endif
                        </tr>
                        @endforeach
    
                    </tbody>
                </table>
    
            </div>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">__________________</th>
                    <th scope="col">__________________</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Firma encargado del area</td>
                    <td>Firma de empleado</td>
                  </tr>
                </tbody>
              </table>
            

              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Observaciones:</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>_________________________________________________________________________________</td>
                </tr>
                <tr>
                    <td>_________________________________________________________________________________</td>
                </tr>
                <tr>
                    <td>_________________________________________________________________________________</td>
                </tr>
                </tbody>
              </table>
        </div>
        
    </div>
</body>
</html>


