<?php

namespace Database\Factories;

use App\Models\Website;
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
    public function definition(): array
    {
        $website = Website::factory()->create();

        return [
            'url' => 'https://' .  $website->domain  . '/' . $this->faker->slug,
            'website_id' => $website->id,
            'title' => $this->faker->sentence,
            'description' => '<h3>' . $this->faker->sentence . '</h3>'
                . '<p>' . implode('</p><p>', $this->faker->paragraphs) . '</p>'
                . '<h3>' . $this->faker->sentence . '</h3>'
                . '<p>' . implode('</p><p>', $this->faker->paragraphs) . '</p>'
                . '<h3>' . $this->faker->sentence . '</h3>'
                . '<p>' . implode('</p><p>', $this->faker->paragraphs) . '</p>',
        ];
    }
}
