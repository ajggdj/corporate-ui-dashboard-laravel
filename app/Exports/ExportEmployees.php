<?php

namespace App\Exports;

use App\Models\employees;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportEmployees implements FromView
{
    public function view(): View
    {
        return view('empleados.export', [
            'empleadoNumero' => employees::all()
        ]);
    }
}