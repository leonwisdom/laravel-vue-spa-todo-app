<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'content' => fake()->paragraph(2),
            'created_at' => fake()->dateTime(),
            'update_at' => fake()->dateTime(),
            'deleted_at' => fake()->dateTime(),
        ];
    }

    /**
     * Indicate that the model's deleted_at should be be set to null.
     */
    public function notDeleted(): static
    {
        return $this->state(fn (array $attributes) => [
            'deleted_at' => null,
        ]);
    }
}
