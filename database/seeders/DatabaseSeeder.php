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
            ['name' => 'Umum'],
            ['name' => 'Feedback'],
        ]);

        $faker = Factory::create('id');
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'mobile' => $faker->phoneNumber(),
            'address' => $faker->address(),
            'division_id' => 1,
            'password' => bcrypt('secret12345'),
        ]);

        // User Division
        User::insert([
            [
                'name' => 'User',
                'email' => 'user@mail.com',
                'mobile' => $faker->phoneNumber(),
                'address' => $faker->address(),
                'division_id' => 2,
                'password' => bcrypt('secret12345'),
            ],
            [
                'name' => 'Ketua Pengurus',
                'email' => 'ketua@mail.com',
                'mobile' => $faker->phoneNumber(),
                'address' => $faker->address(),
                'division_id' => 3,
                'password' => bcrypt('secret12345'),
            ],
            [
                'name' => 'Koordinator',
                'email' => 'koordinator@mail.com',
                'mobile' => $faker->phoneNumber(),
                'address' => $faker->address(),
                'division_id' => 4,
                'password' => bcrypt('secret12345'),
            ],
            [
                'name' => 'Keuangan',
                'email' => 'keuangan@mail.com',
                'mobile' => $faker->phoneNumber(),
                'address' => $faker->address(),
                'division_id' => 5,
                'password' => bcrypt('secret12345'),
            ],
            [
                'name' => 'Keagamaan',
                'email' => 'keagamaan@mail.com',
                'mobile' => $faker->phoneNumber(),
                'address' => $faker->address(),
                'division_id' => 6,
                'password' => bcrypt('secret12345'),
            ],
            [
                'name' => 'Muslimah',
                'email' => 'muslimah@mail.com',
                'mobile' => $faker->phoneNumber(),
                'address' => $faker->address(),
                'division_id' => 7,
                'password' => bcrypt('secret12345'),
            ],
            [
                'name' => 'Sarana & Prasarana',
                'email' => 'sarana_prasarana@mail.com',
                'mobile' => $faker->phoneNumber(),
                'address' => $faker->address(),
                'division_id' => 8,
                'password' => bcrypt('secret12345'),
            ],
            [
                'name' => 'Sosmas',
                'email' => 'sosmas@mail.com',
                'mobile' => $faker->phoneNumber(),
                'address' => $faker->address(),
                'division_id' => 9,
                'password' => bcrypt('secret12345'),
            ],
            [
                'name' => 'Kepemudaan',
                'email' => 'kepemudaan@mail.com',
                'mobile' => $faker->phoneNumber(),
                'address' => $faker->address(),
                'division_id' => 10,
                'password' => bcrypt('secret12345'),
            ],
        ]);
    }
}
