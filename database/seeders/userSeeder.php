<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = [
            [
                'name' => "Admin Toko",
                'email' => "admin@gmail.com",
                'password' => bcrypt('password'),
                'role' => 'admin',
            ],
            [
                'name' => "Joseph Joestar",
                'email' => "joseph@gmail.com",
                'password' => bcrypt('password'),
                'role' => 'staff',
            ],
            [
                'name' => "Jotaro Kujo",
                'email' => "jotaro@gmail.com",
                'password' => bcrypt('password'),
                'role' => 'staff',
            ],
            [
                'name' => "Agus",
                'email' => "agus@gmail.com",
                'password' => bcrypt('password'),
                'role' => 'user',
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
