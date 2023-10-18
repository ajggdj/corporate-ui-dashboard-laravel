<?php

namespace App\Imports;

use App\Models\employees;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $existe = employees::where('numero_empleado', $row[1])->count();

        if($existe == 0){
            return new employees([
                'nombre_empleado' => $row[0],
                'numero_empleado' => $row[1],
                'activo' => 1,
            ]);
        }


    }
}
