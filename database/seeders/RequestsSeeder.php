<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\FriendRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users  = User::all();

        foreach ($users as $sender){

            $recipient = User::where('id', '!=', $sender->id)->inRandomOrder()->first();

            FriendRequest::create([
               'sender_id' => $sender->id,
               'recipient_id' => $recipient->id,
               'accepted' => false
            ]);

        }
    }
}
