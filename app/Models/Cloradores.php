<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cloradores extends Model
{
    use HasFactory;
    protected $fillable = ['descripcion', 'codigo', 'url' , 'fk_modelo' , 'valor'] ;

    public function models()
    {
        return $this->hasMany(Model::class);
    }
}
