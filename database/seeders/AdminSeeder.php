<?php

namespace Database\Seeders;

use App\Constants\UserType;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'user_type' => UserType::ADMIN,
            'email' => 'admin@gp.com',
            'password' => Hash::make('12345678')
        ]);
    }
}
