<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class catatan extends Model
{
    protected $table = 'catatan';
    protected $fillable = [
    'judul',
    'konten',
    'user_id'
  ];

  public function user(){
    return $this->belongsTo(User::class);
  }
}
