<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'marcelloyoel',
            'email' => 'marcelloyoel10@gmail.com',
            'name'  => 'Marcello Yoel',
            'password'  => bcrypt('12345'),
        ]);
    }
}
