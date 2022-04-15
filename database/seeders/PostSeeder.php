<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\Post;
use App\Models\PostFile;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rand = Factory::create();
        foreach (range(1, 30) as $index) {
            Post::create([
                'text'=>$rand->text,
                'user_id'=>rand(1,29),
                'num_comments'=>$rand->numberBetween(0,100),
                'num_shares'=>$rand->numberBetween(0,100),
                'num_likes'=>$rand->numberBetween(0,100),
            ]);
        }
        foreach (range(1,30) as $index) {
            File::create([
                'url'=>$rand->imageUrl(150,80),
                'post_id'=>$rand->numberBetween(1,30)
            ]);
        }
    }
}
