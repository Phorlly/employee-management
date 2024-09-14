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
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sex = fake()->randomElement(['male', 'female', 'other']);
        $username = fake()->randomElement(['master', 'admin', 'user', 'editor', 'viewer']);
        $first = fake()->firstName($sex);
        $last = fake()->lastName($sex);
        return [
            'first_name' => $first,
            'last_name' => $last,
            'gender' => $sex,
            'name' => full($first, $last),
            'username' => username($username),
            'phone_number' => fake()->phoneNumber(),
            'date_of_birth' => fake()->date(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= bcrypt('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
