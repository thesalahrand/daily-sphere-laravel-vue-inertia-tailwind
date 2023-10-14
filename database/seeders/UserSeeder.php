<?php

namespace Database\Seeders;

use App\Models\PseudoName;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  private static int $numOfUsersToSeed = 5;
  private static string $defaultPassword = 'daily-sphere';
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    while (User::count() != self::$numOfUsersToSeed) {
      $randPseudoName = PseudoName::inRandomOrder()->first();
      User::firstOrCreate(
        ['pseudo_name_id' => $randPseudoName->id],
        ['password' => self::$defaultPassword]
      );
    }
  }
}