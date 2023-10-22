<?php

namespace App\Services;

use App\Models\PseudoName;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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

  public function getAvailableWithOwn(User $user): array
  {
    return [
      (object) [
        'id' => $user->pseudo_name_id,
        'name' => $user->pseudoName->name
      ]
    ] + $this->getAvailable($user->pseudoName->gender);
  }
}
