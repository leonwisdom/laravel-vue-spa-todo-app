<?php

namespace Database\Factories;

use App\Models\User;
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
            'body' => fake()->paragraph(2),
            'user_id' => function () {
                if ($user = User::inRandomOrder()->first()) {
                    return $user->id;
                }

                return factory(User::class)->create()->id;
            }
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
