<?php

namespace Database\Seeders;

use App\Models\Thread;
use App\Models\User;
use Database\Factories\ThreadFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            ChannelsTableSeeder::class,
            ThreadsTableSeeder::class,
        ]);
    }
}
