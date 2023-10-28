<?php

namespace App\Services\Trackers\TinyUrl;

use App\Models\TinyUrl;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class TinyUrlService
{
  public function index(User $authUser): LengthAwarePaginator
  {
    $tinyUrls = TinyUrl::where('user_id', $authUser->id)->orderBy('updated_at', 'desc')->paginate(10)->through(fn($tinyUrl) => [
      'id' => $tinyUrl->id,
      'full_url' => $tinyUrl->full_url,
      'tiny_url' => config('app.url') . 'tu/' . $tinyUrl->tiny_url,
      'updated_at' => $tinyUrl->updated_at->format('M d, Y h:i A')
    ]);

    return $tinyUrls;
  }

  public function store(array $validated): string
  {
    $tinyUrl = TinyUrl::create($validated);
    $usableTinyUrl = config('app.url') . 'tu/' . $tinyUrl->tiny_url;

    return $usableTinyUrl;
  }

  public function update(TinyUrl $tinyUrl, array $validated): string
  {
    $tinyUrl->update($validated);
    $usableTinyUrl = config('app.url') . 'tu/' . $tinyUrl->tiny_url;

    return $usableTinyUrl;
  }

  public function destroy(TinyUrl $tinyUrl): void
  {
    $tinyUrl->delete();
  }
}
