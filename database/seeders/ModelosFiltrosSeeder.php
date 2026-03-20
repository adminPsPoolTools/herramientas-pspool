<?php

namespace Database\Seeders;

use App\Models\ModelosFiltros;
use Illuminate\Database\Seeder;

class ModelosFiltrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modelos = [
            ['descripcion' => 'Altea'],
            ['descripcion' => 'FA'],
            ['descripcion' => 'HFS'],
            ['descripcion' => 'AFM'],
            ['descripcion' => 'AFM/P']
        ];

        foreach ($modelos as $modelo) {
            ModelosFiltros::create($modelo);
        }
    }
}
