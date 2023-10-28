<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TinyUrl extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = ['full_url', 'tiny_url', 'user_id'];
}
