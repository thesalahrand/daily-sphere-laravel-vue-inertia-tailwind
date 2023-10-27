<?php

namespace App\Services\Trackers\TinyUrl;

use App\Models\TinyUrl;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TinyUrlService
{
  public function store(array $validated): string
  {
    $tinyUrl = TinyUrl::create($validated);
    $usableTinyUrl = config('app.url') . 'tu/' . $tinyUrl->tiny_url;
    return $usableTinyUrl;
  }
}
