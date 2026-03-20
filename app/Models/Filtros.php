<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filtros extends Model
{
    use HasFactory;
    protected $fillable = ['descripcion', 'codigo', 'url', 'fk_modelo', 'diametro', 'superficie_filtrante', 'tipo_filtro'];
}
