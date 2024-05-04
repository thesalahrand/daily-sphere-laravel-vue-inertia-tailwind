<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\PseudoNameSeeder;
use Database\Seeders\TinyUrlSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call([
      PseudoNameSeeder::class,
      UserSeeder::class,
      PrayerTrackerSeeder::class
      // TinyUrlSeeder::class
    ]);
  }
}
