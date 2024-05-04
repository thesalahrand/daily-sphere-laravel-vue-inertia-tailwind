<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrayerTracker extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'user_id',
    'variation_idx',
    'offering_option_idx',
    'rakats_cnt',
    'date'
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
