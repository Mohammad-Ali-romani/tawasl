<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\SecondComment;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rand = Factory::create();
        foreach (range(1,30) as $index){
           Comment::create([
               'text'=>$rand->text,
               'is_second'=>true,
               'user_id'=>$rand->numberBetween(1,29),
               'post_id'=>$rand->numberBetween(1,30)
           ]);

        }
        foreach (range(1,40) as $index){
           SecondComment::create([
               'text'=>$rand->text,
               'comment_id'=>$rand->numberBetween(1,30),
               'user_id'=>$rand->numberBetween(1,30)
           ]);

        }
    }
}
