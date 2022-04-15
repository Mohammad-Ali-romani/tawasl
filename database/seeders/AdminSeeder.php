<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
            'name'=>'admin',
            'is_admin'=>true,
            'email'=>'admin@admin.com',
            'password'=>Hash::make('admin123'),

        ]);
//        $rand = Factory::create();
//        $user = User::create([
//            'name' => 'admin',
//            'email' => 'admin@admin.com',
//            'password' => Hash::make('admin123'),
//            'avatar' => $rand->imageUrl(150, 150),
//            'date_birth' => $rand->date('yy/m/d'),
//            'gender' => 'mate',
//            'is_block' => false,
//            'country' => $rand->country,
//            'is_admin'=>true,
//        ]);
    }
}
