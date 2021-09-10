<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Division::insert([
            ['name' => 'Admin'],
            ['name' => 'User'],
            ['name' => 'Ketua Pengurus'],
            ['name' => 'Koordinator'],
            ['name' => 'Keuangan'],
            ['name' => 'Keagamaan'],
            ['name' => 'Muslimah'],
            ['name' => 'Sarana & Prasarana'],
            ['name' => 'Sosmas'],
            ['name' => 'Kepemudaan'],
        ]);

        $faker = Factory::create('id');
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'mobile' => rand(100000000, 900000000),
            'address' => $faker->address(),
            'division_id' => 1,
            'password' => bcrypt('secret12345'),
        ]);
        foreach (Division::all() as $index => $division) {
            $faker = Factory::create('id');
            User::create([
                'name' => 'user-' . ($index + 1),
                'email' => 'user-' . $index . '@mail.com',
                'mobile' => rand(100000000, 900000000),
                'address' => $faker->address(),
                'division_id' => ($division->id + 1),
                'password' => bcrypt('secret12345'),
            ]);
        }
    }
}
