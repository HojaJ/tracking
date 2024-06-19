<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
    ];

    public function cargos()
    {
        return $this->hasMany(Cargo::class);
    }

    public function available_cargos()
    {
        return $this->cargos()->where('container_id','=', null);
    }
    
    public function arhive_cargos()
    {
        return $this->cargos()->where('container_id','!=', null);
    }

    public function containers()
    {
        return $this->hasMany(Container::class);
    }

    public function notInArhiveContainers()
    {
        return $this->containers()->where('in_arhive', '!=', 1);
    }
}
