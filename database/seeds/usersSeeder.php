<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'nickname' => str_random(10),
            'document' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'idDocumentsTypes' => 1,
        ]);

        \App\User::create([
            'nickname' => str_random(10),
            'document' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'idDocumentsTypes' => 1,
        ]);

        \App\User::create([
            'nickname' => str_random(10),
            'document' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'idDocumentsTypes' => 1,
        ]);

        \App\User::create([
            'nickname' => str_random(10),
            'document' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'idDocumentsTypes' => 1,
        ]);

        \App\User::create([
            'nickname' => str_random(10),
            'document' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'idDocumentsTypes' => 1,
        ]);

        \App\User::create([
            'nickname' => str_random(10),
            'document' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'idDocumentsTypes' => 1,
        ]);

        \App\User::create([
            'nickname' => str_random(10),
            'document' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'idDocumentsTypes' => 1,
        ]);

        \App\User::create([
            'nickname' => str_random(10),
            'document' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'idDocumentsTypes' => 2,
        ]);

        \App\User::create([
            'nickname' => str_random(10),
            'document' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'idDocumentsTypes' => 2,
        ]);

        \App\User::create([
            'nickname' => str_random(10),
            'document' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'idDocumentsTypes' => 2,
        ]);

        \App\User::create([
            'nickname' => str_random(10),
            'document' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'idDocumentsTypes' => 2,
        ]);

        \App\User::create([
            'nickname' => str_random(10),
            'document' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'idDocumentsTypes' => 2,
        ]);
    }
}
