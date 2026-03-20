<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelosFiltros extends Model
{
    use HasFactory;
    protected $table = 'modelos_filtros';
    protected $fillable = ['descripcion'] ;
}
