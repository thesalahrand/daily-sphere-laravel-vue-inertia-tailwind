<?php

namespace Database\Seeders;

use App\Models\TinyUrl;
use Illuminate\Database\Seeder;

class TinyUrlSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    TinyUrl::factory()->count(100)->create();
  }
}
