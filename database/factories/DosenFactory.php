<?php

namespace Database\Factories;

use App\Models\Dosen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Dosen>
 */
class DosenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       $gelar =fake()->randomElement([
        'S.Kom','M.Kom','ST.,MT','S.Kom.,M.Kom','S.Kom.,M.TI','S.Kom.,M.Sc',
       ]);
       $nama =fake()->firstName().' '.fake()->lastName();

       return[
        'nidn'=> fake()->unique()->numerify('00########'),
        'nama'=> $nama,
        'email'=> fake()->unique()->safeEmail(),
        'telpon'=> fake()->numerify('08##########'),
        'alamat'=> fake()->address(),
        'jabatan_fungsional' => fake()->randomElement(['Asisten Ahli','Lektor','Lektor Kepala','Guru Besar']),
       ];
    }
}
