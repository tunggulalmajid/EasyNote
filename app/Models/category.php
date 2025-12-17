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

  public function tasks()
    {
        return $this->hasMany(Tasklist::class);
    }

  public function user(){
    return $this->belongsTo(User::class);
  }
}
