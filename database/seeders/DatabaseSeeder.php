<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Santi',
            'email' => 'santi@ps-pool.com',
            'password' => bcrypt('6rG5B6')
        ]);

        $this->call(ModelosCloradoresSeeder::class);
        $this->call(ModelosFiltrosSeeder::class);
    }
}
