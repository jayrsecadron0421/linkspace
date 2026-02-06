<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'admin@fbclone.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
                'role_id' => 1
            ]
        );
    }
}
