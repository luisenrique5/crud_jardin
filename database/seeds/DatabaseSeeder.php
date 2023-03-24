<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(DocumentTypeSeeder::class);
        $this->call(RolSeeder::class);
        $this->call(usersSeeder::class);
        $this->call(UserRolSeeder::class);
    }
}
