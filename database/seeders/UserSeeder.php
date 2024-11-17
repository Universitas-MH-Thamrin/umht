<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Admin Web',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('umht2024'),
                'role' => 'admin'
            ],
        ];

        DB::table('users')->insert($data);
    }
}
