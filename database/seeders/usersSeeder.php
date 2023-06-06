<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            ['fname' => "مهدی", 'lname' => 'مفتوحی',
              'phone' => '09149299209', 'email' => '1mahdimf@gmail.com','password' => '1']
        );
    }
}
