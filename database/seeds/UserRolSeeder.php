<?php

use Illuminate\Database\Seeder;

class UserRolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\UserRol::create([
            'idUsers' => '2',
            'idRol' => '1',
        ]);

        \App\UserRol::create([
            'idUsers' => '3',
            'idRol' => '1',
        ]);

        \App\UserRol::create([
            'idUsers' => '4',
            'idRol' => '1',
        ]);

        \App\UserRol::create([
            'idUsers' => '5',
            'idRol' => '1',
        ]);

        \App\UserRol::create([
            'idUsers' => '6',
            'idRol' => '2',
        ]);

        \App\UserRol::create([
            'idUsers' => '7',
            'idRol' => '1',
        ]);

        \App\UserRol::create([
            'idUsers' => '8',
            'idRol' => '2',
        ]);

        \App\UserRol::create([
            'idUsers' => '9',
            'idRol' => '1',
        ]);

        \App\UserRol::create([
            'idUsers' => '10',
            'idRol' => '2',
        ]);

        \App\UserRol::create([
            'idUsers' => '11',
            'idRol' => '2',
        ]);

        \App\UserRol::create([
            'idUsers' => '12',
            'idRol' => '2',
        ]);
    }
}
