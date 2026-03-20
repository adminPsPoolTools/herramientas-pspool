<?php

namespace Database\Seeders;

use App\Models\ModelosCloradores;
use Illuminate\Database\Seeder;

class ModelosCloradoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modelos = [
            ['descripcion' => 'Hidrolife'],
            ['descripcion' => 'Oxilife'],
            ['descripcion' => 'Uvscenic'],
            ['descripcion' => 'Aquascenic'],
            ['descripcion' => 'Hidroniser']
        ];

        foreach ($modelos as $modelo) {
            ModelosCloradores::create($modelo);
        }
    }
}
