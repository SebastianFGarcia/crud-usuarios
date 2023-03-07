<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $countries = [
            'Colombia',
            'Argentina',
            'Perú',
            'Chile',
            'Ecuador',
            'Venezuela',
            'Bolivia',
            'Paraguay',
            'Uruguay',
            'Brasil',
            'Guyana Francesa',
            'Surinam',
            'Guayana',
            'Islas Malvinas',
        ];
        return [
            'name' => fake()->firstName(),
            'email' => fake()->unique()->safeEmail(),
            'last_name' => fake()->lastName(),
            'phone' => '31'.fake()->numberBetween(10000000, 99999999),
            'address' => fake()->address(),
            'country' => $countries[rand(0, 9)],
            'nit' => '1'.fake()->unique()->numberBetween(100000000, 999999999),
            'is_admin' => false,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'category_id' => rand(1, 3),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
