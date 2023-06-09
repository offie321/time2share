<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        //
        User::create([
            'name' => 'Jelmer van Ofwegen',
            'email' => 'offie1@outlook.com',
            'role' => 'admin',
            'password' => Hash::make('12345678'),
        ]);

        //
        User::create([
            'name' => 'Karel de Koning',
            'email' => '2703jelmer@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
