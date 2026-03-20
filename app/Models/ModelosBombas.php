<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelosBombas extends Model
{
    use HasFactory;
    protected $table = 'modelos_bombas';
    protected $fillable = ['descripcion'] ;
}
