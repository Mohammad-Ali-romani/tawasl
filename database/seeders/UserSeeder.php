<?php

namespace Database\Seeders;

use App\Models\Chanter;
use App\Models\Follower;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

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
            'name' => 'ali',
            'email' => 'ali@gmail.com',
            'password' => Hash::make('ali123'),
        ]);
        $rand = Factory::create();
        foreach (range(1, 30) as $index) {
            User::create([
                'name' => $rand->name,
                'email' => $rand->email,
                'password' => bcrypt('secret'),
                'avatar' => $rand->imageUrl(150, 150),
                'date_birth' => $rand->date('yy/m/d'),
                'gender' => $index % 2 == 0 ? 'male' : 'female',
                'is_block' => false,
                'country' => $rand->country,
            ]);
        }
        foreach (range(1, 30) as $index) {
            Follower::create([
                'follower_id' => $rand->numberBetween(1, 30),
                'followed_id' => $rand->numberBetween(1, 30),
            ]);
            Chanter::create([
                'type' => $rand->boolean ? 'comment' : 'post',
                'type_id' => $rand->numberBetween(1, 30),
                'marshar_id' => $rand->numberBetween(1, 30),
                'refered_id' => $rand->numberBetween(1, 30),
            ]);
        }
    }
}
