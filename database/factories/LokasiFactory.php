<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lokasi>
 */
class LokasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_jalan' => fake()->city(),
            'alamat' => fake()->address(),
            'longitude' => fake()->longitude(),
            'latitude' => fake()->latitude(),
            'keterangan' => fake()->sentence(10), // password
            'kategori' => fake()->name(),
        ];
    }
}
