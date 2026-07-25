<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServicePhoto>
 */
class ServicePhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'service_id' => Service::factory(),
            'photo_path' => 'service_photos/' . $this->faker->image('public/storage/service_photos', 640, 480, null, false),
            'description' => $this->faker->sentence(),
        ];
    }
} 