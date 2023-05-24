<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Lokasi::factory(5)->create();

        \App\Models\User::create([
            'nama' => 'Alzah Fariski',
            'username' => 'admin',
            'email' => 'alzahfariski@gmail.com',
            'jabatan' => 'programmer',
            'password' => bcrypt('demo'),
            'role' => 'admin'
        ]);
    }
}
