<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'timargv',
            'email' => 'tima.rgv@mail.ru',
            'last_name' => 'Тимур',
            'status' => User::STATUS_ACTIVE,
            'role' => User::ROLE_ADMIN,
            'email_verified_at' => now(),
            'password' => '$2y$10$d0A1VUw1MjQpMAfqZGGmOOtdH2vGVKImA1JesK1CUqFGfpMncrTfa',
            'remember_token' => str_random(10)
        ]);
        User::create([
            'name' => 'test',
            'email' => 'test@example.com',
            'last_name' => 'Test',
            'status' => User::STATUS_ACTIVE,
            'role' => User::ROLE_USER,
            'email_verified_at' => now(),
            'password' => '$2y$10$d0A1VUw1MjQpMAfqZGGmOOtdH2vGVKImA1JesK1CUqFGfpMncrTfa',
            'remember_token' => str_random(10)
        ]);
    }
}
