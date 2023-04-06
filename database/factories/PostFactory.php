<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'titulo'=>$this->faker->sentence(5),
            'descripcion'=>$this->faker->sentences(20),
            'imagen'=>$this->faker->uuid().'jpg',
            //que son los unicos 2 user id que tengo en user
            'user_id'=>$this->faker->randomElement([5,6])
        ];
    }
}
