<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'storage_id',
        'comment_ru',
        'type',
        'comment_tk',
        'shipping_id',
        'departure_date',
        'in_arhive',
    ];

    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }

    public function cargos()
    {
        return $this->hasMany(Cargo::class);
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }

}
