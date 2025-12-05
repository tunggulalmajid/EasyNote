<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class category extends Model
{
  protected $fillable = [
    'category'
  ];

  public function tasklist ():BelongsTo
  {
    return $this -> belongsTo(tasklist::class);
  }
}
