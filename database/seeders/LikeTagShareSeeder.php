<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\Share;
use App\Models\Tag;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeTagShareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rand = Factory::create();
        foreach (range(0, 100) as $index) {
            Like::create([
                'user_id'=>$rand->numberBetween(1,30),
                'post_id'=>$rand->numberBetween(1,30),
            ]);
            Tag::create([
                'name'=>$rand->name,
                'num_users'=>$rand->numberBetween(0,30)
            ]);
            Share::create([
                'text'=>$rand->text,
                'user_id'=>$rand->numberBetween(1,30),
                'post_id'=>$rand->numberBetween(1,30),
            ]);
        }
    }
}
