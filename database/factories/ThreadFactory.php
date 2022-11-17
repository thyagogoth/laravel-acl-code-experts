<?php

namespace Database\Factories;

use App\Models\Channel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ThreadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(8);
        return [
            'channel_id' => function () {
                return Channel::all()->random()->id;
            },
            'user_id' => function () {
                return User::all()->random()->id;
            },
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => $this->faker->paragraph(2),
        ];
    }
}
