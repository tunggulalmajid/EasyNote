<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
protected $table = 'category';
  protected $fillable = [
    'category',
    'user_id'
  ];

  public function tasklists ()
  {
    return $this -> hasMany(tasklist::class);
  }

  public function user(){
    return $this->belongsTo(User::class);
  }
}
