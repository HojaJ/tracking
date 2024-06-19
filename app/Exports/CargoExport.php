<?php

namespace App\Exports;

use App\Models\Cargo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CargoExport implements FromView
{
    protected $ids;

    public function __construct($ids) {
        $this->ids = $ids;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        // return Cargo::whereIn('id', $this->ids)->get();  
        return view('admin.exports.cargo', ['cargos' => Cargo::whereIn('id', $this->ids)->get() ] );
    }
}
