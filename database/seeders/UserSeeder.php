<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Load job listings from file
        $users = include database_path('seeders/data/users.php');


        foreach ($users as $index => &$user) {
            // Encrypt password
            $user['password'] = bcrypt($user['password']);

            // Add timestamps
            $user['created_at'] = now();
            $user['updated_at'] = now();
        }

        // Insert job companys
        DB::table('users')->insert($users);
        echo 'Users created successfully!';
    }
}
