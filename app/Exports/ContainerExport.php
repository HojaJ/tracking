<?php

namespace App\Exports;

use App\Models\Container;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ContainerExport implements FromView
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
        return view('admin.exports.container', ['containers' => Container::whereIn('id', $this->ids)->get() ]);
    }
}
