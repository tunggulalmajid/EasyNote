<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = "kegiatan";
    protected $fillable = [
        'kegiatan',
        'tanggal',
        'waktu',
        'deskripsi',
        'user_id',
        'status_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

}
