<?php

namespace Database\Factories\Service;

use App\Models\Service\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use function fake;


class ServiceFactory extends Factory
{
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'Service - ' . fake()->text(15),
            'description' => fake()->text(),
            'image' => fake()->imageUrl(),
            'score' => fake()->randomFloat(1, 0,5)
        ];
    }
}
