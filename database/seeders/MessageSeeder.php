<?php

namespace Database\Seeders;

use App\Models\Message;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
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
            Message::create([
                'text'=>$rand->text,
                'sender_id'=>$rand->numberBetween(1,30),
                'cosigner_id'=>$rand->numberBetween(1,30),
            ]);
        }
    }
}
