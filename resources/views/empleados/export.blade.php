
<div class="container py-12">
    <div class="row">
       
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Numero de empleado</th>
                    <th scope="col">Nombre de empleado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleadoNumero as $key => $identificacion)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $identificacion->numero_empleado }}</td>
                            <td>{{ $identificacion->nombre_empleado }}</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

