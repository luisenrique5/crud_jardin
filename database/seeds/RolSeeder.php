<?php

use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Rol::create([
            'name' => 'padres',
        ]);

        \App\Rol::create([
            'name' => 'tutor legal',
        ]);
    }
}
