<?php

namespace Database\Factories;

use App\Models\PseudoName;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
  private static string $defaultPassword = 'daily-sphere';

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'pseudo_name_id' => fake()->unique(true)->numberBetween(1, PseudoName::count()),
      'password' => Hash::make(static::$defaultPassword), // password
      'remember_token' => Str::random(10),
      'prayer_tracker_subscription_date' => fake()->dateTimeBetween('-2 months', '-1 week')->format('Y-m-d')
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
