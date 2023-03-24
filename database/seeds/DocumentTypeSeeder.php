<?php

use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\DocumentType::create([
            'name' => 'cedula',
        ]);

        \App\DocumentType::create([
            'name' => 'cedula extranjeria',
        ]);

        \App\DocumentType::create([
            'name' => 'tarjeta de identidad',
        ]);
    }
}
