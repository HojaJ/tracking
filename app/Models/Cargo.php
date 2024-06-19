<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ru',
        'title_tk',
        'title_en',
        'track_number',
        'weight',
        'place',
        'capacity',
        'container_id',
        'storage_id',
        'in_arhive',
        'barcode',
        'user_id'
    ];

    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }
    public function container()
    {
        return $this->belongsTo(Container::class);
    }

    public function code()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
