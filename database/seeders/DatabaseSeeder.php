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
        \App\Models\User::create([
            'nama' => 'Alzah Fariski',
            'email' => 'alzahfariski@gmail.com',
            'jabatan' => 'programmer',
            'pangkat' => 'MHS',
            'password' => bcrypt('demo'),
            'role' => 'admin'
        ]);
    }
}
