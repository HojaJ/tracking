<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_tk',
        'name_ru',
        'name_en'
    ];

    public function container()
    {
        return $this->hasMany(Container::class);
    }
}
