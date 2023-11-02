<?php

namespace App\Services;

use App\Models\PseudoName;
use Illuminate\Database\Query\Builder;

class PseudoNameService
{
  public function getAll(): array
  {
    return PseudoName::orderBy('name', 'asc')->get(['id', 'name', 'gender'])->toArray();
  }

  public function getAvailable(): array
  {
    return PseudoName
      ::whereNotIn('id', function (Builder $query) {
        $query->select('pseudo_name_id')->from('users');
      })
      ->orderBy('name', 'asc')
      ->get(['id', 'name', 'gender'])
      ->toArray();
  }
}
