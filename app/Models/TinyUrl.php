<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinyUrl extends Model
{
  use HasFactory;

  protected $fillable = ['full_url', 'tiny_url', 'user_id'];
}
