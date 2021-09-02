<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use App\Enums\{UserGender, UserMaritalStatus};
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'cpf' => $this->faker->randomNumber(8) . $this->faker->randomNumber(3),
            'phone' => $this->faker->randomNumber(8) . $this->faker->randomNumber(6),
            'marital_status' => UserMaritalStatus::getRandomValue(),
            'gender' => UserGender::getRandomValue(),
            'password' => bcrypt('12345678'),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): self
    {
        return $this->state(static fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
