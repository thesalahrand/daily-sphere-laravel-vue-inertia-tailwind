<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\PrayerTracker;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Contracts\Database\Eloquent\Builder;

class PrayerTrackerSeeder extends Seeder
{
  private function getUsers(): Collection
  {
    return User::with([
      'pseudoName' => function (Builder $query) {
        $query->select('id', 'gender');
      }
    ])->get(['id', 'pseudo_name_id', 'prayer_tracker_subscription_date']);
  }

  private function getDatesInInterval(User $user): CarbonPeriod
  {
    $startDate = $user->prayer_tracker_subscription_date;
    $endDate = Carbon::yesterday();
    $datesInInterval = CarbonPeriod::create($startDate, $endDate->format('Y-m-d'));

    return $datesInInterval;
  }

  private function getRandOfferingOptionIdx(User $user, array $variation): int
  {
    return collect(config('trackers.prayer.offering_options'))->filter(function ($offeringOption, $idx) use ($variation, $user) {
      return ($offeringOption['prayer_type_idx'] === $variation['prayer_type_idx'] && in_array($user->pseudoName->gender, $offeringOption['applicable_genders']));
    })->map(fn($offeringOption, $idx) => $idx)
      ->random();
  }

  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $users = $this->getUsers();

    $users->each(function ($user) {
      $datesInInterval = $this->getDatesInInterval($user);

      foreach ($datesInInterval as $date) {
        collect(config('trackers.prayer.variations'))->each(function ($variation, $idx) use ($user, $date) {
          if ($variation['slug'] === 'others') {
            $offeringOptionIdx = null;
            $rakatsCnt = rand(1, 20);
          } else {
            $offeringOptionIdx = $this->getRandOfferingOptionIdx($user, $variation);
            $rakatsCnt = null;
          }

          PrayerTracker::create([
            'user_id' => $user->id,
            'variation_idx' => $idx,
            'offering_option_idx' => $offeringOptionIdx,
            'rakats_cnt' => $rakatsCnt,
            'date' => $date->format('Y-m-d')
          ]);
        });
      }
    });
  }
}
